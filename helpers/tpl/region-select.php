<div class="colum-1-5">
  <div class="filters-location region">
  	<p class="filters-title">
      <? if(isset($region)) : ?>
        <a href="#"> <?= $region->name; ?> <i class="fa fa-angle-down"></i></a>
      <? else: ?>
  		  <a href="#"> <?= __('Область', 'Colombo'); ?> <i class="fa fa-angle-down"></i></a>
      <? endif; ?>
  	</p>
  	<ul class="filters-list hide">
      <? if(!$country): ?>
        <li><span><?= __('Сначала выберите страну', 'Colombo'); ?></span></li>
      <? else: ?>
  		  <? foreach ($regions as $region): ?>
  		      <li><a href="<?= $region->slug; ?>"><?= $region->name; ?></a></li>
  		  <? endforeach; ?>
      <? endif; ?>
  	</ul>
  </div>
</div>
