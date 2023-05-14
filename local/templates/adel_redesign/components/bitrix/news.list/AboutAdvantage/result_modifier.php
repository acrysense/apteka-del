<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */

global $APPLICATION;
$arResult['TITLE'] = $APPLICATION->GetTitle();
$arResult['DESCRIPTION'] = $APPLICATION->GetProperty('description');
$arResult['IMAGE'] = $APPLICATION->GetProperty('IMAGE');