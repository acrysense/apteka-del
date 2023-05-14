<?php
/** @global CUser $USER */
/** @global CMain $APPLICATION */
define('STOP_STATISTICS', true);
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);
define("PUBLIC_AJAX_MODE", true);
define("NOT_CHECK_PERMISSIONS", true);

use Bitrix\Main\Loader;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
header('Content-Type: application/json');

if(!check_bitrix_sessid() || !Loader::includeModule('iblock'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
    die();
}

if(empty($_POST['arParams']))
    die;
else
    $arParams = $_POST['arParams'];

if($_SERVER['REQUEST_METHOD'] != 'POST' ||
    !isset($_POST['event']) ||
    !isset($arParams['SITE_ID']) ||
    !is_string($arParams['SITE_ID']) ||
    preg_match('/^[A-Za-z0-9_]{2}$/', $arParams['SITE_ID']) !== 1)
    die;

define('SITE_ID', $arParams['SITE_ID']);

global $APPLICATION, $USER;

$arResult = array();
$arResult['ITEMS'] = array();
$count = 0;

if($_POST['event'] == 'Get'):

    //ORDER BY
    $arSort = array(
        $arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
        $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
    );
    if(!array_key_exists("ID", $arSort))
        $arSort["ID"] = "DESC";

    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID" => intval($arParams['IBLOCK_ID']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
    $rsElement->SetUrlTemplates($arParams['DETAIL_URL']);

    while($obElement = $rsElement->GetNextElement()){

        $count++;

        if($count > $arParams["NUM_SHOW_ITEMS"] && $count <= ($arParams["NUM_SHOW_ITEMS"] + $arParams["NUM_OUTPUT"])):
            $arItem = $obElement->GetFields();
            $arItem['PREVIEW_PICTURE'] = CFile::GetFileArray($arItem['PREVIEW_PICTURE']);
            $arResult['ITEMS'][] = $arItem;
        endif;

    }

    $arResult['COUNT'] = $count;

    echo CUtil::PhpToJSObject($arResult);

endif;

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
die();