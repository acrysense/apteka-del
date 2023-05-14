<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;

global $APPLICATION;
$scheme = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
$page = $APPLICATION->GetCurPage();

Asset::getInstance()->addString('<meta property="og:type" content="website" />');
Asset::getInstance()->addString('<meta property="og:url" content="'.$scheme.$page.'" />');
Asset::getInstance()->addString('<meta property="og:title" content="'.$arResult["META_TAGS"]["TITLE"].'" />');
Asset::getInstance()->addString('<meta property="og:description" content="'.$arResult["META_TAGS"]["DESCRIPTION"].'" />');
Asset::getInstance()->addString('<meta property="og:image" content="'.$scheme.$arResult["DETAIL_PICTURE"]["SRC"].'" />');
Asset::getInstance()->addString('<meta property="og:image:width" content="600" />');
Asset::getInstance()->addString('<meta property="og:image:height" content="400" />');

Asset::getInstance()->addString('<meta property="twitter:url" content="'.$scheme.$page.'" />');
Asset::getInstance()->addString('<meta property="twitter:title" content="'.$arResult["META_TAGS"]["TITLE"].'" />');
Asset::getInstance()->addString('<meta property="twitter:description" content="'.$arResult["META_TAGS"]["DESCRIPTION"].'" />');
Asset::getInstance()->addString('<meta property="twitter:image" content="'.$scheme.$arResult["DETAIL_PICTURE"]["SRC"].'" />');
?>
<?
/*
global $USER;
if($USER->IsAdmin()):
    echo "<pre>"; echo print_r($arResult); echo "</pre>";
endif;
*/
?>