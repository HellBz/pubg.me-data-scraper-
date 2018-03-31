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

class Vests {

    public $version; 
    public $items = array();

	public function __toString() {
		return $this->version."\n";
	}
	
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

class VestsItem {

    public $name;
    public $imageUrl;
    public $capacityExtension;
    public $damageReduction;
    public $durability;
    public $weight;

    public function __toString() {
        return $this->name."\n".
        $this->imageUrl."\n".
        $this->capacityExtension."\n".
        $this->damageReduction."\n". 
        $this->durability."\n".
        $this->weight."\n";
    }

    public function toJson() {
        return "{".
        "\"name\":\"".$this->name."\",".
        "\"imageUrl\":\"".$this->imageUrl."\",".
        "\"capacityExtension\":\"".$this->capacityExtension."\",".
        "\"damageReduction\":\"".$this->damageReduction."\",".
        "\"durability\":\"".$this->durability."\",".
        "\"weight\":\"".$this->weight."\"".
        "}";
    }

}

?>