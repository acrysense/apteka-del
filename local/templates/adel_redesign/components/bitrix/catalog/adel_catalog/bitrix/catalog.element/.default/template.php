<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();use \Bitrix\Main\Localization\Loc;/** * @global CMain $APPLICATION * @var array $arParams * @var array $arResult * @var CatalogSectionComponent $component * @var CBitrixComponentTemplate $this * @var string $templateName * @var string $componentPath * @var string $templateFolder */$this->setFrameMode(true);//Debug::dump(//        $arResult['ACTIVE'],1,1//);$is_promo=(IblockElement::getPropValByCode($arResult, 'PROMO')=='Да'?1:0);$is_discount=(PriceSwitcher::getSumm()<=PriceSwitcher::getBasketTotal());?><input type="hidden" id="order_disc_summ" value="<?=PriceSwitcher::getSumm()?>"><input type="hidden" id="card_is_promo" value="<?=($is_promo?'1':'0')?>">			<div class="about-item <?if(empty($arResult['DETAIL_PICTURE']['SRC'])) echo 'item-nophoto'?>  uk-clearfix">				<div class="uk-clearfix <?if(empty($arResult['PRODUCT_IMAGES'])) echo 'one-pic'?>">					<?if(!empty($arResult['DETAIL_PICTURE']['SRC'])):?>						<div class="slider-item">							<div data-uk-slideshow="{}" class="slideshow">								<div uk-slideshow class="uk-slidenav-position">									<!--							<div class="sale">-->									<!--								<div class="hit">Хит</div>-->									<!--								<div class="stock">-10%</div>-->									<!--							</div>-->									<ul class="uk-slideshow-items  uk-slideshow-border uk-slideshow uk-overlay-active">										<li style="min-height: 300px;">											<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>">											<div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon">												<a class="uk-position-cover" data-lightbox-type="image"												   data-uk-lightbox="{group:'my-group'}"												   href="<?=$arResult['DETAIL_PICTURE']['SRC']?>"></a>											</div>										</li>                                        <?foreach ($arResult['PRODUCT_IMAGES'] as $img):?>                                            <li style="min-height: 300px;">                                                <img src="<?=$img?>">                                                <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon">                                                    <a class="uk-position-cover" data-lightbox-type="image"                                                       data-uk-lightbox="{group:'my-group'}"                                                       href="<?=$img?>"></a>                                                </div>                                            </li>                                        <?endforeach;;?>									</ul>                                    <?if(!empty($arResult['PRODUCT_IMAGES'])):?>                                    <a href="#" class="uk-slidenav  uk-slidenav-previous uk-hidden-touch"                                       data-uk-slideshow-item="previous"></a>                                    <a href="#" class="uk-slidenav  uk-slidenav-next uk-hidden-touch"                                       data-uk-slideshow-item="next"></a>                                    <?endif;?>								</div>                                <?if(!empty($arResult['PRODUCT_IMAGES'])):?>                                <div class="uk-overlay-panel uk-overlay-bottom">                                    <ul class="uk-thumbnav uk-flex-center">                                        <div class="owl-carousel" id="owl-slide">                                            <li class="item" data-uk-slideshow-item="0"><a href="#">                                                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"></a></li>                                            <?                                            $img_counter=1;                                            ?>                                            <?foreach ($arResult['PRODUCT_IMAGES'] as $image):?>                                            <li class="item" data-uk-slideshow-item="<?=$img_counter++?>"><a href="#"><img                                                            src="<?=$image?>"></a></li>                                            <?endforeach;;?>                                        </div>                                    </ul>                                </div>                                <?endif;?>							</div>						</div>					<?endif;?>					<div class="description">						<h1 class="h3"><?=$arResult['NAME']?></h1>                        <?if($USER->IsAdmin()):?>                            <span style="color:grey">{<?=IblockElement::getPropValByCode(                                    $arResult,                                    'ID_1C'                                )?>}</span>                        <?endif;?>						<br/>						<div class="book-item">							<div class="current-price red-price">                                <?if($arResult['BASE_PRICE']!=$arResult['DISC_PRICE']):?>                                <span class="old_price_card  <?=($is_discount?'no_active_price':'')?> "><?=($arResult['BASE_PRICE'])?></span>                                <span class="base_card_price  <?=($is_discount?'':'no_active_price')?>"><?=$arResult['DISC_PRICE']?></span>                                <?else:?>                                    <span class="base_card_price base_card_one no_calc"><?=$arResult['DISC_PRICE']?></span>                                <?endif;?>                                 <span class="rub">руб.</span></div>                            <?if($arResult['BASE_PRICE'] && $arResult['ACTIVE']=='Y'):?>							<div class="counter">								<button type="button" class="but counterBut dec">–</button>								<input                                        type="text"                                        class="field fieldCount"                                        id="product_counter_<?=$arResult['ID']?>"                                        data-id="<?=$arResult['ID']?>"                                        value="1"                                        data-min="1"                                        data-max="99"                                        onchange="c_Catalog.updateProductCount(this)"                                >								<button type="button" class="but counterBut inc">+</button>							</div>							<button class="btn btn-green btn_reserve btn_reserve_product_single" data-id="<?=$arResult['ID']?>">бронировать</button>                            <?endif;?>						</div>                        <?if($arResult['ACTIVE']=='N'):?>                            <div class="unavaliable_product">                                товар в данный момент недоступен                            </div>                        <?endif;?>						<div class="main-description">							<?foreach ($arResult['PROPERTIES'] as $prop):								?>								<?if(in_array($prop['CODE'], $GLOBALS['SHOW_PROPERTIES_CODES'])):								if(!empty($prop['VALUE'])):									?>									<div class="<?=strtolower($prop['CODE'])?>">										<span class="caption"><?=$prop['NAME']?>:</span>										<span class="text"><?=$prop['VALUE']?></span>									</div>								<?endif;?>							<?endif;?>							<?endforeach;?>						</div>                        <?                        ?>						<?if(!empty( IblockElement::getPropValByCode($arResult, 'RECIPE')  )):?>							<div class="ticket-recept">								<div class="info"><img src="<?=BxPath::tPath('/img/recept_2.svg')?>" alt="ticket" class="left-part">									<i class="icon-file-powerpoint-o"></i>									<img src="<?=BxPath::tPath('/img/recept_1.svg')?>" alt="ticket" class="right-part">Отпускается по рецепту								</div>							</div>						<?endif;?>						<?if(!empty($arResult['PREVIEW_TEXT'])):?>							<div class="about-this-item">								<h3>О товаре:</h3>								<p><?=$arResult['PREVIEW_TEXT']?>								</p>							</div>						<?endif;?>					</div>				</div>					<div class="detail-description">                        <?if(!empty($arResult['~DETAIL_TEXT'])):?>						<h3>Подробное описание</h3>						<div class="text">							<?=$arResult['~DETAIL_TEXT']?>						</div>						<div class="wrapper-read-more">							<p class="read-more">Читать далее<i class="ico-arrow"></i></p>						</div>                        <?endif;?>						<div class="buttons">                            <a id="link_return" href="<?=$arResult['SECTION_INFO']['SECTION_PAGE_URL']?>" class="btn">Вернуться в каталог</a>                            <?if(!empty($arResult['PREVIEW_TEXT'])):?>							<button class="btn btn_reserve_product_single" data-id="<?=$arResult['ID']?>">Бронировать</button>                            <?endif;?>						</div>					</div>			</div><?if(1==0):?><div class="best-buy">	<div class="wrapper">		<p class="caption">С этим товаром покупают</p>		<div class="owl-carousel" id="owl-best-buy-with">			<a href="#" class="item">				<div class="wrapper-thumb">					<div class="thumb" style="background-image: url('img/slide_1.jpg')"></div>				</div>				<div class="block">					<h2 class="name ellipsis">Название лекарства						дозировка или еще что					</h2>					<div class="price">						<div class="old-price">5,60</div>						<div class="new-price"><span class="black">4,80</span> руб.</div>					</div>				</div>			</a>			<a href="#" class="item">				<div class="wrapper-thumb">					<div class="thumb" style="background-image: url('img/slide_2.jpg')"></div>				</div>				<div class="block">					<h2 class="name ellipsis">Презики мощные 1500 штук					</h2>					<div class="price">						<div class="old-price">26,15</div>						<div class="new-price"><span class="black">24</span> руб.</div>					</div>				</div>			</a>			<a href="#" class="item">				<div class="wrapper-thumb">					<div class="thumb" style="background-image: url('img/slide_3.jpg')"></div>				</div>				<div class="block">					<h2 class="name ellipsis">Название лекарства						дозировка или еще что					</h2>					<div class="price stock-item">						<div class="old-price">18,99</div>						<div class="new-price"><span class="black">14,99</span> руб.</div>					</div>				</div>			</a>			<a href="#" class="item">				<div class="wrapper-thumb">					<div class="thumb" style="background-image: url('img/slide_4.jpg')"></div>				</div>				<div class="block">					<h2 class="name ellipsis">Название лекарства						дозировка или еще что					</h2>					<div class="price stock-item">						<div class="old-price">5,60</div>						<div class="new-price"><span class="black">4,80</span> руб.</div>					</div>				</div>			</a>			<a href="#" class="item">				<div class="wrapper-thumb">					<div class="thumb" style="background-image: url('img/slide_1.jpg')"></div>				</div>				<div class="block">					<h2 class="name ellipsis">Название лекарства						дозировка или еще что					</h2>					<div class="price">						<div class="old-price">5,60</div>						<div class="new-price"><span class="black">4,80</span> руб.</div>					</div>				</div>			</a>			<a href="#" class="item">				<div class="wrapper-thumb">					<div class="thumb" style="background-image: url('img/slide_2.jpg')"></div>				</div>				<div class="block">					<h2 class="name ellipsis">Название лекарства						дозировка или еще что					</h2>					<div class="price">						<div class="old-price">5,60</div>						<div class="new-price"><span class="black">4,80</span> руб.</div>					</div>				</div>			</a>		</div>	</div></div><?endif;?><?if(!empty($relatedItems=$arResult['RELATED'])):?><div class="best-buy bg-white">	<div class="wrapper">		<p class="caption">Похожие товары</p>		<div class="owl-carousel" id="owl-best-buy">			<? foreach ($relatedItems as $relatedItem): ?>                <a href="<?=$relatedItem['DETAIL_PAGE_URL']?>" class="item">                    <div class="wrapper-thumb">                        <div class="thumb" style="background-image: url('<?=$relatedItem['PICTURE']?>')"></div>                    </div>                    <div class="block">                        <h2 class="name ellipsis"><?=$relatedItem['NAME']?>                        </h2>                        <div class="price stock-item">                            <div class="old-price"><?=$relatedItem['PRICES']['BASE']?></div>                            <?if($relatedItem['PRICES']['BASE']!=$relatedItem['PRICES']['DISCOUNT']):?>                            <div class="new-price"><span class="black"><?=$relatedItem['PRICES']['DISCOUNT']?></span> руб.</div>                            <?endif;?>                        </div>                    </div>                </a>            <? endforeach;?>		</div>	</div></div><?endif;?><script src="<?=BxPath::tPath('/js/uikit.min.js')?>"></script><script>    $(document).ready(function () {        c_Catalog.updateCard();        setInterval(function () {            c_Catalog.checkBasketChanges()        }, 500)    })</script><script type="application/ld+json">{  "@context": "https://schema.org/",  "@type": "Product",  "name": "<?=$arResult['NAME'];?>",  "image": [    "<?=$arResult['DETAIL_PICTURE']['SRC'];?>"   ],  <?/*"description": "Sleeker than ACME's Classic Anvil, the Executive Anvil is perfect for the business traveler looking for something to drop from a height.",*/?>  "offers": {    "@type": "Offer",    "url": "<?=$arResult['DETAIL_PAGE_URL'];?>",    "priceCurrency": "BYN",    "price": "<?=($arResult['DISC_PRICE'] ? $arResult['DISC_PRICE'] : $arResult['BASE_PRICE']);?>",    <?/*"priceValidUntil": "<?=date('d.m.Y', time() + 2592000);?>",*/?>    "itemCondition": "https://schema.org/UsedCondition",    "availability": "https://schema.org/InStock",    "seller": {      "@type": "Organization",      "name": "Аптека ADEL"    }  }}</script>