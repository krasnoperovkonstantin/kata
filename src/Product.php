<?php

declare(strict_types=1);

namespace GildedRose;

abstract class Product
{
    /**
     * @var int
     */
    private const UP_LIMIT_QUALITY = 50;

    /**
     * @var int
     */
    private const DOWN_LIMIT_QUALITY = 0;

    public function setQuality(&$item, int $value): void
    {
        if ($this->checkOverTheLimitDownQuality($value)) {
            $item->quality = self::DOWN_LIMIT_QUALITY;
            return;
        }
        if ($this->checkOverTheLimitUpQuality($value)) {
            $item->quality = self::UP_LIMIT_QUALITY;
            return;
        }
        $item->quality = $value;
    }

    public function checkOverTheLimitDownQuality($value): bool
    {
        return $value < self::DOWN_LIMIT_QUALITY;
    }

    public function checkOverTheLimitUpQuality($value): bool
    {
        return $value > self::UP_LIMIT_QUALITY;
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
