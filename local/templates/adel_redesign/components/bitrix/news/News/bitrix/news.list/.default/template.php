<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!isset($arParams['MS_NUM_OUTPUT']))
    $arParams['MS_NUM_OUTPUT'] = 1;

$classNumView = '';
if($arParams['MS_NUM_VIEW'] == 'THREE')
    $classNumView = 'isSmall';

?>

<ul class="list <?=$classNumView;?>">
<?
$obParser = new CTextParser;

foreach($arResult["ITEMS"] as $arItem):

    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $arItem["NAME"] = $obParser->html_cut($arItem["NAME"], 40);
    ?>
    <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="item" style="background-image:url('<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>')">
        <span class="title">
            <span class="value ellipsis"><?=$arItem["NAME"];?></span>
            <span class="annotate ellipsis"><?=$arItem["PREVIEW_TEXT"];?></span>
        </span>
        </a>
    </li>
<?endforeach;?>

</ul>

<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arParams['NEWS_COUNT'] < $arResult['NAV_RESULT']->NavRecordCount):?>
    <div class="showNext">
    <span class="arrow">
        <span>показать еще</span>
        <i class="icon-arrow-bottom"></i>
    </span>
    </div>
<?endif;?>

<?
$arJsData = array(
    'SITE_ID'           => SITE_ID,
    'AJAX_PATH'         => $templateFolder.'/ajax.php',
    'IBLOCK_ID'         => $arParams['IBLOCK_ID'],
    'SORT_BY1'          => $arParams['SORT_BY1'],
    'SORT_ORDER1'       => $arParams['SORT_ORDER1'],
    'SORT_BY2'          => $arParams['SORT_BY2'],
    'SORT_ORDER2'       => $arParams['SORT_ORDER2'],
    'DETAIL_URL'        => $arParams['DETAIL_URL'],
    'NUM_SHOW_ITEMS'    => $arParams['NEWS_COUNT'],
    'NUM_OUTPUT'        => $arParams['MS_NUM_OUTPUT']
);
?>

<script>
    new MsNewsLoader(<?=CUtil::PhpToJSObject($arJsData, false, true, false)?>);
</script>
<?
/*
global $USER;
if($USER->isAdmin()) {
    echo '<pre>'; print_r($arResult); echo '</pre>';
}
*/
?>