<?php

declare(strict_types=1);

namespace GildedRose\Product;

class Backstage extends BaseProduct
{
    /**
     * @var string
     */
    const CHECK_NAME = 'Backstage passes to a TAFKAL80ETC concert';

    /**
     * @var int
     */
    private const CHANGE_QUALITY_PERIOD_1 = 1;

    /**
     * @var int
     */
    private const CHANGE_QUALITY_PERIOD_2 = 2;

    /**
     * @var int
     */
    private const CHANGE_QUALITY_PERIOD_3 = 3;

    /**
     * @var int
     */
    private const POINT_END_PERIOD_1 = 10;

    /**
     * @var int
     */
    private const POINT_END_PERIOD_2 = 5;

    /**
     * @var int
     */
    private const POINT_END_PERIOD_3 = 0;

    /**
     * @var int
     */
    private const SET_QUALITY_EXPECT = 0;

    function update(): Object
    { 
        $this->updateQuality();
        $this->decrementSell_in();
        return $this->item;
    }
    
    private function updateQuality(): void
    {
        if ($this->checkPeriodMin(self::POINT_END_PERIOD_1)) {
            $this->changeQuality(self::CHANGE_QUALITY_PERIOD_1);
        }
        if ($this->checkPeriod(self::POINT_END_PERIOD_2, self::POINT_END_PERIOD_1)) {
            $this->changeQuality(self::CHANGE_QUALITY_PERIOD_2);
        }
        if ($this->checkPeriod(self::POINT_END_PERIOD_3, self::POINT_END_PERIOD_2)) {
            $this->changeQuality(self::CHANGE_QUALITY_PERIOD_3);
        } 
        if (!$this->checkNotExpired()) {
            $this->setQuality(self::SET_QUALITY_EXPECT);
        }
    }

    public function checkPeriod($min, $max): bool
    {
        return $this->item->sell_in <= $max and $this->item->sell_in > $min;
    }

    public function checkPeriodMin($min): bool
    {
        return $this->item->sell_in > $min;
    }
}
