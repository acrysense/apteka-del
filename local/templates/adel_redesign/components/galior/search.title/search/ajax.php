<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["CATEGORIES"])):
	$APPLICATION->RestartBuffer();
	?>

		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
				<div class="items">
					<a href="<?echo $arItem["URL"]?>" class="name"><?echo $arItem["NAME"]?></a>
					<div class="price-search">
						<span class="static-price">24<span class="currency">руб.</span></span>
					</div>
					<div class="button-search">
						<a href="#">Подробнее</a>
					</div>
				</div>
			<?endforeach;?>
		<?endforeach;?>

<?endif;
die();