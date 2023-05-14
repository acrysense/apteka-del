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

<div class="section4">
    <div class="wrapper">
        <h2>Наши преимущества</h2>
<ul class="advantageItems">

<?
$i = 0;
foreach($arResult["ITEMS"] as $arItem):
$i++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
	<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="/about/#AboutAdvantage">
            <div class="dynamicIcon">
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
            </div>
            <span class="name"><?=$arItem['NAME'];?></span>
            <span class="description"><?=$arItem['PREVIEW_TEXT'];?></span>
        </a>
	</li>
<?endforeach;?>

</ul>

    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "COMPONENT_TEMPLATE" => ".default",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/bitrix/templates/adel/page_templates/HomeAdvantagesDesc.php",
            "AREA_FILE_RECURSIVE" => "Y"
        )
    );?>
    </div>
</div>