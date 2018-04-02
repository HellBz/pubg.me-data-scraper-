<?php 

/*
 * MIT License
 *
 * Copyright (c) 2017 Zafrani Tech
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE
 */ 


class LowerRails {

    public $version; 
    public $items = array();

    public function toJson() {
        $itemsJson = "";
        for($i = 0; $i < count($this->items); $i++) {
            if ($i != 0){
                $itemsJson.=",";
            }
            $item = $this->items[$i];
            $itemsJson.=$item->toJson();
        }
        return 
        "{\"version\": \"".$this->version."\",".
        "\"items\": [".$itemsJson."]}";
    }
	
    public function addItem($item) {
        $this->items[count($this->items)] = $item;
    }
}

class LowerRailItem {

    public $name;
    public $imageUrl;
    public $effects = array();
    public $guns = array();

    public function toJson() {
        $effectsJson = "";
        for($i = 0; $i < count($this->effects); $i++) {
            if ($i != 0){
                $effectsJson.=",";
            }
            $effectsJson.= $this->effects[$i]->toJson();
        }
        
        $gunsJson = "";
        for($i = 0; $i < count($this->guns); $i++) {
            if ($i != 0){
                $gunsJson.=",";
            }
            $gunsJson.= "\"".$this->guns[$i]."\"";
        }

        return "{".
        "\"name\":\"".$this->name."\",".
        "\"imageUrl\":\"".$this->imageUrl."\",".
        "\"effects\":[".$effectsJson."],".
        "\"guns\":[".$gunsJson."]".
        "}";
    }

    public function addGun($gun) {
        $this->guns[count($this->guns)] = $gun;
    }

    public function addEffect($effect){
        $this->effects[count($this->effects)] = $effect;
    }

}

class LowerRailEffect {

    public $effect;
    public $value;
    public $sign;

    public function toJson() {
        return "{".
        "\"effect\":\"".$this->effect."\",".
        "\"value\":\"".$this->value."\",".
        "\"sign\":\"".$this->sign."\"".
        "}";
    }

}

?>