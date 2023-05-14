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
$page = $APPLICATION->GetCurPage();
$scheme = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$page;
?>
<div id="AboutAdvantage" class="AboutAdvantage">
    <div class="AboutAdvantage-title">Наши преимущества</div>

    <div class="AboutAdvantage-Items">
<?
$i = 0;
foreach($arResult["ITEMS"] as $arItem):
$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
	<div class="AboutAdvantage-Item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                <div class="AboutAdvantage-Item-icon" id="AdvantageScrollIcon-<?=$i;?>">
                    <?
                    if(isset($arItem['PROPERTIES']['FILE_ICON']['VALUE'])):
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "COMPONENT_TEMPLATE" => ".default",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => $arItem['PROPERTIES']['FILE_ICON']['VALUE'],
                                "AREA_FILE_RECURSIVE" => "Y"
                            )
                        );
                    endif;
                    ?>

                    <div class="AboutAdvantage-Item-name"><?=$arItem['NAME'];?></div>
                </div>

            <div class="AboutAdvantage-Item-desc"><?=$arItem['DETAIL_TEXT'];?></div>

	</div>
<?endforeach;?>

    </div>

    <div class="AboutAdvantage-Items-share">
        <div class="AboutAdvantage-Items-share-col">Поделиться:</div>
        <div class="AboutAdvantage-Items-share-col ya-share2"
             data-services="vkontakte,facebook,odnoklassniki"
             data-lang="<?=LANGUAGE_ID;?>"
             data-url="<?=$scheme;?>"
             data-title="<?=$arResult['TITLE'];?>"
             data-description="<?=$arResult['DESCRIPTION'];?>"
             data-image="<?=$arResult['IMAGE'];?>"
        ></div>
    </div>

</div>
<?
/*
global $USER;
if($USER->IsAdmin()):
    echo "<pre>"; echo print_r($arResult); echo "</pre>";
endif;
*/
?>