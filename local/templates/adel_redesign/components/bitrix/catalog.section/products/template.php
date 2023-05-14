<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */


$this->setFrameMode(true);

$page = $APPLICATION->GetCurPage();

$this->addExternalJS(BxPath::tPath('/js/scripts/UrlUtil.js'));

?>

<input type="hidden" id="section_id" value="<?=$arResult['ORIGINAL_PARAMETERS']['SECTION_ID']?>">


<div class="current-catalog">
	<div class="wrapper">
		<?
        $APPLICATION->IncludeComponent(
            "galior:menu",
            "",
            array()
        );
        ?>
		<div class="wrapper-catalog">
			<div class="navigation-product ">
				<div class="mobile-menu">
					<div class="icon open-sidebar" style="background-image: url('<?=BxPath::tPath('/img/icon-list2.svg')?>')"></div>
				</div>

					<?



                    if($arParams['SHOW_FILTER']!='no'):?>
                        <div class="left-block">
                            <select class="brand" id="select_search_brands">
                                <option selected   value="0">Бренд</option>
                                <? foreach ($arResult['BRANDS'] as $brand): ?>
                                    <option value="<?=$brand['UF_XML_ID']?>" <?if($_GET['brand']==$brand['UF_XML_ID']) echo 'selected'?>><?=$brand['UF_NAME']?></option>
                                <? endforeach;?>
                            </select>
                            <div class="check-recept">
                                <input id="check-rec" type="checkbox" <?if($_GET['recipe']==1) echo 'checked'?> placeholder="По рецепту">

                                <label for="check-rec" class="left">По рецепту</label>
                                <input id="check-norec" type="checkbox"  <?if($_GET['recipe']==-1) echo 'checked'?>>

                                <label for="check-norec" class="right">Без рецепта</label>
                            </div>

                            <?
                            if($_GET['sort']=='price'){
                                $sort_mode='price';
                            }
                            else{
                                $sort_mode='name';
                            }

                            if($_GET['order']=='desc'){
                                $sort_mode.='-down';
                            }
                            else{
                                $sort_mode.='-up';
                            }




                            ?>

                            <div class="check-another">
                                <div class="sort-position ">
                                    <div class="item_sort_arrow item-sort <?if($_GET['sort']=='price') echo 'active green'?>">Цена</div>
                                    <div class="item_sort_arrow jq-selectbox__trigger-arrow no-rotate  <?if($sort_mode=='price-down') echo 'active green'?>" data-name="price-down"></div><?//active green?>
                                    <div class="item_sort_arrow jq-selectbox__trigger-arrow rotate <?if($sort_mode=='price-up') echo ' green'?>" data-name="price-up"></div><?// green?>
                                </div>
                                <div class="sort-position second-sort">
                                    <div class="item_sort_arrow item-sort <?if($_GET['sort']=='name') echo 'active green'?>">Название</div>
                                    <div class="item_sort_arrow jq-selectbox__trigger-arrow no-rotate <?if($sort_mode=='name-down') echo 'active green'?>" data-name="name-down"></div> <?//active green?>
                                    <div class="item_sort_arrow jq-selectbox__trigger-arrow rotate  <?if($sort_mode=='name-up') echo ' green'?>" data-name="name-up"></div> <?// green?>
                                </div>
                                <input type="hidden" id="form_sort" name="form_sort" value="<?=$sort_mode?>">

                        </div>
                    <?else:?>
                    <div class="left-block">
                        тут что-то будет написано
                    </div>
                    <?endif;?>

			</div>



		</div>
            <div class="items" id="catalog_items_list">
                <?foreach ($arResult['ITEMS'] as $item):?>
                    <?if(1==0):?>
                        <!--					<div class="wrapper-item">-->
                        <!--						<a href="--><?//=$item['DETAIL_PAGE_URL']?><!--" class="item">-->
                        <!--							<div class="block-img">-->
                        <!--								<img class="thumb" src="--><?//=$item['DETAIL_PICTURE']?><!--" alt="Шампунь">-->
                        <!--							</div>-->
                        <!--							<div class="block">-->
                        <!--								<h2 class="name ellipsis">--><?//=$item['NAME']?>
                        <!--								</h2>-->
                        <!--								<div class="price stock-item">-->
                        <!--<!--									<div class="old-price">5,60</div>-->-->
                        <!--									<div class="new-price"><span class="black">--><?//=($item['PRICE']?$item['PRICE']:'--')?><!--</span> руб.</div>-->
                        <!--								</div>-->
                        <!--							</div>-->
                        <!--						</a>-->
                        <!--						<div class="book">-->
                        <!--                            --><?//if($item['PRICE']):?>
                        <!--							<div class="btn-order btn_reserve_product" data-id="--><?//=$item['ID']?><!--" data-count="1">Бронировать</div>-->
                        <!--							--><?//endif;?>
                        <!--						</div>-->
                        <!--					</div>-->
                    <?endif;?>
                <?endforeach;?>


            </div>


            <div class="give-more">
                <div class="return">
                    <span class="icon-arrow-left"></span>
                    <a href="/catalog/">
                        <span class="back">Полный каталог</span>
                    </a>
                </div>

                <div class="error-no-items" style="display: none">
                    Нет результатов
                </div>

                <button class="btn" id="show_more">Показать ещё</button>



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

<?
if(!empty($arResult['DESCRIPTION'])):
?>

<div class="block-text">
	<div class="wrapper">
		<div class="text">
			<p class="caption"><?=$arResult['NAME']?></p>
			<div>
                <?=$arResult['DESCRIPTION']?>
            </div>
		</div>
	</div>
</div>
<?endif;?>


<script>
    $(document).ready(function () {
        console.info('init??');
        <?
        if(empty($_GET['page'])){
            $page=1;
        }else{
            $page=$_GET['page'];
        }
        ?>
        c_Catalog.init(<?=$page?>);
        c_Catalog.init_ajax_list(<?=$page?>);
    });

</script>