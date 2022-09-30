<?php

namespace App\Model\Catalog\Product;

use Bitrix\Iblock\Elements\{EO_ElementOffer_Collection, EO_ElementProduct};
use CIBlock;

class ProductElement extends EO_ElementProduct
{
    /**
     * Returns collection of Offers.
     *
     * @return EO_ElementOffer_Collection|array|string
     */
    public function getOffers(): EO_ElementOffer_Collection|array|string
    {
        return $this->customData->get('OFFERS');
    }

    /**
     * Sets collection of Offers.
     *
     * @param EO_ElementOffer_Collection $offers
     * @return void
     */
    public function setOffers(EO_ElementOffer_Collection $offers): void
    {
        $this->customData->set('OFFERS', $offers);
    }

    /**
     * Returns Product link.
     *
     * @return string|null
     */
    public function getLink(): string|null
    {
        return CIBlock::ReplaceDetailUrl($this->getIblock()->getDetailPageUrl(), $this->collectValues(), arrType: 'E');
    }
}
