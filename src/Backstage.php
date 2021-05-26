<?php

declare(strict_types=1);

namespace GildedRose;

class Backstage extends Product
{
    static function checkBackstage($item): bool
    {
        return $item->name === 'Backstage passes to a TAFKAL80ETC concert';
    }

    public function __construct(&$item)
    {
        if ($this->checkExpired($item)) {
            $this->expired($item);
        } 
        
        if ($this->checkNotExpired10ToMore($item)) {
            $this->notExpired10ToMore($item);
        } 
        
        if ($this->checkNotExpired5To10($item)) {
            $this->notExpired5To10($item);
        } 

        if ($this->checkNotExpired0To5($item)) {
            $this->notExpired0To5($item);
        } 

        $this->decSell_in($item);
    }
    
    private function notExpired10ToMore(&$item): void
    {
        $this->changeQuality($item, 1);
    }

    private function notExpired5To10(&$item): void
    {
        $this->changeQuality($item, 2);
    }

    private function notExpired0To5(&$item): void
    {
        $this->changeQuality($item, 3);
    }

    private function expired(&$item): void
    {
        $this->setQuality($item, 0);
    }
}
