<?
/*
* Making import from excel to dealers taxonomies
*/

function import_settings_page()
{
    add_settings_section("section", __("Настройки импорта", "Colombo"), null, "import");
    add_settings_field("import-file", __("Выберите файл .xml", "Colombo"), "import_file_display", "import", "section");
    add_settings_field("chose-language", __("Выберите язык", "Colombo"), "show_language_selector", "import", "section");
    register_setting("section", "import-file", "handle_file_upload");
}

function handle_file_upload($option)
{
  $lang = $_POST['language'];
  if(!empty($_FILES["import-file"]["tmp_name"]))
  {
    $urls = wp_handle_upload($_FILES["import-file"], array('test_form' => FALSE));
    $temp = $urls["url"];
    $res = parse_file($urls['file'], $lang);
  }
  return $option;
}

function import_file_display()
{
   ?>
        <input type="file" name="import-file" />
   <?
}

function show_language_selector ()
{
  ?>
  <select name="language">
    <option value="ua">Украина</option>
    <option value="other">Другие страны</option>
  </select>
  <?
}

add_action("admin_init", "import_settings_page");

function import_page()
{
  ?>
      <div class="wrap">
         <h1><?= __('Импорт диллеров', 'Colombo'); ?></h1>

         <form method="post" action="options.php" enctype="multipart/form-data">
            <?
               settings_fields("section");

               do_settings_sections("import");

               submit_button();
            ?>
         </form>
      </div>
   <?php
}

function menu_item()
{
  add_submenu_page("options-general.php", __('Импорт диллеров', 'Colombo'), __('Импорт диллеров', 'Colombo'), "manage_options", "import", "import_page");
}

add_action("admin_menu", "menu_item");

function parse_file($filename, $lang) {

  switch ($lang) {
    case 'ua':
      $taxonomy = 'deal_ukraine';
      break;

    case 'other' :
      $taxonomy = 'deal_other_countries';
      break;

    default:
      $taxonomy = 'deal_other_countries';
      break;
  }

  $countries = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false
  ]);
  $xmlDoc = simplexml_load_file($filename);
  // removeAll($taxonomy);
  if(!$countries) {
    insertCountries($xmlDoc, $taxonomy);
    insertRegions($xmlDoc, $taxonomy);
    insertCities($xmlDoc, $taxonomy);
    insertDealers($xmlDoc, $taxonomy);
  } else {
    //TODO make update function
    // updateCountries($xmlDoc);
    // updateRegions($xmlDoc);
    // updateCities();
    // updateRieltors();
  }
}

function insertDealers($xmlDoc, $taxonomy) {
    foreach ($xmlDoc->Worksheet->Table->Row as $key => $row) {
        $address = explode(',', trim((string)$row->Cell[3]->Data[0])); //$address[0] - City, $address[1] - Street
        $city = get_term_by('name', $address[0], $taxonomy);
        $newDealer = [
          'post_type' => 'dealer',
          'post_title' => trim((string)$row->Cell[2]->Data[0]),
          'post_status' => 'publish',
        ];
        $post_id = wp_insert_post( $newDealer);
        wp_set_object_terms($post_id, $city->term_id, $taxonomy, true);
        update_post_meta( $post_id, 'deal_adress', $address[1]);
        update_post_meta( $post_id, 'deal_phone', trim((string)$row->Cell[4]->Data[0]));
    }
}

function insertCities($xmlDoc, $taxonomy) {
  $countries = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
  ]);
  $arrCountries = [];
  foreach ($countries as $key => $country) {
    if($country->parent !== 0) {
      $arrCountries[$country->name] = $country->term_id;
    }
  }
  unset($countries);
  foreach ($xmlDoc->Worksheet->Table->Row as $key => $row) {
    $parentID = $arrCountries[trim((string)$row->Cell[1]->Data[0])];
    if($parentID) {
        $address = explode(',', trim((string)$row->Cell[3]->Data[0])); //$address[0] - City, $address[1] - Street
        wp_insert_category([
          'cat_name' => $address[0],
          'category_parent' => $parentID,
          'taxonomy' => $taxonomy
        ]);
    }
  }
}

function insertRegions($xmlDoc, $taxonomy) {
  $regions = [];
  $countries = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false
  ]);
  $countriesArr = [];
  foreach ($countries as $country) {
      $countriesArr[$country->name] = $country->term_id;
  }
  foreach ($xmlDoc->Worksheet->Table->Row as $row) {
    if(!empty(trim((string)$row->Cell[1]->Data[0]))) {
      $region = array(
          trim((string)$row->Cell[0]->Data[0]) => trim((string)$row->Cell[1]->Data[0])
      );
      array_push($regions, $region);
    }

  }
  $regions = array_unique($regions, SORT_REGULAR);
  foreach ($regions as $region) {
      $countryID = $countriesArr[key($region)];
      wp_insert_category([
        'cat_ID' => 0,
        'cat_name' => array_values($region)[0],
        'category_parent' => $countryID,
        'taxonomy' => $taxonomy
      ]);
  }
  unset($countries);
  unset($regions);
  unset($countriesArr);
  unset($region);
}

function insertCountries($xmlDoc, $taxonomy) {
  $countries = [];
  foreach ($xmlDoc->Worksheet->Table->Row as $row) {
    if(!empty(trim((string)$row->Cell[0]->Data[0]))) {
      array_push($countries, trim((string)$row->Cell[0]->Data[0]));
    }
      // var_dump($row->Cell[0]); // Country
      // var_dump($row->Cell[1]); //Region
      // var_dump($row->Cell[2]); //Dealer Name
      // var_dump($row->Cell[3]); // City, Address
      // var_dump($row->Cell[4]); //Phone

  }
  $countries = array_unique($countries);

  foreach ($countries as $country) {
    wp_insert_category([
      'cat_ID' => 0,
      'cat_name' => $country,
      // 'category_description' => ,
      // 'category_nicename' => ,
      // 'category_parent' => ,
      'taxonomy' => $taxonomy
    ]);
  }
  unset($countries);
}

function removeAll($taxonomy) {
  $countries = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
  ]);

  foreach ($countries as $country) {
    wp_delete_term( $country->term_id, $taxonomy);
  }
  die("OK");
}
