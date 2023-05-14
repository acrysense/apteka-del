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
?>
<div id="MsNewsContainer" class="leftSide">
<?
$ind = 0;
$count = 0;
$obParser = new CTextParser;

foreach($arResult["ITEMS"] as $arItem):

$ind++;
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

$arItem["NAME"] = $obParser->html_cut($arItem["NAME"], 50);

if($count == 0)
    echo '<div class="line">';
?>
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="item" style="background-image:url('<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>')">
            <span class="title"><?=$arItem["NAME"];?>
                <span class="annotate"><?=$arItem["PREVIEW_TEXT"];?></span>
            </span>
        </a>
    </div>
<?
    $count++;
    if($count == 3 || $ind == count($arResult["ITEMS"])){
        echo '</div>';
        $count = 0;
    }
?>

<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="showNext" data-number-show-items="<?=$ind;?>">
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
    'NUM_OUTPUT'        => 3
);
?>

<script>
    new MsNewsLoader(<?=CUtil::PhpToJSObject($arJsData, false, true, false)?>);
</script>

<?

/*
if($USER->IsAdmin()):
    echo "<pre>"; echo print_r($arParams); echo "</pre>";
endif;
*/
?>
</div>