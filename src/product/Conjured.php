<?php

declare(strict_types=1);

namespace GildedRose\Product;

class Conjured extends BaseProduct
{
    /**
     * @var int
     */
    protected const CHANGE_QUALITY_NOT_EXPECT = -2;

    /**
     * @var int
     */
    protected const CHANGE_QUALITY_EXPECT = -4;
}
