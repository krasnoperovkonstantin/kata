<?php

declare(strict_types=1);

namespace GildedRose;

class Sulfuras extends Product
{
    static function checkBackstage($item): bool
    {
        return $item->name === 'Sulfuras, Hand of Ragnaros';
    }

    public function __construct(&$item)
    {
        //ничего не меняем, т.к. это легендарный товар
    }
}
