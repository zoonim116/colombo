<? /* Template Name: Контакты */ ?>
<? get_header(); ?>
<section>
  <div class="row">
    <? do_action('colombo_get_page_title'); ?>
      <div class="contacts-map colums">
          <? while ( have_posts() ) : the_post(); ?>
            <? the_content(); ?>
          <? endwhile; ?>
      </div>
      <div class="representatives colums">
        <div class="colum-1-1">
          <h5><?= __('Региональные представители в Украине', 'Colombo'); ?></h5>
          <ul>
            <? $the_query = new WP_Query(array(
                'post_type'         => 'region_contacts',
                'category__not_in'  => get_terms('clm_countries', array(
                    'fields'        => 'ids'
                )),
            ));
            if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
            $the_query->the_post(); ?>
            <li class="representative"><span class="city"><? the_title(); ?></span><a class="phone" href="tel:<?= trim(get_field('phone_number')); ?>" rel="nofollow"><?= get_field('phone_number'); ?></a></li>
            <?  }
          } ?>
          </ul>
        </div>
      </div>
      <?
      $terms = get_terms( array(
        'taxonomy' => 'clm_countries',
        'hide_empty' => true,
      ) );
        foreach ($terms as $t) { ?>
        <div class="contacts-county colums">
					<div class="address colum-1-1">
						<address>
							<h5><?= $t->name; ?></h5>
              <? if(!empty(term_description($t->term_id, 'clm_countries'))): ?>
                <p><i class="fa fa-map-marker"></i> <?= term_description($t->term_id, 'clm_countries'); ?></p>
              <? endif; ?>
						</address>
					</div>
				</div>
				<div class="representatives colums">
					<div class="colum-1-1">
						<ul>
              <?php
                $args = array(
                'post_type' => 'region_contacts',
                'tax_query' => array(
                    array(
                    'taxonomy' => 'clm_countries',
                    'field' => 'id',
                    'terms' => $t->term_id
                     )
                  )
                );
                $query = new WP_Query( $args );
                if ($query->have_posts()) {
                while ($query->have_posts()) {
                  $query->the_post(); ?>
    							<li class="representative"><span class="city"><? the_title(); ?></span><a class="phone" href="tel:<?= trim(get_field('phone_number')); ?>" rel="nofollow"><?= get_field('phone_number'); ?></a></li>
    							<? }
                } ?>
						</ul>
					</div>
				</div>
      <? } ?>
  </div>
</section>
<? get_footer(); ?>
