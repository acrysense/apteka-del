<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;

global $APPLICATION;
$scheme = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
$page = $APPLICATION->GetCurPage();
$arResult['TITLE'] = $APPLICATION->GetTitle();
$arResult['DESCRIPTION'] = $APPLICATION->GetProperty('description');
$arResult['IMAGE'] = $APPLICATION->GetProperty('IMAGE');

Asset::getInstance()->addString('<meta property="og:type" content="website" />');
Asset::getInstance()->addString('<meta property="og:url" content="'.$scheme.$page.'" />');
Asset::getInstance()->addString('<meta property="og:title" content="'.$arResult['TITLE'].'" />');
Asset::getInstance()->addString('<meta property="og:description" content="'.$arResult['DESCRIPTION'].'" />');
Asset::getInstance()->addString('<meta property="og:image" content="'.$arResult['IMAGE'].'" />');
Asset::getInstance()->addString('<meta property="og:image:width" content="600" />');
Asset::getInstance()->addString('<meta property="og:image:height" content="400" />');

Asset::getInstance()->addString('<meta property="twitter:url" content="'.$scheme.$page.'" />');
Asset::getInstance()->addString('<meta property="twitter:title" content="'.$arResult['TITLE'].'" />');
Asset::getInstance()->addString('<meta property="twitter:description" content="'.$arResult['DESCRIPTION'].'" />');
Asset::getInstance()->addString('<meta property="twitter:image" content="'.$arResult['IMAGE'].'" />');
?>