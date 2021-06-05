<?php

declare(strict_types=1);

namespace GildedRose\Product;

class ProductCreator
{
    /**
     * @var Item
     */
    private $item;

    /**
     * @var String
     */
    private $Handler;

    /**
     * @var Array
     */
    private const ITEM_HANDLER_CLASS = array(
        'Conjured Mana Cake' => 'Conjured',
        'Sulfuras, Hand of Ragnaros' => 'Sulfuras',
        'Backstage passes to a TAFKAL80ETC concert' => 'Backstage',
        'Aged Brie' => 'AgedBrie',
    );

    /**
     * @var String
     */
    private const NAME_SPACE = 'GildedRose\\Product\\';

    public function __construct(\GildedRose\Item $item)
    {
        $this->item = $item;
        $this->setHandler();
    }

    public function makeProduct(): ProductInterface
    {
        return new $this->Handler($this->item);
    }

    private function setHandler(): void
    {
        $this->Handler = self::NAME_SPACE;
        if (array_key_exists ($this->item->name, self::ITEM_HANDLER_CLASS))
        {
            $this->Handler .= self::ITEM_HANDLER_CLASS[$this->item->name];
        } else {
            $this->Handler .= 'BaseProduct';
        }
    }
}
