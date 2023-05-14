<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();




if(!empty($arResult['PROPERTIES']['IMAGES']['VALUE'])) {
    $newImages = array();
    foreach ($arResult['PROPERTIES']['IMAGES']['VALUE'] as $IMAGE) {
        $newImages[] = CFile::GetPath($IMAGE);
    }

    $arResult['PRODUCT_IMAGES'] = $newImages;


}
$price=CatalogProduct::getProductPrice($arResult['ID'])['PRICE'];
$priceDisc=CatalogProduct::getProductPrice($arResult['ID'], 2)['PRICE'];
$pricePromo=CatalogProduct::getProductPrice($arResult['ID'], 3)['PRICE'];

$is_promo=(IblockElement::getPropValByCode($arResult, 'PROMO')=='Да'?1:0);
if(!$is_promo){
    $arResult['BASE_PRICE']=$price;
    $arResult['DISC_PRICE']=$priceDisc;
}
else{
    $arResult['BASE_PRICE']=$price;
    $arResult['DISC_PRICE']=$pricePromo;
}

if($brand_id=IblockElement::getPropValByCode($arResult, 'BRAND')){
    $hlBrand=new HLElement(3);



    $arResult['PROPERTIES']['BRAND']['VALUE']=array_pop(
        $hlBrand->getList(
            array(),
            array(
                'UF_XML_ID'        =>$brand_id
            )
        )
    )['UF_NAME'];



}


$arResult['RELATED']=IblockElement::getList(
    array('NAME'=>'ASC'),
    array(
        '!ID'                   =>$arResult['ID'],
        'SECTION_ID'            =>$arResult['IBLOCK_SECTION_ID'],
        'IBLOCK_ID'             =>18,
        '>CATALOG_PRICE_1'      =>0
    ),
    false,
    array("nTopCount" => 12),
    array(
        'ID', 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE'
    )
);

$relatedIDs=ArrayUtil::getKeyColumns(
    $arResult['RELATED'],
    'ID'
);

$relatedPricesBase=CatalogProduct::getProductPrices($relatedIDs, 1);
$relatedPricesDisc=CatalogProduct::getProductPrices($relatedIDs, 2);
$relatedPricesPromo=CatalogProduct::getProductPrices($relatedIDs, 3);


foreach ($arResult['RELATED'] as $key=>$item) {
    $arResult['RELATED'][$key]['PRICES']=array(
        'BASE'              =>$relatedPricesBase[$item['ID']]['PRICE'],
        'PROMO'              =>$relatedPricesPromo[$item['ID']]['PRICE'],
        'DISCOUNT'          =>$relatedPricesDisc[$item['ID']]['PRICE'],
    );
    if($picID=$item['DETAIL_PICTURE']){
        $arResult['RELATED'][$key]['PICTURE']=CFile::getPath($picID);
    }
    else{
        $item['PICTURE']=BxCache::cache(
            'AJAX_DEFAULT_IMAGE_BY_PRODUCT_'.$item['ID'],
            3*3600,
            function ()use($item) {
                $section=IblockSection::getNavArr(
                    IBLOCK_CATALOG, $item['IBLOCK_SECTION_ID'],
                    array('UF_*', 'ID', 'IBLOCK_ID', 'CODE', 'PICTURE')
                )[0];



                return BxFile::getImgSrcById($section['PICTURE'], array(300,300));

            }

        );
        $arResult['RELATED'][$key]['PICTURE']=$item['PICTURE'];

    }
}//foreach


$arResult['SECTION_INFO']=IblockSection::getById(
    $arResult['IBLOCK_SECTION_ID']
);

