<?php

namespace App\Model\Catalog\Offer;

use Bitrix\Iblock\Elements\ElementOfferTable;

class OfferTable extends ElementOfferTable
{
    /**
     * Returns class of Object for current entity.
     *
     * @return string
     */
    public static function getObjectClass(): string
    {
        return OfferElement::class;
    }

    /**
     * Returns class of Object collection for current entity.
     *
     * @return string
     */
    public static function getCollectionClass(): string
    {
        return OfferCollection::class;
    }
}
