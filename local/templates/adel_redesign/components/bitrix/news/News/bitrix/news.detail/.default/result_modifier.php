<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */

$this->__component->SetResultCacheKeys(array(
    "DETAIL_PICTURE"
));

if(empty($arResult['DISPLAY_PROPERTIES']['PHOTO']))
    $arResult["PICTURE"] = array($arResult['DETAIL_PICTURE']);
else
    $arResult["PICTURE"] = array_merge(array($arResult['DETAIL_PICTURE']), $arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE']);
