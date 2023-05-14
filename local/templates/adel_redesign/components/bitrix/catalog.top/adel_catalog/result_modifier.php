<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$itemsIDs=ArrayUtil::getKeyColumns($arResult['ITEMS'], 'ID');

$prices1=CatalogProduct::getProductPrices($itemsIDs, 1);
$prices2=CatalogProduct::getProductPrices($itemsIDs, 2);



foreach ($arResult['ITEMS'] as $key=>$item) {



    $arResult['ITEMS'][$key]['PRICES']['BASE'] = $prices1[$item['ID']]['PRICE'];
    $arResult['ITEMS'][$key]['PRICES']['DISC'] = $prices2[$item['ID']]['PRICE'];



    //Debug::dump($price);

	if(!empty($img=$item['DETAIL_PICTURE'])){

		$arResult['ITEMS'][$key]['DETAIL_PICTURE']= $img['SRC'];
	}
	else{
		$arResult['ITEMS'][$key]['DETAIL_PICTURE']=BxPath::tPath('/img/nimg.jpg');
	}
}

