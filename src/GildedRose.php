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
        if (AgedBrie::checkBackstage($item)) {
            new AgedBrie ($item);
            return;
        }
        if (Conjured::checkBackstage($item)) {
            new Conjured ($item);
            return;
        }
        if (Sulfuras::checkBackstage($item)) {
            new Sulfuras ($item);
            return;
        }
        if (Backstage::checkBackstage($item)) {
            new Backstage ($item);
            return;
        }
        new Other ($item);
    }
}
