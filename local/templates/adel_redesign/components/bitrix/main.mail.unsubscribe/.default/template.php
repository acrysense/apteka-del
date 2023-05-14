<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

use Bitrix\Main\Localization\Loc;
use Galior\Core\IblockMessages as IM;
IM::initMessages();
/** @var CAllMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */

?>
<div class="main-mail-unsubscribe-box">
	<div class="main-mail-unsubscribe-main">
		<?if ($arResult['SITE_NAME']):?>
			<div class="main-mail-unsubscribe-subtitle">
				<?=htmlspecialcharsbx($arResult['SITE_NAME'])?>
			</div>
		<?endif;?>
		<div class="main-mail-unsubscribe-title"><?=IM::getMessageTitle('UNSUBSCRIBE')?></div>
		<form method="POST" action="<?=$arResult['FORM_URL']?>">
			<div class="main-mail-unsubscribe-inner">
				<?if($arResult["DATA_SAVED"] == 'Y'):?>
					<div class="main-mail-unsubscribe-content">
						<div class="main-mail-unsubscribe-content-item">
							<?=Loc::getMessage('MAIN_MAIL_UNSUBSCRIBE_SUCCESS')?>
						</div>
					</div>
				<?elseif(empty($arResult["ERROR"]) && !empty($arResult['LIST'])):?>
					<div class="main-mail-unsubscribe-content">
						<div class="main-mail-unsubscribe-content-item"><?=IM::getMessageTemplate('UNSUBSCRIBE')?></div>
						<?if (count($arResult['LIST']) > 1):?>
							<div class="main-mail-unsubscribe-content-item"><?=Loc::getMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_SELECT')?></div>
						<?endif;?>
					</div>
				<?endif;?>

				<?if(empty($arResult["ERROR"]) && !empty($arResult['LIST'])):?>
					<?if (count($arResult['LIST']) > 1):?>
						<div class="main-mail-unsubscribe-check-list">
							<?foreach($arResult['LIST'] as $item):?>
								<label class="main-mail-unsubscribe-check-list-item">
									<input type="checkbox" name="MAIN_MAIL_UNSUB[]" value="<?=$item['ID']?>" <?=($item['SELECTED'] ? 'checked' : '')?> class="main-mail-unsubscribe-checkbox">
									<span class="main-mail-unsubscribe-name" title="<?=htmlspecialcharsbx($item['DESC'])?>">
										<?=htmlspecialcharsbx($item['NAME'])?>
									</span>
								</label>
							<?endforeach;?>
						</div>
					<?else:?>
						<?foreach($arResult['LIST'] as $item):?>
							<input type="hidden" name="MAIN_MAIL_UNSUB[]" value="<?=$item['ID']?>">
						<?endforeach;?>
					<?endif;?>
				<?elseif(!empty($arResult["ERROR"])):?>
					<div class="main-mail-unsubscribe-content">
						<div class="main-mail-unsubscribe-content-item">
							<?=htmlspecialcharsbx($arResult["ERROR"])?>
						</div>
					</div>
				<?else:?>
					<div class="main-mail-unsubscribe-content">
						<div class="main-mail-unsubscribe-content-item">
							<?=Loc::getMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_EMPTY')?>
						</div>
					</div>
				<?endif;?>
			</div>
			<?if(empty($arResult["ERROR"]) && !empty($arResult['LIST'])):?>
				<input type="hidden" value="Y" name="MAIN_MAIL_UNSUB_BUTTON">
				<?=bitrix_sessid_post()?>


            <?if(!isset($_REQUEST['r']) && isset($_REQUEST['tag']) && strlen($_REQUEST['tag']) > 0):?>
				<button class="btn">
					<?=Loc::getMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_BUTTON_UNSUBSCRIBE')?>
				</button>
            <?else:?>
                    <a href="<?=SITE_DIR;?>" class="btn"><?=Loc::getMessage('MAIN_MAIL_UNSUBSCRIBE_TEMPL_DEFAULT_BUTTON_HOME')?></a>
            <?endif;?>

				<br><br>
				<?=htmlspecialcharsbx($arResult['WARNING'])?>
			<?endif;?>
		</form>
	</div>
</div>