<?php

namespace App\Model\Catalog\Product;

use App\Model\Catalog\Offer\OfferTable;
use Bitrix\Iblock\Elements\{ElementProductTable, EO_ElementProduct_Collection};
use Bitrix\Main\{ArgumentException, Loader, LoaderException, ObjectPropertyException, SystemException};
use CCatalogSku;

class ProductTable extends ElementProductTable
{
    /**
     * Returns class of Object for current entity.
     *
     * @return string
     */
    public static function getObjectClass(): string
    {
        return ProductElement::class;
    }

    /**
     * Returns class of Object collection for current entity.
     *
     * @return string
     */
    public static function getCollectionClass(): string
    {
        return ProductCollection::class;
    }

    /**
     * Returns collection of Products with Offers.
     *
     * @return EO_ElementProduct_Collection
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function getWithOffers(): EO_ElementProduct_Collection
    {
        Loader::includeModule('catalog');

        $productCollection = self::query()
            ->setSelect([
                'ID',
                'NAME',
                'CODE',
                'IBLOCK_SECTION_ID',
                'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL',
            ])
            ->fetchCollection();

        $sku = CCatalogSku::getOffersList([$productCollection->getIds()], 1);

        foreach ($sku as $productId => $offersIds) {
            $offers = OfferTable::query()
                ->setSelect(['ID', 'NAME'])
                ->addFilter('ID', array_keys($offersIds))
                ->fetchCollection();

            $productCollection
                ->getByPrimary($productId)
                ->setOffers($offers);
        }

        return $productCollection;
    }

    /**
     * Returns Product link by ID.
     *
     * @param int $id
     * @return string|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function getLinkById(int $id): string|null
    {
        return self::query()
            ->setSelect([
                'ID',
                'NAME',
                'CODE',
                'IBLOCK_SECTION_ID',
                'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL',
            ])
            ->addFilter('ID', $id)
            ->fetchObject()
            ->getLink();
    }
}
