<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;

global $APPLICATION;
$scheme = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
$APPLICATION->SetPageProperty('IMAGE',$scheme.$arResult["DETAIL_PICTURE"]["SRC"]);

?>