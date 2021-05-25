<?php

declare(strict_types=1);

namespace GildedRose;

abstract class Product
{
    public function setQuality(&$item, int $value): void
    {
        if ($value < 0) {
            $item->quality = 0;
            return;
        }
        if ($value > 50) {
            $item->quality = 50;
            return;
        }
        $item->quality = $value;
    }

    public function checkNotExpired($item): bool
    {
        return $item->sell_in > 0;
    }

    public function checkExpired($item): bool
    {
        return !$this->checkNotExpired($item);
    }

    public function checkNotExpired10ToMore($item): bool
    {
        return $item->sell_in > 10;
    }
        
    public function checkNotExpired5To10($item): bool
    {
        return $item->sell_in <= 10 and $item->sell_in > 5 ;
    }

    public function checkNotExpired0To5($item): bool
    {
        return $item->sell_in <= 5 and $item->sell_in > 0;
    }

    public function changeQuality(&$item, int $value): void
    {
        $this->setQuality($item, $item->quality + $value);
    }
    
    public function decSell_in(&$item): void
    {
        $item->sell_in--;
    }
}
