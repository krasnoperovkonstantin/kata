<?php

declare(strict_types=1);

namespace GildedRose;

class Other extends Product
{
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
        $this->changeQuality($item, -1);
    }

    private function expired(&$item): void
    {
        $this->changeQuality($item, -2);
    }
}