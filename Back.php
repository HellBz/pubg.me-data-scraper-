<?php 

class Back {

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

class BackItem {

    public $name;
    public $imageUrl;
    public $capacityExtension;
    public $weight;

    public function __toString() {
        return $this->name."\n".
        $this->imageUrl."\n".
        $this->capacityExtension."\n".
        $this->weight."\n";
    }

    public function toJson() {
        return "{".
        "\"name\":\"".$this->name."\",".
        "\"imageUrl\":\"".$this->imageUrl."\",".
        "\"capacityExtension\":\"".$this->capacityExtension."\",".
        "\"weight\":\"".$this->weight."\"".
        "}";
    }

}

?>