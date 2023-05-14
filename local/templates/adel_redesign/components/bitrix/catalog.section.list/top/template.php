<?

?>


<div class="catalog section2">
	<div class="wrapper">
		<div class="block-medicine">
			<div class="outer">
				<?foreach ($arResult['SECTIONS'] as $section):?>
					<div class="item dropdown">
						<a href="<?=$section['SECTION_PAGE_URL']?>" class="item-category-link"><span class="display-none"><?=$section['NAME']?></span></a>
						<div class="icon-arrow-bottom"></div>
						<div class="dropdown-block">
							<div class="wrapper-block">
								<span class="angle"></span>
								<?
								$childs=ArrayUtil::splitByColumns($arResult['CHILDS'][$section['ID']], 2);

								?>
								<div class="block">
									<?foreach ($childs[0] as $child):?>
										<a href="<?=$child['SECTION_PAGE_URL']?>"><?=$child['NAME']?></a>
									<?endforeach;?>

								</div>
								<div class="block">
									<?foreach ($childs[1] as $child):?>
										<a href="<?=$child['SECTION_PAGE_URL']?>"><?=$child['NAME']?></a>
									<?endforeach;?>

								</div>
							</div>
							<div class="close">Свернуть</div>
						</div>
						<span class="name"><?=$section['NAME']?></span>
                    <span class="thumb">

	                   <?if(!empty($icon=$section['~UF_ICON'])){
		                   echo $icon;
	                   }?>
					</span>

					</div>
				<?endforeach;?>

                <div class="item red-item">
                    <a href="/catalog/search/?promo=1" class="item-category-link"><span class="display-none">Товары на акции</span></a>
                    <span class="name red-price">Товары на акции</span>
                    <span class="thumb">
<!--?xml version="1.0" encoding="utf-8"?-->
                    <?require_once 'svg_promo.php'?>
					</span>
                </div>
			</div>
		</div>
	</div>
</div>

