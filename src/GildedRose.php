<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->routeTypeProduct($item);
        }
    }

    private function routeTypeProduct(&$item): void
    {
        if ($item->name === 'Aged Brie') {
            new AgedBrie ($item);
            return;
        } 
        if ($item->name === 'Conjured Mana Cake') {
            new Conjured ($item);
            return;
        } 
        if ($item->name === 'Sulfuras, Hand of Ragnaros') {
            new Sulfuras ($item);
            return;
        } 
        if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
            new Backstage ($item);
            return;
        }
        new Other ($item);
    }
}
