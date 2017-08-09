<?
/**
* Dealer class
*/

require_once 'libs/view.php';

class Dealer {

  private $tpl;

  private $taxonomy;

  private $country;

  private $region;

  private $city;

  private $lang_prefix = '/';

  public function __construct() {
    global $post;
    $this->taxonomy = 'deal_other_countries';
    if(qtranxf_getLanguage() == 'ua') {
        $this->taxonomy = 'deal_ukraine';
    }
    $this->lang_prefix .= $post->post_name. '/';
    if(qtranxf_getLanguage() !== 'ua') {
      $this->lang_prefix = '/'.qtranxf_getLanguage().'/'.$post->post_name.'/';
    }
    if(get_query_var('country')) {
      $this->country = get_query_var('country');
    }

    if(get_query_var('country')) {
      $this->region = get_query_var('region');
    }

    $this->tpl = new VIEW_View('/wp-content/themes/colombo/helpers/tpl/');
    $this->tpl->set('lang_prefix', $this->lang_prefix);
  }


  /**
  * Render all Countries
  */
  public function renderCountries() {
    $cached = get_transient( 'dealer_countries' );
    if ( $cached !== false ) {
        $countries = $cached;
    } else {
      $countries = get_terms([
        'taxonomy' => $this->taxonomy,
        'hide_empty' => false,
        'parent' => 0,
      ]);
      set_transient( 'dealer_countries', $countries, 1 * 604800 );
    }
    if($this->country) {
      $countryObj = get_term_by('slug', $this->country, $this->taxonomy);
      $this->tpl->set('country', $countryObj);
    }
    $this->tpl->set('countries', $countries);
    $this->tpl->display('country-select.php');
  }

  /**
  * Render region according to the selected country
  */
  public function renderRegions() {
    $this->tpl->set('country', $this->country);
    if($this->country) {
      $countryObj = get_term_by('slug', $this->country, $this->taxonomy);
      $this->tpl->set('country', $countryObj);
      $regions = get_terms([
        'taxonomy' => $this->taxonomy,
        'hide_empty' => false,
        'parent' => $countryObj->term_id,
      ]);
      $this->tpl->set('regions', $regions);
    }
    if($this->region) {
      $regionObj = get_term_by('slug', $this->region, $this->taxonomy);
      $this->tpl->set('region', $regionObj);
    }
    $this->tpl->display('region-select.php');
  }

  /**
  * Render region according to the selected country
  */
  public function renderCities() {
    if($this->region) {
        $regionObj = get_term_by('slug', $this->region, $this->taxonomy);
        $cities = get_terms([
          'taxonomy' => $this->taxonomy,
          'hide_empty' => false,
          'parent' => $regionObj->term_id,
        ]);
        $this->tpl->set('cities', $cities);
    }
  }
}
