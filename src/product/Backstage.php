<?php

declare(strict_types=1);

namespace GildedRose\Product;

class Backstage extends BaseProduct
{
    /**
     * @var int
     */
    protected const CHANGE_QUALITY_PERIOD_1 = 1;

    /**
     * @var int
     */
    protected const CHANGE_QUALITY_PERIOD_2 = 2;

    /**
     * @var int
     */
    protected const CHANGE_QUALITY_PERIOD_3 = 3;

    /**
     * @var int
     */
    protected const POINT_END_PERIOD_1 = 10;

    /**
     * @var int
     */
    protected const POINT_END_PERIOD_2 = 5;

    /**
     * @var int
     */
    protected const POINT_END_PERIOD_3 = 0;

    /**
     * @var int
     */
    protected const SET_QUALITY_EXPECT = 0;
    
    function updateQuality(): void
    {
        if ($this->checkPeriodMin(static::POINT_END_PERIOD_1)) {
            $this->changeQuality(static::CHANGE_QUALITY_PERIOD_1);
        }
        if ($this->checkPeriod(static::POINT_END_PERIOD_2, static::POINT_END_PERIOD_1)) {
            $this->changeQuality(static::CHANGE_QUALITY_PERIOD_2);
        }
        if ($this->checkPeriod(static::POINT_END_PERIOD_3, static::POINT_END_PERIOD_2)) {
            $this->changeQuality(static::CHANGE_QUALITY_PERIOD_3);
        } 
        if (!$this->checkNotExpired()) {
            $this->setQuality(static::SET_QUALITY_EXPECT);
        }
    }

    protected function checkPeriod(int $min, int $max): bool
    {
        return $this->item->sell_in <= $max && $this->item->sell_in > $min;
    }

    protected function checkPeriodMin(int $min): bool
    {
        return $this->item->sell_in > $min;
    }
}
