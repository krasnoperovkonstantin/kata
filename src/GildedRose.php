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
            $this->makeProduct($item)->update();
        }
    }

    private function makeProduct($item): Object
    {
        if (Product\AgedBrie::checkName($item))
        {
            return new Product\AgedBrie ($item);
        }
        if (Product\Sulfuras::checkName($item))
        {
            return new Product\Sulfuras ($item);
        }
        if (Product\Backstage::checkName($item))
        {
            return new Product\Backstage ($item);
        }
        if (Product\Conjured::checkName($item))
        {
            return new Product\Conjured ($item);
        }
        return new Product\BaseProduct ($item);
    }
}
