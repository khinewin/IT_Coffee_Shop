<?php

namespace App;


class Cart
{
    public $items;
    public $totalPrices=0;
    public $totalQty=0;
    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items=$oldCart->items;
            $this->totalPrices=$oldCart->totalPrices;
            $this->totalQty=$oldCart->totalQty;
        }else{
            $this->items=null;
        }
    }
    public function add($item, $id){
        $storeItem=['item'=>$item, 'qty'=>0, 'price'=>$item->coffee_price];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storeItem=$this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['price']=$storeItem['qty'] * $item->coffee_price;
        $this->items[$id]=$storeItem;
        $this->totalQty++;
        $this->totalPrices += $item->coffee_price;
    }
    public function removeItem($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrices -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
    public function reduceOne($id){
        $this->items[$id]['qty']--;
        $this->totalQty --;
        $this->items[$id]['price'] -= $this->items[$id]['item']['coffee_price'];
        $this->totalPrices -= $this->items[$id]['item']['coffee_price'];

        if($this->items[$id]['qty'] <=0){
            unset($this->items[$id]);
        }

    }
}
