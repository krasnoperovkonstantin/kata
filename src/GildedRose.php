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
            if ($item->name === 'Aged Brie') {
                $this->agedBrie($item);
            } elseif ($item->name === 'Conjured Mana Cake') {
                $this->conjured($item);
            } elseif ($item->name === 'Sulfuras, Hand of Ragnaros') {
                $this->sulfuras($item);
            } elseif ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                $this->backstage($item);
            } else {
                $this->other($item);
            }
        }
    }

    private function decSell_in(&$item): void
    {
        $item->sell_in--;
    }

    private function setQuality(&$item, int $value): void
    {
        if ($value < 0) {
            $item->quality = 0;
        } elseif ($value > 50) {
            $item->quality = 50;
        } else {
            $item->quality = $value;
        }
    }

    private function changeQuality(&$item, int $value): void
    {
        $this->setQuality($item, $item->quality + $value);
    }

    private function agedBrie(&$item): void
    {
        $this->changeQuality($item, 1);
        $this->decSell_in($item);
    }

    private function conjured(&$item): void
    {
        if ($item->sell_in <= 0) {
            $this->changeQuality($item, -4);
        } else {
            $this->changeQuality($item, -2);
        }
        $this->decSell_in($item);
    }

    private function sulfuras(&$item): void
    {
        // ничего не меняем т.к. он является легендарным товаром
    }

    private function backstage(&$item): void
    {
        if ($item->sell_in <= 0) {
            $this->setQuality($item, 0);
        } elseif ($item->sell_in <= 5) {
            $this->changeQuality($item, 3);
        } elseif ($item->sell_in <= 10) {
            $this->changeQuality($item, 2);
        } else {
            $this->changeQuality($item, 1);
        }

        $this->decSell_in($item);
    }

    private function other(&$item): void
    {
        if ($item->sell_in <= 0) {
            $this->changeQuality($item, -2);
        } else {
            $this->changeQuality($item, -1);
        }

        $this->decSell_in($item);
    }
}
