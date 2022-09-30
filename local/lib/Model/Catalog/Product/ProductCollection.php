<?php

namespace App\Model\Catalog\Product;

use Bitrix\Iblock\Elements\EO_ElementProduct_Collection;

class ProductCollection extends EO_ElementProduct_Collection
{
    /**
     * Returns array of IDs.
     *
     * @return array
     */
    public function getIds(): array
    {
        $ids = [];

        foreach ($this->getAll() as $product) {
            $ids[] = $product->getId();
        }

        return $ids;
    }
}