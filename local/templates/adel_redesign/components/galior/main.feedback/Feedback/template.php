<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

?>
<div id="feedback-scroll" class="section6">
    <div class="wrapper">

        <h2>Задать вопрос</h2>
        <div class="description">Если у вас возникли вопросы, задайте их нам и мы обязательно ответим!</div>

<form id="feedback" action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
    <div class="line">
        <span class="col-3"><input type="text" name="user" value="<?=$arResult["AUTHOR_NAME"]?>" placeholder="Имя *" data-rule-required="true" data-rule-minlength="2" data-msg-required="Это поле обязательно к заполнению" data-msg-minlength="Введите не менее 2-х символов" /></span>
        <span class="col-3"><input type="text" name="phone" value="<?=$arResult["AUTHOR_PHONE"]?>" placeholder="Номер телефона *" class="jsMaskPhone" data-rule-required="true" data-rule-jsMethodCheckMaskPhone="true" data-msg-required="Это поле обязательно к заполнению" data-msg-jsMethodCheckMaskPhone="Введите полный номер телефона" /></span>
        <span class="col-3"><input type="text" name="email" value="<?=$arResult["AUTHOR_EMAIL"]?>" placeholder="Адрес email *" data-rule-required="true" data-rule-email="true" data-msg-required="Это поле обязательно к заполнению" data-msg-email="Нужно правильно ввести email" /></span>
    </div>
    <div class="line">
        <textarea name="question" placeholder="Напишите здесь Ваш вопрос *" data-rule-required="true" data-rule-minlength="5" data-msg-required="Это поле обязательно к заполнению" data-msg-minlength="Введите не менее 5-х символов"><?=$arResult["MESSAGE"]?></textarea>
    </div>
    <div class="bottom">
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        <input class="btn" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
    </div>
</form>

    </div>
</div>

<?if(!empty($arResult["ERROR_MESSAGE"])):
    //foreach($arResult["ERROR_MESSAGE"] as $v)
        //ShowError($v);
?>
<script>
    $(document).ready(function(){
        $('#feedback').valid();
    });
</script>
<?endif;?>

<?if(strlen($arResult["OK_MESSAGE"]) > 0):?>
    <div class="overlay win" id="msg">
        <div class="innerOverlay">
            <div class="popup">
                <span class="closeIcon"></span>
                <div class="message-ok"><?=$arResult["OK_MESSAGE"]?></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            OpenWin('msg');
        });
    </script>
<?endif;?>