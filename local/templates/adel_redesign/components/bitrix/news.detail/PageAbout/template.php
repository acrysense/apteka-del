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
<div class="PageAbout">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="PageAbout-img"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="100%"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>

    <div class="PageAbout-preview-text"><?=$arResult["PREVIEW_TEXT"];?></div>
    <div class="PageAbout-detail-text" style="display: none;"><br><?=$arResult["DETAIL_TEXT"];?></div>

    <div class="PageAbout-btn-more">Подробнее...</div>

</div>