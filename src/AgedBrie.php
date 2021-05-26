<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrie extends Product
{
    static function checkBackstage($item): bool
    {
        return $item->name === 'Aged Brie';
    }

    public function __construct(&$item)
    {
        $this->changeQuality($item, 1);
        $this->decSell_in($item);
    }
}
