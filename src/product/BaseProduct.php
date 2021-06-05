<?php

declare(strict_types=1);

namespace GildedRose\Product;

class BaseProduct implements ProductInterface
{
    /**
     * @var int
     */
    protected const UP_LIMIT_QUALITY = 50;

    /**
     * @var int
     */
    protected const DOWN_LIMIT_QUALITY = 0;

    /**
     * @var int
     */
    protected const CHANGE_QUALITY_NOT_EXPECT = -1;

    /**
     * @var int
     */
    protected const CHANGE_QUALITY_EXPECT = -2;
    
    /**
     * @var Item
     */
    protected $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function update(): void
    { 
        $this->updateQuality();
        $this->decrementSell_in();
    }

    protected function updateQuality(): void
    {
        if ($this->checkNotExpired()) {
            $this->changeQuality(static::CHANGE_QUALITY_NOT_EXPECT);
        } else {
            $this->changeQuality(static::CHANGE_QUALITY_EXPECT);
        }
    }
    
    protected function setQuality(int $value): void
    {
        if ($value < static::DOWN_LIMIT_QUALITY) {
            $this->item->quality = static::DOWN_LIMIT_QUALITY;
            return;
        }
        if ($value > static::UP_LIMIT_QUALITY) {
            $this->item->quality = static::UP_LIMIT_QUALITY;
            return;
        }
        $this->item->quality = $value;
    }

    protected function changeQuality(int $value): void
    {
        $this->setQuality($this->item->quality + $value);
    }
    
    protected function decrementSell_in(): void
    {
        $this->item->sell_in--;
    }

    protected function checkNotExpired(): bool
    {
        return $this->item->sell_in > 0;
    }
}
