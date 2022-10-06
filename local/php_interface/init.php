<?php

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

try {
    Loader::includeModule('iblock');
    Loader::includeModule('app.core');
} catch (LoaderException $e) {
    return;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
