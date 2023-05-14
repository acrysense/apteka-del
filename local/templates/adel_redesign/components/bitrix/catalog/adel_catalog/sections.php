<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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



$GLOBALS['sectionsFilter']=array(
	'DEPTH_LEVEL'           =>1
);

$APPLICATION->IncludeComponent(
    "galior:search",
    "",
    Array(
    ));

?>


<div class="searchOuterBlock" id="search">
        <div class="searchBlock searchBlockFix">
            <div class="wrapper">
                <ul class="tabs" data-tabs="tabs">
                    <li class="<?=($_GET['find_pharmacy']==1?'':'active')?>">Каталог</li>
<!--                    <li>У меня болит</li>-->
                </ul>
                <ul class="tabsContent" data-bookmarks="bookmarks">
                    <li class=" catalog-tab <?=($_GET['find_pharmacy']==1?'':'active')?>">
                        <div class="content">
                            <?

                            $GLOBALS['sectionsFilter']=array(
                                'DEPTH_LEVEL'           =>1
                            );
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section.list",
                                "top",
                                array(
                                    "IBLOCK_TYPE" => '',
                                    "IBLOCK_ID" => 18,
                                    "SECTION_ID" => 0,
                                    "SECTION_CODE" => '',
                                    "TOP_DEPTH" => 1,
                                    'FILTER_NAME'       =>'sectionsFilter',
                                    'SECTION_USER_FIELDS'       =>array('UF_ICON')
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y"));
                            ?>
                        </div>
                    </li>
                    <?if(1==0):?>
                    <li>
                        <div class="accordion-tab">
                            <?
                            $APPLICATION->IncludeComponent(
                                "galior:symptomes",
                                "",
                                Array()
                            );
                            ?>
                        </div>
                    </li>
                    <?endif;?>

                </ul>
            </div>
        </div>
    </div>
<div class="clearfix"></div>
<?




//$APPLICATION->IncludeComponent(
//		"bitrix:catalog.section.list",
//		"top",
//		array(
//				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
//				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
//				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
//				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
//				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
//				"CACHE_TIME" => $arParams["CACHE_TIME"],
//				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
//				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
//				"TOP_DEPTH" => 1,
//				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
//				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
//				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
//				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
//				"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
//				'FILTER_NAME'       =>'sectionsFilter',
//				'SECTION_USER_FIELDS'       =>array('UF_ICON')
//		),
//		$component,
//		array("HIDE_ICONS" => "Y"));






$APPLICATION->IncludeComponent(
    "galior:hit",
    "",
    array(
    )
);


	$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
    );?><br>
	<?unset($basketAction);
