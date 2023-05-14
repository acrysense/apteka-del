<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="registration auth">

<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>

<?if($arResult["AUTH_SERVICES"]):?>
	<div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>
<?endif?>

	<form id="authorization" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

        <div class="h2 modal-title">Войдите в аккаунт</div>
        <div class="key"><i class="icon-key"></i></div>

        <div class="line">
            <span class="col-1"><input type="text" name="USER_LOGIN" placeholder="Адрес email *" data-rule-required="true" data-rule-email="true" data-msg-required="Это поле обязательно к заполнению" data-msg-email="Нужно правильно ввести email" /></span>
        </div>
        <div class="line">
            <span class="col-1"><input type="password" name="USER_PASSWORD" placeholder="Пароль *" data-rule-required="true" data-msg-required="Это поле обязательно к заполнению" /></span>
        </div>

        <div class="bottom">
            <input class="btn regBtn" type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
            <div class="isAccount">Еще не зарегистрированы?</div>
            <?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
                <a class="btn" href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
            <?endif?>
        </div>

	</form>

</div>

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>