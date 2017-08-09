<div class="colum-1-5">
  <div class="filters-location country">
  	<p class="filters-title">
      <? if(isset($country)) : ?>
        <a href="#"><?= $country->name; ?> <i class="fa fa-angle-down"></i></a>
      <? else : ?>
  		  <a href="#"><?= __('Страна', 'Colombo'); ?> <i class="fa fa-angle-down"></i></a>
      <? endif; ?>
  	</p>
  	<ul class="filters-list hide">
  		  <? foreach ($countries as $country): ?>
  		      <li><a href="<?= $lang_prefix . $country->slug; ?>"><?= $country->name; ?></a></li>
  		  <? endforeach; ?>
  	</ul>
  </div>
</div>
