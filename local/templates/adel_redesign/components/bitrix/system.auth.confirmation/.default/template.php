<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div style="max-width: 320px; margin: 0 auto; text-align: center;" class="confirmation">
<p><?echo $arResult["MESSAGE_TEXT"]?></p>
<?//here you can place your own messages
	switch($arResult["MESSAGE_CODE"])
	{
	case "E01":
		?><? //When user not found
		break;
	case "E02":
		?><? //User was successfully authorized after confirmation
		break;
	case "E03":
		?><? //User already confirm his registration
		break;
	case "E04":
		?><? //Missed confirmation code
		break;
	case "E05":
		?><? //Confirmation code provided does not match stored one
		break;
	case "E06":
		?><? //Confirmation was successfull
		break;
	case "E07":
		?><? //Some error occured during confirmation
		break;
	}
?>
<?if($arResult["SHOW_FORM"]):?>
	<form method="post" action="<?echo $arResult["FORM_ACTION"]?>">

        <div class="line">
            <span class="col-1"><input type="text" name="<?echo $arParams["LOGIN"]?>" value="<?echo $arResult["LOGIN"]?>" placeholder="Email" /></span>
        </div>

        <div class="line">
            <span class="col-1"><input type="text" name="<?echo $arParams["CONFIRM_CODE"]?>" value="<?echo $arResult["CONFIRM_CODE"]?>" placeholder="Код подтверждения" /></span>
        </div>

        <div class="bottom">
            <input class="btn regBtn" type="submit" value="<?echo GetMessage("CT_BSAC_CONFIRM")?>" />
        </div>

		<input type="hidden" name="<?echo $arParams["USER_ID"]?>" value="<?echo $arResult["USER_ID"]?>" />

	</form>
<?elseif(!$USER->IsAuthorized()):?>
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "", array());?>
<?endif?>
</div>