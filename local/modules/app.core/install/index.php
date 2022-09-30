<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

class app_core extends CModule
{
    public $MODULE_ID = 'app.core';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    public function __construct()
    {
        $moduleVersion = [];

        require_once __DIR__ . '/version.php';

        $this->MODULE_VERSION = $moduleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $moduleVersion['VERSION_DATE'];

        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');

        $this->PARTNER_NAME = Loc::getMessage('PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('PARTNER_URI');
    }

    /**
     * Install module.
     *
     * @return bool
     */
    public function DoInstall(): bool
    {
        if (ModuleManager::isModuleInstalled('app.core')) {
            return false;
        }

        if (!check_bitrix_sessid()) {
            return false;
        }

        ModuleManager::registerModule('app.core');

        return true;
    }

    /**
     * Uninstall module.
     *
     * @return false
     */
    public function DoUninstall(): bool
    {
        if (!ModuleManager::isModuleInstalled('app.core')) {
            return false;
        }

        ModuleManager::unRegisterModule('app.core');

        return true;
    }
}
