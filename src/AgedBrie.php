<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrie extends Product
{
    public function __construct(&$item)
    {
        $this->changeQuality($item, 1);
        $this->decSell_in($item);
    }
}
