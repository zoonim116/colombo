<? get_header(); ?>
  <?
  $countries = get_terms( array(
    'taxonomy' => 'deal_countries',
    'hide_empty' => false,
    'parent' => 0
  ) );
  // var_dump($countries);
  // $countries = get_taxonomies([
  //     'name' => 'deal_countries'
  // ], 'objects');
  // echo "<pre>";
  foreach ($countries as $country) {
    echo $country->name;
  }
  ?>
<? get_footer(); ?>
