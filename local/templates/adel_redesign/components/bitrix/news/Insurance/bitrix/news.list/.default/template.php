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

$path = $component->getParent()->getTemplate()->GetFolder();
$obParser = new CTextParser;
?>
<div class="InsuranceList">

<?
foreach($arResult["ITEMS"] as $arItem):

    $picture = $path.'/images/no-photo.png';
    if(!empty($arItem["PREVIEW_PICTURE"]))
        $picture = $arItem["PREVIEW_PICTURE"]["SRC"];

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $arItem["DETAIL_TEXT"] = $obParser->html_cut($arItem["DETAIL_TEXT"], 150);
?>
	<div class="InsuranceList-Item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="InsuranceList-Item-img" style="background-image: url('<?=$picture;?>')"></a>

        <div class="InsuranceList-Item-name">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"];?></a>
        </div>

        <div class="InsuranceList-Item-desc">
            <?=$arItem["DETAIL_TEXT"];?>
        </div>

        <div class="InsuranceList-Item-btn-more">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">Подробнее ></a>
        </div>

	</div>
<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

</div>
    <div style="clear: both;"></div>
<?
/**/
if($USER->IsAdmin()):
    echo "<pre>"; echo print_r($title); echo "</pre>";
endif;

?>