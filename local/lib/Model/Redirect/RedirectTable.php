<?php

namespace App\Model\Redirect;

use Bitrix\Main\Entity\{DataManager, IntegerField, StringField};

class RedirectTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'hl_redirects';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
            ]),
            new StringField('SOURCE', [
                'required' => true,
                'column_name' => 'UF_SOURCE',
            ]),
            new StringField('DESTINATION', [
                'required' => true,
                'column_name' => 'UF_DESTINATION',
            ]),
        ];
    }
}
