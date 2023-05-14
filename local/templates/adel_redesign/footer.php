<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc,
    Galior\Core\IblockMessages as IM;
Loc::loadMessages(__FILE__);
IM::initMessages();
?>
<? if($page != '/'):?>
    <?if(in_array($arPage[1], $showRightSide)):?>
        </div>
    <?endif;?>
<?endif;?>

<? if(in_array($arPage[1], $showRightSide)):?>
<div class="rightSide">
    <? $APPLICATION->IncludeComponent(
	"galior:instagram", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"INSTAGRAM_USER" => "apteka_adel",
		"INSTAGRAM_KEY" => "5315426658.37e9b61.9d47986edeff4fd3a0ddb340e88e55f8",
		"INSTAGRAM_COUNT" => "10",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "COMPONENT_TEMPLATE" => ".default",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/bitrix/templates/adel/page_templates/RightSideSocialServices.php",
            "AREA_FILE_RECURSIVE" => "Y"
        )
    );?>
</div>
<? endif;?>

<? if($page != '/'):?>

    </div>
</main>
<!-- #Main ------------------------------------------------------------------------------------------------------------>
<? endif;?>

<? if($page == '/'):?>



    <? $APPLICATION->IncludeComponent(
	"galior:instagram",
	"HomeInstagram",
	array(
		"COMPONENT_TEMPLATE" => "HomeInstagram",
		"INSTAGRAM_USER" => "apteka_adel",
		"INSTAGRAM_KEY" => "5315426658.37e9b61.9d47986edeff4fd3a0ddb340e88e55f8",
		"INSTAGRAM_COUNT" => "5",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "HomeAdvantage",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(0=>"",1=>"",),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "5",
            "IBLOCK_TYPE" => "advantages",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(0=>"FILE_ICON",1=>"",),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>

<div class="section5">
    <div class="wrapper">
        <a href="/partnerskie-programmy/"><h2>Партнерские программы</h2></a>
        <div id="owl-carousel-insurance" class="owl-carousel">

            <?
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
            $arFilter = Array("IBLOCK_ID" => intval(13), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $rsElement = CIBlockElement::GetList(array("ID" => "ASC"), $arFilter, false, false, $arSelect);
            $rsElement->SetUrlTemplates('/partnerskie-programmy/#ELEMENT_CODE#/');

            while($obElement = $rsElement->GetNextElement()):

                $arItem = $obElement->GetFields();
                $arItem['PREVIEW_PICTURE'] = CFile::GetFileArray($arItem['PREVIEW_PICTURE']);
            ?>

                <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="item">
                    <div class="thumb" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC'];?>')"></div>
                    <div class="name"><?=$arItem['NAME'];?></div>
                </a>

            <?endwhile;?>

        </div>

    </div>
</div>

<?endif;?>


<? $APPLICATION->IncludeComponent(
	"galior:main.feedback", 
	"Feedback", 
	array(
		"EMAIL_TO" => "info@apteka-adel.by",
//		"EMAIL_TO" => "gwyllium@gmail.com",
//		"EMAIL_TO" => "test-uf6o5@mail-tester.com",
		"EVENT_MESSAGE_ID" => array(
			0 => "82",
		),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => "Feedback"
	),
	false
);?>

<div class="section7">
    <div class="wrapper">

        <div class="left">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/bitrix/templates/adel/page_templates/FooterCopyright.php",
                    "AREA_FILE_RECURSIVE" => "Y"
                )
            );?>
        </div>

        <div class="contacts">
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
            <div class="email">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/bitrix/templates/adel/page_templates/Email.php",
                        "AREA_FILE_RECURSIVE" => "Y"
                    )
                        );?>
            </div>
            <div class="socIcons">
                <a href="https://www.instagram.com/apteka_adel/" target="_blank" rel="nofollow" class="icon-instagram"></a>
                <!--<a href="#" target="_blank" rel="nofollow" class="icon-facebook"></a>-->
                <a href="https://vk.com/apteka_adel" target="_blank" rel="nofollow" class="icon-vk"></a>
            </div>
        </div>
        
        
        
        <?
	        global $USER;
        	if($USER->IsAdmin()):
		?>
                <div class="subscribe">
                    <a href="javascript:void(0);" class="btn">
                        <i class="icon-letter-empty"></i>
                        <span>Подписаться</span>
                    </a>
                    <div class="text">Чтобы быть в курсе последних новостей Adel</div>
                </div>
        <? endif;?>
        
        
        
                <div class="developer">
                    <a href="https://galior.com/" rel="nofollow" class="icon-galior webStudia"></a>

                </div>

            </div>

            <div class="link-totop">
                <span class="icon-arrow-top"></span>
            </div>

        </div>

        <div class="overlay win" id="WinSubscribe">
            <div class="innerOverlay">
                <div class="popup">
                    <span class="closeIcon"></span>
                    <div class="">
                        <? $APPLICATION->IncludeComponent(
                            "galior:sender.subscribe",
                            "Subscribe",
                            Array(
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "Y",
                                "AJAX_OPTION_JUMP" => "Y",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_TIME" => "3600",
                                "CACHE_TYPE" => "N",
                                "CONFIRMATION" => "Y",
                                "HIDE_MAILINGS" => "Y",
                                "SET_TITLE" => "N",
                                "SHOW_HIDDEN" => "N",
                                "USER_CONSENT" => "N",
                                "USER_CONSENT_ID" => "0",
                                "USER_CONSENT_IS_CHECKED" => "Y",
                                "USER_CONSENT_IS_LOADED" => "N",
                                "USE_PERSONALIZATION" => "N",
                                "RELEASE_TEMPLATE" => "2"
                            )
                        );?>
                    </div>
                </div>
            </div>
        </div>

        <? if($USER->IsAdmin()): ?>
        <div class="overlay win" id="auto-popup-subscribe">
            <div class="innerOverlay">
                <div class="popup" style="background-image: url('/bitrix/templates/adel/img/banner1.jpg');">
                    <span class="closeIcon" data-id="auto-popup-subscribe"></span>
                    <div class="">
                        <? $APPLICATION->IncludeComponent(
                            "galior:sender.subscribe",
                            "AutoPopupSubscribe",
                            Array(
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "Y",
                                "AJAX_OPTION_JUMP" => "Y",
                                "AJAX_OPTION_STYLE" => "Y",
                                "CACHE_TIME" => "3600",
                                "CACHE_TYPE" => "A",
                                "CONFIRMATION" => "Y",
                                "HIDE_MAILINGS" => "Y",
                                "SET_TITLE" => "N",
                                "SHOW_HIDDEN" => "N",
                                "USER_CONSENT" => "N",
                                "USER_CONSENT_ID" => "0",
                                "USER_CONSENT_IS_CHECKED" => "Y",
                                "USER_CONSENT_IS_LOADED" => "N",
                                "USE_PERSONALIZATION" => "N",
                                "RELEASE_TEMPLATE" => "2"
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
        <? endif; ?>

<div class="overlay win" id="WinRegistrationOk">
    <div class="innerOverlay">
        <div class="popup">
            <span class="closeIcon"></span>
            <div style="
    color: #333333;
    font-family: 'RalewayBold', Arial, sans-serif;
    font-size: 24px;
    line-height: 36px;
    text-transform: uppercase;
"><?=IM::getMessageTitle('REGISTRATION_OK');?></div>
            <?=IM::getMessageTemplate('REGISTRATION_OK');?>
        </div>
    </div>
</div>

<div class="overlay win" id="WinForgotPasswordOk">
    <div class="innerOverlay">
        <div class="popup">
            <span class="closeIcon"></span>
            <div style="
                color: #333333;
                font-family: 'RalewayBold', Arial, sans-serif;
                font-size: 24px;
                line-height: 36px;
                text-transform: uppercase;
            "><?=IM::getMessageTitle('FORGOT_PASSWORD_OK');?></div>
            <?=IM::getMessageTemplate('FORGOT_PASSWORD_OK');?>
        </div>
    </div>
</div>

<div class="overlay win" id="modalPhoneCode">
    <div class="innerOverlay">
        <div class="popup">
            <span class="closeIcon"></span>
            <div style="color: red; font-size: 28px; font-weight: bold; margin-bottom: 15px;">Ошибка</div>
            <div>К сожалению не удалось выслать код подтверждения, возможно Вы ввели неверный номер телефона или код подтверждения, пожалуйста попробуйте еще раз!</div>
        </div>
    </div>
</div>



<div class="overlay win" id="modalPoints">
    <div class="innerOverlay">
    
        <div class="popup">
            <span class="closeIcon"></span>
<form>
            <div class="ms-subscribe-title">Бонусные баллы</div>

			<div class="modal-body b-modal-points__form">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">Чтобы узнать количество бонусных баллов,<br>
                                введите номер вашей дисконтной карты
                            </p>
                        </div>
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                            <p class="text-center">
                                <input placeholder="XXX-XXX-XXX-XXX-X" style="text-align:center;" type="text" name="points_input" class="jsMaskCard" data-rule-required="true" data-rule-jsMethodCheckMaskCard="true" data-msg-required="Это поле обязательно к заполнению" data-msg-jsMethodCheckMaskCard="Введите полный номер телефона">
                            </p>
                        </div>
                    </div>
             </div>
                
             <div class="modal-body b-modal-points__success" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <div align="center">
                                <p><strong>Ваши бонусные баллы</strong></p>
                                <h2 class="b-modal-points__points color-green"></h2><br>
                                <p>Накапливайте баллы, совершая покупки в аптеках ADEL!</p>
                            </div>
                        </div>
                    </div>
             </div>
             <div class="modal-body b-modal-points__error" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <p><b>Возникла ошибка!</b></p>
                                <span>Возможно, Вы ввели неверный номер карты или возникла ошибка на стороне сервиса.</span>
                            <p>
                        </div>
                    </div>
             </div>
             
                <div class="modal-footer">
                    <button id="points-submit" type="button" class="btn">Проверить</button>
                    <button type="button" class="btn b-modal-points__back" style="display: none;">Назад</button>
                 </div>
  </form>
        </div>
 
    </div>
</div>



<?
/*
global $USER;
if($USER->IsAdmin()):
?>

    <script type="text/javascript">
        $(document).ready(function(){

            $('.developer').on('click', function(event) {
                OpenWin('WinForgotPasswordOk');
                event.preventDefault();
            });

        });
    </script>

<?

//echo "<pre>"; echo print_r(SITE_TEMPLATE_PATH); echo "</pre>";
endif;
*/




        /*$Asset->addJs(SITE_TEMPLATE_PATH.'/constants.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/wow.min.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.formstyler.min.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/owl.carousel.min.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.maskedinput.min.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.validate.min.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/additional-methods.min.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.dotdotdot.min.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/lightbox.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/sticky.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/slideshow.js');
        $Asset->addJs(SITE_TEMPLATE_PATH.'/js/custom.js');*/
?>

<script src="/constants.js"></script>



<script src="<?=BxPath::tPath('/js/wow.min.js')?>"></script>
<script src="<?=BxPath::tPath('/js/jquery.formstyler.min.js')?>"></script>
<script src="<?=BxPath::tPath('/js/owl.carousel.min.js')?>"></script>
<script src="<?=BxPath::tPath('/js/jquery.maskedinput.min.js')?>"></script>
<script src="<?=BxPath::tPath('/js/jquery.validate.min.js')?>"></script>
<script src="<?=BxPath::tPath('/js/additional-methods.min.js')?>"></script>
<script src="<?=BxPath::tPath('/js/jquery.dotdotdot.min.js')?>"></script>

<script src="<?=BxPath::tPath('/js/lightbox.js')?>"></script>
<script src="<?=BxPath::tPath('/js/sticky.js')?>"></script>
<script src="<?=BxPath::tPath('/js/slideshow.js')?>"></script>
<script src="<?=BxPath::tPath('/js/custom.js')?>"></script>




</body>
</html> 