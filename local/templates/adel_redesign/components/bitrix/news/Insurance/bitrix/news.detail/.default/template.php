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
<div class="InsuranceDetail">

	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
    <div class="InsuranceDetail-img">
		<img
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="100%"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
    </div>
	<?endif?>

    <div class="InsuranceDetail-text">
        <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
            <?=$arResult["DETAIL_TEXT"];?>
        <?else:?>
            <?=$arResult["PREVIEW_TEXT"];?>
        <?endif?>
    </div>

</div>