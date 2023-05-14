<?php

$parentsIds=ArrayUtil::getKeyColumns($arResult['SECTIONS'], 'ID');

$arResult['CHILDS']=ArrayUtil::groupMultiByField(
	IblockSection::getList(
	array('NAME'=>'ASC'),
	array(
		'SECTION_ID'            =>$parentsIds
	),
	false,
	array('ID', 'SECTION_ID', 'NAME', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL')
),'IBLOCK_SECTION_ID' );


