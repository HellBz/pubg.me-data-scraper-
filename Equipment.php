<?php 

class Equipment {

    public $headgear;
    public $vests;
    public $belts;
    public $outer;
    public $back;
	
    public function toJson() { 
        return 
        "{".
        "\"headgear\":".$this->headgear->toJson().",".
        "\"vests\":".$this->vests->toJson().",".
        "\"belts\":".$this->belts->toJson().",".
        "\"outer\":".$this->outer->toJson().",".
        "\"back\":".$this->back->toJson().
        "}";
    }

} 

?>