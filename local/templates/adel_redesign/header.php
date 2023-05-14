<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc,
    Galior\Core\IblockMessages as IM;

Loc::loadMessages(__FILE__);
IM::initMessages();

global $APPLICATION, $USER;

$page = $APPLICATION->GetCurPage();
$arPage = explode("/", $page);
$scheme = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];

$showRightSide = array(
    'news',
    'about',
    'programmy-loyalnosti',
    'strakhovanie',
    'partnerskie-programmy'
);



if($arPage[1] == 'personal' && $arPage[2] != '')
    $indexBreadcrumb = 1;
else
    $indexBreadcrumb = 0;

$Asset = Asset::getInstance();

$GLOBALS['topFilter']=array(
    'PROPERTY_HIT'            =>19,
    '>CATALOG_PRICE_1'           =>0,
    'IBLOCK_ID'             =>18
);

JSLoader::autoLoad();

?>
    <!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>-<?=strtoupper(LANGUAGE_ID);?>" prefix="og: http://ogp.me/ns#">
    <head>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(53927524, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53927524" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<meta name="yandex-verification" content="c7cafdaa8357403d" />
        <meta charset="utf-8" />
        <title><? $APPLICATION->ShowTitle()?></title>
        <? $APPLICATION->ShowMeta("keywords")?>
        <? $APPLICATION->ShowMeta("description")?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?=BxPath::tPath('/js/jquery-ui.min.js')?>"></script>

        <?
        CJSCore::Init(array("fx"));
        CJSCore::Init(array('ajax', 'popup'));
        $APPLICATION->ShowHead();
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/fonts.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/iconfonts.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/slidenav.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/slideshow.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/uikit.min.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/owl-carousel/owl.carousel.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/owl-carousel/owl.transitions.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/jquery-ui.min.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/jquery.formstyler.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/jquery.formstyler.theme.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/style.css');
//		$Asset->addCss(SITE_TEMPLATE_PATH.'/css/style_catalog.css');
//        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/fixing.css');
//
       $APPLICATION->ShowCSS();
//
//        $Asset->addJs('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
//        $Asset->addJs('https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAt_xPwj3JfqIZ4qi_g3hkfTQfYxDcfusY&libraries=geometry,places');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/wow.min.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.formstyler.min.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/owl.carousel.min.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.maskedinput.min.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.validate.min.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/additional-methods.min.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.dotdotdot.min.js');
//
//
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/geo.js');
//
//
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/uikit.min.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/lightbox.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/sticky.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/slideshow.js');
//
//
//
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/custom.js');
//        $Asset->addJs(SITE_TEMPLATE_PATH.'/script.min.js');


        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/fonts.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/fonts/icomoon/style.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/iconfonts.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/fonts/fonts/stylesheet.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/uikit.min.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/slidenav.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/slideshow.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/owl-carousel/owl.carousel.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/owl-carousel/owl.transitions.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/jquery.formstyler.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/jquery.formstyler.theme.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/jquery-ui.min.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/style.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/style_catalog.css');
        $Asset->addCss(SITE_TEMPLATE_PATH.'/css/fixing.css');
		?>

		<?/*<link href="<?=BxPath::tPath('/css/fonts.css')?>" rel="stylesheet"/>
		<link href="<?=BxPath::tPath('/fonts/icomoon/style.css')?>" rel="stylesheet"/>


		<link href="<?=BxPath::tPath('/css/iconfonts.css')?>" rel="stylesheet"/>
		<link href="<?=BxPath::tPath('/fonts/fonts/stylesheet.css')?>" rel="stylesheet"/>

		<link href="<?=BxPath::tPath('/css/uikit.min.css')?>" rel="stylesheet"/>
		<link href="<?=BxPath::tPath('/css/slidenav.css')?>" rel="stylesheet"/>
		<link href="<?=BxPath::tPath('/css/slideshow.css')?>" rel="stylesheet"/>

		<link href="<?=BxPath::tPath('/css/owl-carousel/owl.carousel.css')?>" rel="stylesheet">
		<link href="<?=BxPath::tPath('/css/owl-carousel/owl.transitions.css')?>" rel="stylesheet">


		<link href="<?=BxPath::tPath('/css/jquery.formstyler.css')?>" rel="stylesheet"/>
		<link href="<?=BxPath::tPath('/css/jquery.formstyler.theme.css')?>" rel="stylesheet"/>
        <link href="<?=BxPath::tPath('/css/jquery-ui.min.css')?>" rel="stylesheet"/>


		<link href="<?=BxPath::tPath('/css/style.css')?>" rel="stylesheet"/>
		<link href="<?=BxPath::tPath('/css/style_catalog.css')?>" rel="stylesheet"/>
        <link href="<?=BxPath::tPath('/css/fixing.css')?>" rel="stylesheet"/>*/?>

		<!--<link href="css/animate.css" rel="stylesheet" />-->


		<!--
		<script>
			new WOW().init();
		</script>
		-->


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

		<?





        ?>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-TWGLF8C');</script>
        <!-- End Google Tag Manager -->

        <?if(1==0):?>
        <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-184660-7KvCq';</script>
        <?endif;?>


        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAt_xPwj3JfqIZ4qi_g3hkfTQfYxDcfusY&sensor=false&libraries=geometry,places"></script>
        <script src="<?=BxPath::tPath('/js/google-map.js')?>"></script>
<meta name="google-site-verification" content="_3MxDmmkNphChW-dXGzca7xy24wVWgjawTcOoPjhn4U" />

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?160",t.onload=function(){VK.Retargeting.Init("VK-RTRG-367664-9mTxd"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-367664-9mTxd" style="position:fixed; left:-999px;" alt=""/></noscript>
    </head>
<body data-spy="scroll" data-target=".header" data-offset="101">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TWGLF8C"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="panel"><?$APPLICATION->ShowPanel();?></div>

    <div class="header">
        <div class="wrapper">

            <div class="top">

                <div class="mobileBtn">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

                <a href="/" class="logo">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/logo.svg" alt="Аптека Адель" style="width: 255px; height:26px;" />
                </a>

                <div class="rightBlock">

                    <div class="controls">

                    <?/*if($_SERVER['REMOTE_ADDR'] == '31.24.94.149'):?>
                        <a href="/personal/" class="icon-user"></a>
                        <a href="/personal/auth/" class="icon-key ms-btn-auth"></a>
                    <?else:?>
                        <!--<a href="/personal/auth/" class="icon-key ms-btn-auth"></a>-->
                    <?endif;*/?>

                        <!--<a href="javascript: void(0)" class="icon-cart"></a>-->




                        </a>
                    </div>


                    <div class="phones">
                        <span class="mob-operator life"></span>
                        <span class="mob-operator velcom"></span>
                        <span class="mob-operator mts"></span>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "COMPONENT_TEMPLATE" => ".default",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/bitrix/templates/adel/page_templates/Phone.php",
                                "AREA_FILE_RECURSIVE" => "Y"
                            )
                        );?>
                    </div>

                    <div class="controls">
                        <div class="search-block">
                            <?
                            $authorized=$_SESSION['GALIOR_CORE_USER']['AUTHORIZED']=='Y';
                            ?>
                            <form action="/catalog/search" method="get">
                            <input
                                    type="text"
                                    id="input_text_field_search_in_header_in_top"
                                    name="q" placeholder="Что ищем?"
                                    value="<?=htmlspecialchars($_GET['q']);?>"
                                    <?if(1==0):?>
                                    onfocusout="search_drop_close();"
                                    <?endif;?>

                            >
                                <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "url": "https://apteka-adel.by/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://apteka-adel.by/catalog/search/?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Сеть аптек ADEL",
  "url": "https://apteka-adel.by/",
  "sameAs": [
    "https://www.instagram.com/apteka_adel/",
    "https://vk.com/apteka_adel"
  ]
}
</script>
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Organization",
"url": "https://apteka-adel.by/",
"name": "Сеть аптек ADEL",
"email": "info@apteka-adel.by",
"logo": "https://apteka-adel.by/local/templates/adel_redesign/img/logo.svg",
"description": "Аптеки ADEL – крупнейшая в Беларуси сеть аптек. Сегодня она насчитывает более 100 аптек по всей территории РБ. Ежегодно количество аптек увеличивается, что позволяет нам быть ближе к покупателям и сохранять позиции лидера на фармацевтическом рынке страны."
}
</script>

                                <div id="search_items_conainter_for_header_search" class="extended-search">
                                <div class="search-items">

                                    <!--                <div class="items">-->
                                    <!--                    <a href="#" class="name">-->
                                    <!--                        АЛМАГЕЛЬ А (сусп. д/приема внутрь фл. 170 мл в комплекте с мерной ложкой №1) Balkanpharma-Troyan AD-Болгария-->
                                    <!--                    </a>-->
                                    <!--                    <div class="price-search">-->
                                    <!--                        <span class="old-price">20<span class="currency">руб.</span></span>-->
                                    <!--                        <span class="new-price">24<span class="currency">руб.</span></span>-->
                                    <!--                    </div>-->
                                    <!--                    <div class="button-search">-->
                                    <!--                        <a href="#">Подробнее</a>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->


                                </div>

                            </div>


                            <button type="submit" class="icon-search"></button>
                            <button type="submit" class="mob-button">Найти</button>
                            <div class="close-search icon-close"></div>
                            </form>
                        </div>
                        <a href="javascript: void(0)" class="icon-search mobile-search"></a>
                        <? if(1==0): ?>
                        <a href="/personal/" class="<? if($authorized){
                            echo 'icon-user color-green';
                        }
                        else{
                            echo 'icon-key';
                        }
                        ?>"></a>
                        <? endif;?>

                        <a href="javascript:void(0);" onClick="OpenWin('modalPoints');" class="icon-piggy-bank">

                           <? $APPLICATION->IncludeComponent(
                               "galior:cart_icon",
                               "",
                               array()
                           );?>
                        <!--<a href="javascript: void(0)" class="myScores">
                            <i class="icon-piggy-bank"></i>
                            <span>Мои баллы</span>
                        </a>-->
                    </div>
                    <a href="/catalog/" class="btn btn-red go-catalog">Каталог</a>

                </div>
            </div>

            <?
            $APPLICATION->IncludeComponent(
                "galior:topmenu",
                "",
                array()
            );
            ?>

        </div>
    </div>




