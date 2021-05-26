<?php

declare(strict_types=1);

namespace GildedRose\Product;

class Sulfuras extends BaseProduct
{
    /**
     * @var string
     */
    const CHECK_NAME = 'Sulfuras, Hand of Ragnaros';

    function update(): Object
    {
        return $this->item;
    }
}
