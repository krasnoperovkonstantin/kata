<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    /**
     * @var ProductCreator
     */
    private $creator;

    /**
     * @var ProductInterface
     */
    private $product;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $creator = new Product\ProductCreator($item);
            $product = $creator->makeProduct();
            $product->update();   
        }
    }
}