<?if($page == '/'):?>

    <div class="BannerSearch" style="/*background-image: url('<?=SITE_TEMPLATE_PATH?>/img/banner1.jpg');*/">
        <div class="wrapper">







            <div class="Banner">
                <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner", 
	"Banner", 
	array(
		"ANIMATION_DURATION" => "500",
		"ARROW_NAV" => "1",
		"BS_ARROW_NAV" => "Y",
		"BS_BULLET_NAV" => "Y",
		"BS_CYCLING" => "N",
		"BS_EFFECT" => "fade",
		"BS_HIDE_FOR_PHONES" => "N",
		"BS_HIDE_FOR_TABLETS" => "N",
		"BS_INTERVAL" => "5000",
		"BS_KEYBOARD" => "Y",
		"BS_PAUSE" => "Y",
		"BS_WRAP" => "Y",
		"BULLET_NAV" => "2",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"CONTROL_NAV" => "Y",
		"CYCLING" => "N",
		"DEFAULT_TEMPLATE" => "-",
		"DIRECTION_NAV" => "Y",
		"EFFECT" => "random",
		"EFFECTS" => "",
		"HEIGHT" => "300",
		"JQUERY" => "Y",
		"KEYBOARD" => "N",
		"NOINDEX" => "N",
		"QUANTITY" => "10",
		"SCALE" => "N",
		"SPEED" => "500",
		"TYPE" => "ADEL_TOP",
		"WRAP" => "1",
		"COMPONENT_TEMPLATE" => "Banner",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
            </div>






            <div class="searchOuterBlock" id="search">
                <div class="searchBlock">
                    <div class="wrapper">
                        <ul class="tabs" data-tabs="tabs">
                            <li class="<?=($_GET['find_pharmacy']==1?'':'active')?>">Каталог</li>
<!--                            <li>У меня болит</li>-->
                            <li id="tab_pharmacy" onclick="c_Pharmacy.filter()" data-tab="findPharmacy" class="<?=($_GET['find_pharmacy']==1?'active':'')?>"><!--<i class="icon icon-search"></i>-->Найти аптеку</li>
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
                                            //'CACHE_TYPE'        =>'N',

                                            "TOP_DEPTH" => 1,
//                                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
//                                            "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
//                                            "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
//                                            "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
//                                            "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
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
                            <li  class="tab-green <?=($_GET['find_pharmacy']==1?'active':'')?>">
                                <?$APPLICATION->IncludeComponent("galior:pharmacy", "top", Array(),false)?>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            
            
            
            

        </div>
    </div>
    
    
    
    

<?
    $APPLICATION->IncludeComponent(
        "galior:hit",
        "",
        array(
        )
    );
    ?>
    
    
    


<?endif;?>



<?

    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "Breadcrumb",
        Array(
            "PATH" => "",
            "SITE_ID" => "s2",
            "START_FROM" => $indexBreadcrumb
        )
    );




