<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);

if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);



if($arParams["SHOW_INPUT"] !== "N"):?>

		<div class="extended-search this-block" id="<?echo $CONTAINER_ID?>">
			<div class="wrapper-search wrapper">
				<div>
					<form id="form_id_1" action="<?echo $arResult["FORM_ACTION"]?>">
						<input id="<?echo $INPUT_ID?>"  type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" />&nbsp;
						<a href="/catalog/search/?q=" id="icon_search" class="icon-search"></a>
						<!--			<span class="found">Найдено: <span class="number">64</span></span>-->
						<!--			<span class="number mobile-size">64</span>-->
						
					</form>
				</div>
                <div class="search-items"></div>
			</div>
		</div>

<?endif?>



<!--			<input placeholder="Введите наименование товара" type="text" onkeyup="search_drop()" onfocusout="search_drop_close();">-->
<!---->





<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
	
	$("#title-search-input").change(function () {


        $("#icon_search").attr('href',  '/catalog/search/?q='+$(this).val());

    });
</script>
