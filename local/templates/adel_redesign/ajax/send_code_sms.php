<?php
/** @global CUser $USER */
/** @global CMain $APPLICATION */
define('STOP_STATISTICS', true);
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);
define("PUBLIC_AJAX_MODE", true);
define("NOT_CHECK_PERMISSIONS", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
header('Content-Type: application/json');

if(!check_bitrix_sessid())
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
    die();
}

if($_SERVER['REQUEST_METHOD'] != 'POST' ||
    !isset($_POST['event']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['siteId']) ||
    !is_string($_POST['siteId']) ||
    preg_match('/^[A-Za-z0-9_]{2}$/', $_POST['siteId']) !== 1 ||
    preg_match('/^[0-9()\-+ ]{10,}$/', $_POST['phone']) !== 1)
    die;

define('SITE_ID', $_POST['siteId']);

$arResult = array();

if($_POST['event'] == 'send'):

    $code = '';
    $chars = 'ABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789';
    $charsLen = strlen($chars)-1;
    for ($i = 0; $i < 4; $i++)
        $code .= substr($chars, rand(0, $charsLen), 1);

    // smsline.by
    $url        = "https://api.smsline.by/v3";
    $method     = "/messages/single/sms";
    $target     = "Apteka_ADEL";
    $login      = "apteka_grupp";
    $password   = "kkR4tTKRsV2H";
    $phone      = str_replace(array('+', '(', ')', '-'), '', $_POST['phone']);
    $message    = $code;

    $strMethod = str_replace('/', '', $method);

    $data = array(
        "target"    => $target,
        "msisdn"    => $phone,
        "text"      => $message
    );

    $strData = json_encode($data);

    $string = $strMethod.$strData;

    $ctx = hash_init('sha256', HASH_HMAC, $password);
    hash_update($ctx, $string);
    $hash = hash_final($ctx);

    $ch = curl_init($url.$method);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $strData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($strData),
            'Authorization-User: '.$login,
            'Authorization: Bearer '.$hash)
    );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    curl_close($ch);

    $_SESSION['MS_CODE_PHONE'] = array(
        'CODE' => $code,
        'PHONE' => $_POST['phone'],
        'FORMAT_PHONE' => $phone
    );

    $arResult['RESULT'] = json_decode($result, 1);

    if(isset($arResult['RESULT']['error']))
        $arResult['STATUS'] = 'ERROR';
    elseif(isset($arResult['RESULT']['message']))
        $arResult['STATUS'] = 'OK';

    $arResult['CODE'] = $code;
    $arResult['PHONE'] = $_POST['phone'];
    $arResult['FORMAT_PHONE'] = $phone;

    echo CUtil::PhpToJSObject($arResult);
endif;

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
die();