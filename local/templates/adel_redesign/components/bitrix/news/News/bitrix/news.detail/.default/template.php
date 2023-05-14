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

$this->addExternalJS("//yastatic.net/es5-shims/0.0.2/es5-shims.min.js");
$this->addExternalJS("//yastatic.net/share2/share.js");

$scheme = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
?>

<div id="owl-carousel-post" class="owl-carousel">
    <?
    foreach ($arResult["PICTURE"] as $key => $value):
    ?>
        <img style="margin: 0 auto;" src="<?=$value['SRC']?>" alt="" />
    <?
    endforeach;
    ?>
</div>

<?if($arParams["DISPLAY_DATE"]!="N"):?>
    <div class="date"><?=$arResult["DISPLAY_ACTIVE_FROM"];?></div>
<?endif;?>

<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
    <?=$arResult["DETAIL_TEXT"];?>
<?else:?>
    <?=$arResult["PREVIEW_TEXT"];?>
<?endif?>

<div class="bottom">
    <a href="<?=$arResult["LIST_PAGE_URL"];?>" class="btn">Все акции</a>
    <div class="share">
        <span class="value">Поделиться:</span>
        <span class="value">
            <div class="ya-share2"
                 data-services="vkontakte,facebook,odnoklassniki"
                 data-lang="<?=LANGUAGE_ID;?>"
                 data-url="<?=$scheme.$arResult["DETAIL_PAGE_URL"];?>"
                 data-title="<?=$arResult["META_TAGS"]["TITLE"];?>"
                 data-description="<?=$arResult["META_TAGS"]["DESCRIPTION"];?>"
                 data-image="<?=$scheme.$arResult["DETAIL_PICTURE"]["SRC"];?>"
            ></div>
        </span>
    </div>
</div>

<?
/*
global $USER;
if($USER->IsAdmin()):
    echo "<pre>"; echo print_r($arResult); echo "</pre>";
    echo "<pre>"; echo print_r($scheme); echo "</pre>";
endif;
*/
?>