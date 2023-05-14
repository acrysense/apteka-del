<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if(count($arResult['BANNERS']) > 0):
?>
<div id="owl-carousel" class="owl-carousel section1">
    <?foreach($arResult["BANNERS_PROPERTIES"] as $k => $banner):

        $banner['IMAGE'] = CFile::GetFileArray($banner['IMAGE_ID']);
        ?>

        <?if($banner['URL'] != ''):?>
        <a href="<?=$banner['URL'];?>" target="<?=$banner['URL_TARGET'];?>"><img src="<?=$banner['IMAGE']['SRC'];?>" width="100%" alt="<?=$banner['IMAGE_ALT'];?>" title="<?=$banner['IMAGE_ALT'];?>"></a>
        <?else:?>
        <img src="<?=$banner['IMAGE']['SRC'];?>" width="100%" alt="<?=$banner['IMAGE_ALT'];?>" title="<?=$banner['IMAGE_ALT'];?>">
        <?endif;?>

    <?endforeach;?>
</div>
<?endif;?>
<?
/*
if($USER->IsAdmin()):
	echo "<pre>"; echo print_r($arResult); echo "</pre>";
endif;
*/
?>
