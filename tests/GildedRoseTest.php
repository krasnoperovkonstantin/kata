<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider additionProviderOther
     * @dataProvider additionProviderAgedBrie
     * @dataProvider additionProviderSulfuras
     * @dataProvider additionProviderBackstage
     * @dataProvider additionProviderConjured
     */
    public function testUpdate($name, $sell_in, $quality, $sell_inAfter, $qualityAfter, $message)
    {
        $items = [new Item($name, $sell_in, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($name, $items[0]->name, $message);
        $this->assertSame($sell_inAfter, $items[0]->sell_in, $message);
        $this->assertSame($qualityAfter, $items[0]->quality, $message);
    }
    
    public function additionProviderOther()
    {
        return [
            ['Normal product name', 20, 40, 19, 39, 'Обычный товар'],
            ['Normal product name', 1, 40, 0, 39, 'Обычный товар, срок хранения становится равным нулю'],
            ['Normal product name', 0, 35, -1, 33, 'Срок хранения ниже нуля, качества уменьшается в два раза быстрее'],
            ['Normal product name', 5, 0, 4, 0, 'Качество товара никогда не может быть отрицательным'],
        ];
    }

    public function additionProviderAgedBrie()
    {
        return [
            ['Aged Brie', 30, 20, 29, 21, 'Для товара «Aged Brie» качество увеличивается пропорционально возрасту'],
            ['Aged Brie', -2, 20, -3, 21, 'Для товара «Aged Brie» качество увеличивается пропорционально возрасту'],
            ['Aged Brie', 4, 50, 3, 50, 'Качество товара никогда не может быть больше, чем 50'],
        ];
    }

    public function additionProviderSulfuras()
    {
        return [
            ['Sulfuras, Hand of Ragnaros', 0, 80, 0, 80, '«Sulfuras», срок хранения и качество не меняется'],
        ];
    }

    public function additionProviderBackstage()
    {
        return [
            ['Backstage passes to a TAFKAL80ETC concert', 20, 15, 19, 16, 'Качество товара увеличивается'],
            ['Backstage passes to a TAFKAL80ETC concert', 11, 15, 10, 16, 'Качество товара увеличивается'],
            ['Backstage passes to a TAFKAL80ETC concert', 10, 10, 9, 12, 'Качество товара увеличивается на 2'],
            ['Backstage passes to a TAFKAL80ETC concert', 6, 10, 5, 12, 'Качество товара увеличивается на 2'],
            ['Backstage passes to a TAFKAL80ETC concert', 5, 15, 4, 18, 'Качество товара увеличивается на 3'],
            ['Backstage passes to a TAFKAL80ETC concert', 1, 15, 0, 18, 'Качество товара увеличивается на 3'],
            ['Backstage passes to a TAFKAL80ETC concert', 4, 50, 3, 50, 'Качество товара не может быть больше 50'],
            ['Backstage passes to a TAFKAL80ETC concert', 0, 29, -1, 0, 'качество равно 0 после проведения концерта'],
        ];
    }

    public function additionProviderConjured()
    {
        return [
            ['Conjured Mana Cake', 20, 40, 19, 38, 'Качество товара уменьшается на 2'],
            ['Conjured Mana Cake', 1, 40, 0, 38, 'Качество товара уменьшается на 2'],
            ['Conjured Mana Cake', 0, 35, -1, 31, 'Срок хранения ниже нуля, качества уменьшается на 4'],
            ['Conjured Mana Cake', 5, 0, 4, 0, 'Качество товара никогда не может быть отрицательным'],
            ['Conjured Mana Cake', -5, 0, -6, 0, 'Качество товара никогда не может быть отрицательным'],
        ];
    }
}
