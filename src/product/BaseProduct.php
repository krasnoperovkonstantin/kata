<?php

declare(strict_types=1);

namespace GildedRose\Product;

class BaseProduct
{
    /**
     * @var int
     */
    public const UP_LIMIT_QUALITY = 50;

    /**
     * @var int
     */
    public const DOWN_LIMIT_QUALITY = 0;

    /**
     * @var int
     */
    public const CHANGE_QUALITY_NOT_EXPECT = -1;

    /**
     * @var int
     */
    public const CHANGE_QUALITY_EXPECT = -2;

    /**
     * @var string
     */
    public const CHECK_NAME = '';

    /**
     * @var Item
     */
    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    static function checkName($item): bool
    {
        return $item->name === get_called_class()::CHECK_NAME;
    }

    public function update(): Object
    {
        if ($this->checkNotExpired()) {
            $this->changeQuality(get_called_class()::CHANGE_QUALITY_NOT_EXPECT);
        } else {
            $this->changeQuality(get_called_class()::CHANGE_QUALITY_EXPECT);
        }
        $this->decrementSell_in();
        return $this->item;
    }

    public function setQuality(int $value): void
    {
        if ($value < self::DOWN_LIMIT_QUALITY) {
            $this->item->quality = self::DOWN_LIMIT_QUALITY;
            return;
        }
        if ($value > self::UP_LIMIT_QUALITY) {
            $this->item->quality = self::UP_LIMIT_QUALITY;
            return;
        }
        $this->item->quality = $value;
    }

    public function changeQuality(int $value): void
    {
        $this->setQuality($this->item->quality + $value);
    }
    
    public function decrementSell_in(): void
    {
        $this->item->sell_in--;
    }

    public function checkNotExpired(): bool
    {
        return $this->item->sell_in > 0;
    }
}
