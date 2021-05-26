<?php

declare(strict_types=1);

namespace GildedRose;

class Conjured extends Product
{
    static function checkBackstage($item): bool
    {
        return $item->name === 'Conjured Mana Cake';
    }

    public function __construct(&$item)
    {
        if ($this->checkNotExpired($item)) {
            $this->notExpired($item);
        } else {
            $this->expired($item);
        }
        $this->decSell_in($item);
    }

    private function notExpired(&$item): void
    {
        $this->changeQuality($item, -2);
    }

    private function expired(&$item): void
    {
        $this->changeQuality($item, -4);
    }
}