?>

<?if(($page != '/') and (!CSite::InDir('/catalog/')) and (!CSite::InDir('/personal/orders/')) ):?>
    <!-- Main ------------------------------------------------------------------------------------------------------------>
    <main class="Content">
    <div class="wrapper">
    <?if(in_array($arPage[1], $showRightSide)):?>
    <div class="leftSide">
<?endif;?>
<?endif;?>

<script>
    function search_product(str){
        $.ajax({
            type: "GET",
            url: "/ajax/catalog.php",
            data: {
                validation: 1,
                request: 'search',
                str: str
            }
        }).done(function( data ) {

            $(".search-items.search-items-default").html('');
            $(".search-items-default .found-info").html('');
            data=JSON.parse(data);


            var items=data.items;
            var count=data.count;

            if(items.length>0){
                for(var i=0; i<items.length; i++){
                    var element_item=document.createElement('div');
                    $(element_item).addClass('items').appendTo(".search-items");

                    var el_link=document.createElement('a');
                    $(el_link).attr('href', items[i].link).addClass('name').appendTo($(element_item)).text(items[i].name);

                    if(items[i].price1){

                        var el_prices=document.createElement('div');
                        $(el_prices).addClass('price-search').appendTo($(element_item));

                        if(items[i].price1!=items[i].price2){
                            var el_old_price=document.createElement('span');
                            $(el_old_price).addClass('old-price').html('<span class="currency">руб.</span>')
                                .appendTo($(el_prices)).prepend(items[i].price1);
                        }





                        var el_new_price=document.createElement('span');
                        $(el_new_price).addClass('new-price').html('<span class="currency">руб.</span>')
                            .appendTo(el_prices).prepend(items[i].price2);

                        var el_button_search=document.createElement('div');
                        $(el_button_search).addClass('button-search').appendTo($(element_item));

                        var el_button_search_link=document.createElement('a');
                        $(el_button_search_link).text('Подробнее').attr('href', items[i].link).appendTo($(el_button_search));

                    }

                }

                $("#link_search_all").attr('href', '/catalog/search/?q='+str);
				console.log('new results');
				$("#found_info").html('');
                var el_found_info=document.createElement('span');
                //$(el_found_info).addClass('found').text('Найдено: ').appendTo('#found_info');
				$(el_found_info).addClass('found').text('Найдено: ');
				$("#found_info").html($(el_found_info));


                var el_found_number=document.createElement('span');
                $(el_found_number).addClass('number').text(count).appendTo($(el_found_info));



                $(".search-items.search-items-default").append('<div class="items give-all">' +
                    '<a href="/catalog/search/?q='+str+'" id="link_search_all">Показать все</a>' +
                    '</div>').show();

            }
        });
    }
    function search_product2(str){
        $.ajax({
            type: "GET",
            url: "/ajax/catalog.php",
            data: {
                validation: 1,
                request: 'search',
                str: str
            }
        }).done(function( data ) {


            $("#search_items_conainter_for_header_search .search-items").html('');
            $("#search_items_conainter_for_header_search .found-info").html('');
            data=JSON.parse(data);


            var items=data.items;
            var count=data.count;

            if(items.length>0){
                for(var i=0; i<items.length; i++){
                    var element_item=document.createElement('div');
                    $(element_item).addClass('items').appendTo("#search_items_conainter_for_header_search .search-items");

                    var el_link=document.createElement('a');
                    $(el_link).attr('href', items[i].link).addClass('name').appendTo($(element_item)).text(items[i].name);

                    if(items[i].price1){

                        var el_prices=document.createElement('div');
                        $(el_prices).addClass('price-search').appendTo($(element_item));

                        if(items[i].price1!=items[i].price2){
                            var el_old_price=document.createElement('span');
                            $(el_old_price).addClass('old-price').html('<span class="currency">руб.</span>')
                                .appendTo($(el_prices)).prepend(items[i].price1);
                        }



                        var el_new_price=document.createElement('span');
                        $(el_new_price).addClass('new-price').html('<span class="currency">руб.</span>')
                            .appendTo(el_prices).prepend(items[i].price2);

                        var el_button_search=document.createElement('div');
                        $(el_button_search).addClass('button-search').appendTo($(element_item));

                        var el_button_search_link=document.createElement('a');
                        $(el_button_search_link).text('Подробнее').attr('href', items[i].link).appendTo($(el_button_search));

                    }

                }

                $("#link_search_all").attr('href', '/catalog/search/?q='+str);

                var el_found_info=document.createElement('span');
                $(el_found_info).addClass('found').text('Найдено: ').appendTo('.found-info');


                var el_found_number=document.createElement('span');
                $(el_found_number).addClass('number').text(count).appendTo($(el_found_info));



                $("#search_items_conainter_for_header_search .search-items").append('<div class="items give-all">' +
                    '<a href="/catalog/search/?q='+str+'" id="link_search_all">Показать все</a>' +
                    '</div>').show();

            }
        });
    }

    $(document).ready(function () {
        var timer=null;
        $("#input_text_field_search_in_header_in_top").keyup(function (e) {

            if(e.keyCode==13){
                location.href=$(".icon-search").attr('href');
            }
            else{
                $(".icon-search").attr('href', '/catalog/search/?q='+$("#input_text_field_search_in_header_in_top").val());

                clearTimeout(timer);

                timer=setTimeout(function () {
                    var text=$("#input_text_field_search_in_header_in_top").val();

                    if(text.length>2) {
                        search_product2(text);
                    }

                }, 1000);
            }



        });
    });

</script>


