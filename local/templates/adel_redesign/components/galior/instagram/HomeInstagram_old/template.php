<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
?>
<div class="wrapper">

    <div class="HomeInstagram">
        <div class="HomeInstagram-title h2"><?=Loc::getMessage('INSTAGRAM_TPL_MSG_TITLE');?></div>

        <div class="HomeInstagram-items">
            <?foreach ($arResult['ITEMS'] as $item):?>
                <a href="<?=$item['LINK']?>" class="HomeInstagram-item" target="_blank" rel="nofollow">
                    <span class="HomeInstagram-item-img" style="background-image:url(<?=$item['URL_IMAGES']?>);"></span>
                </a>
            <?endforeach;?>
        </div>

        <div class="HomeInstagram-btn">
            <a href="https://www.instagram.com/apteka_adel/" target="_blank" class="btn"><?=Loc::getMessage('INSTAGRAM_TPL_MSG_BTN');?></a>
        </div>
    </div>

</div>


<?
/*
if($USER->IsAdmin()):
	echo "<pre>"; echo print_r($arParams); echo "</pre>";
    echo "<pre>"; echo print_r(count($arResult['ITEMS']->data)); echo "</pre>";
endif;
*/
?>