<?php

declare(strict_types=1);

namespace GildedRose\Product;


class AgedBrie extends BaseProduct
{
    /**
     * @var int
     */
    private const CHANGE_QUALITY = 1;

    /**
     * @var string
     */
    const CHECK_NAME = 'Aged Brie';

    function update(): void
    {
        $this->changeQuality(self::CHANGE_QUALITY);
        $this->decrementSell_in();
    }
}
