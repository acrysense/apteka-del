<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<?
if ($arParams['SILENT'] == 'Y')
    return;

//$path = $component->getTemplate()->GetFolder();

$cnt = strlen($arParams['INPUT_NAME_FINISH']) > 0 ? 2 : 1;
?>
<div class="Calendar">
<?
for ($i = 0; $i < $cnt; $i++):
	if ($arParams['SHOW_INPUT'] == 'Y'):
?>

<input onclick="MsCalendar(this);" type="text" id="<?=$arParams['INPUT_NAME'.($i == 1 ? '_FINISH' : '')]?>" name="<?=$arParams['INPUT_NAME'.($i == 1 ? '_FINISH' : '')]?>" value="<?=$arParams['INPUT_VALUE'.($i == 1 ? '_FINISH' : '')]?>" data-rule-required="true" data-msg-required="Это поле обязательно к заполнению" <?=(Array_Key_Exists("~INPUT_ADDITIONAL_ATTR", $arParams)) ? $arParams["~INPUT_ADDITIONAL_ATTR"] : ""?>/>
<?endif;?>
<div class="Calendar-icon" onclick="BX.calendar({node:this, field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['INPUT_NAME'.($i == 1 ? '_FINISH' : '')]))?>', form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>', bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>, currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>', bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>});"></div>
<?if ($cnt == 2 && $i == 0):?>
<span class="date-interval-hellip">&hellip;</span>

<?endif;?>

<?endfor;?>
    <script>
        function MsCalendar(node){
            BX.calendar({
                node: node,
                field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['INPUT_NAME']));?>',
                form: '<?if ($arParams['FORM_NAME'] != ''){echo htmlspecialcharsbx(CUtil::JSEscape($arParams['FORM_NAME']));}?>',
                bTime: <?=$arParams['SHOW_TIME'] == 'Y' ? 'true' : 'false'?>,
                currentTime: '<?=(time()+date("Z")+CTimeZone::GetOffset())?>',
                bHideTime: <?=$arParams['HIDE_TIMEBAR'] == 'Y' ? 'true' : 'false'?>
            });
        }
    </script>
</div>