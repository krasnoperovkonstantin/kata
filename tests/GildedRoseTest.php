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
        $name = 'Normal product name';
        return [
            [$name, 20, 40, 19, 39, 'Обычный товар'],
            [$name, 1, 40, 0, 39, 'Обычный товар, срок хранения становится равным нулю'],
            [$name, 0, 35, -1, 33, 'Срок хранения ниже нуля, качества уменьшается в два раза быстрее'],
            [$name, 5, 0, 4, 0, 'Качество товара никогда не может быть отрицательным'],
        ];
    }

    public function additionProviderAgedBrie()
    {
        $name = 'Aged Brie';
        return [
            [$name, 30, 20, 29, 21, 'Для товара «Aged Brie» качество увеличивается пропорционально возрасту'],
            [$name, -2, 20, -3, 21, 'Для товара «Aged Brie» качество увеличивается пропорционально возрасту'],
            [$name, 4, 50, 3, 50, 'Качество товара никогда не может быть больше, чем 50'],
        ];
    }

    public function additionProviderSulfuras()
    {
        $name = 'Sulfuras, Hand of Ragnaros';
        return [
            [$name, 0, 80, 0, 80, '«Sulfuras», срок хранения и качество не меняется'],
        ];
    }

    public function additionProviderBackstage()
    {
        $name = 'Backstage passes to a TAFKAL80ETC concert';
        return [
            [$name, 20, 15, 19, 16, 'Качество товара увеличивается'],
            [$name, 11, 15, 10, 16, 'Качество товара увеличивается'],
            [$name, 10, 10, 9, 12, 'Качество товара увеличивается на 2'],
            [$name, 6, 10, 5, 12, 'Качество товара увеличивается на 2'],
            [$name, 5, 15, 4, 18, 'Качество товара увеличивается на 3'],
            [$name, 1, 15, 0, 18, 'Качество товара увеличивается на 3'],
            [$name, 4, 50, 3, 50, 'Качество товара не может быть больше 50'],
            [$name, 0, 29, -1, 0, 'качество равно 0 после проведения концерта'],
        ];
    }

    public function additionProviderConjured()
    {
        $name = 'Conjured Mana Cake';
        return [
            [$name, 20, 40, 19, 38, 'Качество товара уменьшается на 2'],
            [$name, 1, 40, 0, 38, 'Качество товара уменьшается на 2'],
            [$name, 0, 35, -1, 31, 'Срок хранения ниже нуля, качества уменьшается на 4'],
            [$name, 5, 0, 4, 0, 'Качество товара никогда не может быть отрицательным'],
            [$name, -5, 0, -6, 0, 'Качество товара никогда не может быть отрицательным'],
        ];
    }
}
