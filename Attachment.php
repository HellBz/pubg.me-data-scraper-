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

class Attachment {

    public $muzzles;
    public $lowerRails;

    public function toJson() { 
        return 
        "{".
        "\"muzzles\":".$this->muzzles->toJson().",".
        "\"lowerRails\":".$this->lowerRails->toJson()."".
        "}";
    }

}

class Effects {

    const DEVIATION= 0;
    const FASTER_ADS= 1;
    const HORIZONTAL_RECOIL = 2;  
    const MAGNIFICATION= 3;
    const RELOAD_DURATION= 4;
    const RECOIL_PATTERN = 5;
    const SHOT_SPEED = 6;
    const SHOT_SPREAD = 7;  
    const SPREAD_BASE= 8;  
    const VERTICAL_RECOIL = 9;  

    public static function from($string) {
        if (stripos($string, "DEVIATION") !== false) {
            return DEVIATION;
        } else if (stripos($string, "FASTER ADS") !== false) {
            return FASTER_ADS;
        } else if (stripos($string, "HORIZONTAL RECOIL") !== false) {
            return HORIZONTAL_RECOIL;
        } else if (stripos($string, "MAGNIFICATION") !== false) {
            return MAGNIFICATION;
        } else if (stripos($string, "RELOAD DURATION") !== false) {
            return RELOAD_DURATION;
        }  else if (stripos($string, "RECOIL PATTERN") !== false) {
            return RECOIL_PATTERN;
        } else if (stripos($string, "SHOT SPEED") !== false) {
            return SHOT_SPEED;
        } else if (stripos($string, "SHOT SPREAD") !== false) {
            return SHOT_SPREAD;
        } else if (stripos($string, "SPREAD BASE") !== false) {
            return SPREAD_BASE;
        } else if (stripos($string, "VERTICAL RECOIL") !== false) {
            return VERTICAL_RECOIL;
        }
    }
}

class EffectSign {

    const POSITIVE = 1;
    const NEGATIVE = -1;


    public static function from($string) {
        if (stripos($string, "+") !== false) {
            return POSITIVE;
        } else if (stripos($string, "-") !== false) {
            return NEGATIVE;
        } 
    }
}


?>