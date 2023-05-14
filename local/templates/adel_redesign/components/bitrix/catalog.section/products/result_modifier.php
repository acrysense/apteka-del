<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */


$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$sectionsTOP=IblockSection::getList(
	array('NAME'=>'ASC'),
	array(
		'DEPTH_LEVEL'       =>1,
		'IBLOCK_ID'         =>18
	),
	false,
	array('ID', 'NAME', 'SECTION_PAGE_URL', 'IBLOCK_SECTION_ID')
);




$arResult['MENU']['TOP']=$sectionsTOP;

$childs=IblockSection::getList(
    array('NAME'=>'ASC'),
	array(
		'SECTION_ID'        =>ArrayUtil::getKeyColumns($sectionsTOP, 'ID')
	),
	false,
	array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL')
);

$arResult['MENU']['CHILDS']=ArrayUtil::groupMultiByField(
	$childs,
	'IBLOCK_SECTION_ID'
);



$arResult['MENU']['CHILDS2']=ArrayUtil::groupMultiByField(
	IblockSection::getList(
        array('NAME'=>'ASC'),
		array(
			'IBLOCK_ID'          =>18,
			'SECTION_ID'         =>ArrayUtil::getKeyColumns(
				$childs,
				'ID'
			),

		),
		false,
		array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL')
	),
	'IBLOCK_SECTION_ID'
);

foreach ($arResult['ITEMS'] as $key=>$item) {
	if(!empty($img=$item['DETAIL_PICTURE'])){

		$arResult['ITEMS'][$key]['DETAIL_PICTURE']= $img['SRC'];
	}
	else{
		$arResult['ITEMS'][$key]['DETAIL_PICTURE']=BxPath::tPath('/img/nimg.jpg');
	}

	$price=CatalogProduct::getProductPrice($item['ID'])['PRICE'];
	

    if($price) {

        $arResult['ITEMS'][$key]['PRICE'] = $price;
    }
    else{
        $arResult['ITEMS'][$key]['PRICE'] = '0';
    }
}


$hlBrands=new HLElement(3);

$arResult['BRANDS']=$hlBrands->getList(
    array('UF_NAME'=>'ASC')
);