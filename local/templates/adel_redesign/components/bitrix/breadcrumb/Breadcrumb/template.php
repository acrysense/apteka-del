<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


/**
 * @global CMain $APPLICATION
 */


global $APPLICATION, $USER;


$arHome = array("TITLE" => "Главная", "LINK" => "/");


//delayed function must return a string

if (empty($arResult))

    return "";


array_unshift($arResult, $arHome);


$strReturn = '';


//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()

/*

$css = $APPLICATION->GetCSSArray();

if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))

{

	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";

}

*/


/*$arResult[1]['TITLE']*/


$strReturn .= '<div class="sectionMain">';

$strReturn .= '<div class="wrapper">';

$strReturn .= '<div class="outer">';

if (!$is_catalog = $APPLICATION->GetPageProperty("is_element_catalog")) {


    $strReturn .= '<h1>' . $APPLICATION->GetTitle() . '</h1>';

}

if (!$show_br = $APPLICATION->GetPageProperty("show_breadcrumbs")) {

    $strReturn .= '<div itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumbs ';

    if ($is_catalog) {

        $strReturn .= ' breadcrumbs-wide breadcrumbs-catalog';

    }

    $strReturn .= '">';


    $itemSize = count($arResult);

    for ($index = 0; $index < $itemSize; $index++) {

        $title = htmlspecialcharsex($arResult[$index]["TITLE"]);


        $nextRef = ($index < $itemSize - 2 && $arResult[$index + 1]["LINK"] <> "" ? ' itemref="bx_breadcrumb_' . ($index + 1) . '"' : '');

        $child = ($index > 0 ? ' itemprop="child"' : '');

        $arrow = '';//($index > 0? '<i class="fa fa-angle-right"></i>' : '');


        if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {

            $strReturn .= '

			    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
			    <a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemprop="item">

					<span itemprop="name">' . $title . '</span>
					<meta itemprop="position" content="'.($index + 1).'">

				</a>
                </span>
				';

        } else {

            $strReturn .= '

			<div class="bx-breadcrumb-item">

				' . $arrow . '
                
				<a class="bx-breadcrumb-item-last">' . $title . '</a>
                
                
			</div>';

        }

    }


    $strReturn .= '</div>';


}


$strReturn .= '</div></div></div>';

/*

if($USER->IsAdmin()):

    echo "<pre>"; echo print_r($APPLICATION->GetTitle()); echo "</pre>";

endif;

*/

return $strReturn;

