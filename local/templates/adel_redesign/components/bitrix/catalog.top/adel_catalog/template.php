<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;



/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */



if(!empty($arResult['ITEMS'])):
?>

<div class="best-buy">
	<div class="wrapper">
		<p class="caption">Хиты продаж</p>
		<div class="owl-carousel" id="owl-best-buy">
			<?foreach ($arResult['ITEMS'] as $item):?>
				<a href="<?=$item['DETAIL_PAGE_URL']?>" class="item item-<?=$item['ID']?>" >
					<div class="wrapper-thumb">
						<div class="thumb" style="background-image: url('<?=$item['DETAIL_PICTURE']?>')"></div>
					</div>
					<div class="block">
						<h2 class="name ellipsis"><?=$item['NAME']?>
						</h2>
						<div class="price">
                            <div class="new-price"><span class="black"><?=$item['PRICES']['DISC']?></span> </div>

                            <div class="old-price"><?=$item['PRICES']['BASE']?></div>
                            руб.
						</div>
					</div>
				</a>
			<?endforeach;?>


		</div>
	</div>
</div>

<?endif;?>