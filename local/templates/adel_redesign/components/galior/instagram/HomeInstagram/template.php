<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

//$this->setFrameMode(true);

$arResult['ITEMS'] = array_slice($arResult['ITEMS'], 0, 5);

if (!empty($arResult['ITEMS'])):

    ?>

    <div class="wrapper">


        <div class="HomeInstagram">

            <div class="HomeInstagram-title h2"><?= Loc::getMessage('INSTAGRAM_TPL_MSG_TITLE'); ?></div>


            <div class="HomeInstagram-items">

                <? foreach ($arResult['ITEMS'] as $item):

                    // ресайз фотки
                    //print_r($_SERVER["DOCUMENT_ROOT"].$item['site_path']);
                    $rif = CFile::ResizeImageFile( // уменьшение картинки для превью
                        $sourceFile = $_SERVER['DOCUMENT_ROOT'].$item['site_path'],
                        $destinationFile = $_SERVER['DOCUMENT_ROOT'] . "/upload/instagram/".md5($item['site_path']).".jpeg",
                        $arSize = array('width' => 212, 'height' => 200),
                        $resizeType = BX_RESIZE_IMAGE_EXACT,
                        array(),
                        85
                    );
                    $destinationFile2 = "/upload/instagram/".md5($item['site_path']).".jpeg";
                    ?>

                    <a href="<?= $item['link'] ?>" class="HomeInstagram-item" target="_blank" rel="nofollow">

                        <span class="HomeInstagram-item-img"
                              style="background-image:url(<?= $destinationFile2; ?>);"></span>

                    </a>

                <? endforeach; ?>

            </div>


            <div class="HomeInstagram-btn">

                <a href="https://www.instagram.com/apteka_adel/" target="_blank"
                   class="btn"><?= Loc::getMessage('INSTAGRAM_TPL_MSG_BTN'); ?></a>

            </div>

        </div>


    </div>

<? endif; ?>


<?

/*

if($USER->IsAdmin()):

	echo "<pre>"; echo print_r($arParams); echo "</pre>";

    echo "<pre>"; echo print_r(count($arResult['ITEMS']->data)); echo "</pre>";

endif;

*/

?>