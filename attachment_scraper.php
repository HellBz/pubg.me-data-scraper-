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

include 'Muzzles.php';

# Attachment Scraper 

echo "Scraping attachments...\n\n";

# URL data exists in.
$targetUrl = "https://pubg.me/items/attachments";

# Webpage data loaded into a string.
$content = file_get_contents($targetUrl);

echo scrapeMuzzles()->toJson();
scrapeLowerRails();

echo "\n";


function scrapeMuzzles() {

	global $content;

	$rowStartString = '<div class="row item-attachment-row align-items-center">';
	$columnDataStartString = '<div class="col-md-4 col-lg-3 offset-lg-1 item-attachment-data">';
	$dataStartString = "<div>";
	$forString = " for ";		

	$startIndex = strpos($content, '<h1 class="mb-0">Muzzle</h1>');

	$endIndex = strpos($content, '<div class="card item-card attachments-card"', $startIndex);

	$version = getPatchVersion($startIndex);

	$rowIndex = strpos($content, $rowStartString, $startIndex)+ strlen($rowStartString);
 
	$muzzles = new Muzzles();
	$muzzles->version = $version;

	while($rowIndex < $endIndex) {

		$muzzleItem = new MuzzleItem();
		$image = getImageUrl($rowIndex);
		$muzzleItem->imageUrl = $image;

		// Keep in mind the name at this point is "Muzzle Item Name for gun1, gun2, gun3... etc".
		$name = getName($rowIndex);   
        $forPosition = strpos($name, $forString);

        // Just get the name of the Muzzle Item.
        $muzzleItem->name = substr($name, 0, $forPosition);

        $muzzleItem->guns = getGuns(substr($name, $forPosition + strlen($forString), strlen($name) - $forPosition));

		$nextRowIndex = strpos($content, $rowStartString , $rowIndex) + strlen($rowStartString);

		$searchToIndex = 0;

		// The last row doesn't have a next row, so use the end index value to search within bounds.
		if ($nextRowIndex > $endIndex){
			$searchToIndex = $endIndex;
		}else{
			$searchToIndex = $nextRowIndex;
		}

		$columnStartIndex = strpos($content, $columnDataStartString, $rowIndex);
		$dataIndex = strpos($content, $dataStartString, $columnStartIndex) + strlen($dataStartString);

		while($dataIndex < $searchToIndex){
			$endDataIndex = strpos($content, '</div>', $dataIndex);
			$effectString = substr($content, $dataIndex, $endDataIndex - $dataIndex);
			$effect = Effects::from($effectString);
			$effectValue = substr($effectString, 1, strpos($effectString, "%")-1);
			$effectSign= EffectSign::from($effectString);

			$muzzleEffect = new muzzleEffect();
			$muzzleEffect->effect = $effect;
			$muzzleEffect->value = $effectValue;
			$muzzleEffect->sign = $effectSign;

			$muzzleItem->addEffect($muzzleEffect);
			
			$dataIndex = strpos($content, $dataStartString, $endDataIndex) + strlen($dataStartString);
		}

		$muzzles->addItem($muzzleItem);
		$rowIndex = $nextRowIndex;
	}
	return $muzzles;
	
}

function scrapeLowerRails() {

	global $content;

	$rowStartString = '<div class="row item-attachment-row align-items-center">';
	$columnDataStartString = '<div class="col-md-4 col-lg-3 offset-lg-1 item-attachment-data">';
	$dataStartString = "<div>";
	$forString = " for ";		

	$startIndex = strpos($content, '<h1 class="mb-0">Lower Rail</h1>');

	$endIndex = strpos($content, '<div class="card item-card attachments-card"', $startIndex);

	
	$version = getPatchVersion($startIndex);

	$rowIndex = strpos($content, $rowStartString, $startIndex)+ strlen($rowStartString);
 
	$muzzles = new Muzzles();
	$muzzles->version = $version;

	while($rowIndex < $endIndex) {

		$muzzleItem = new MuzzleItem();
		$image = getImageUrl($rowIndex);
		$muzzleItem->imageUrl = $image;

		// Keep in mind the name at this point is "Muzzle Item Name for gun1, gun2, gun3... etc".
		$name = getName($rowIndex);   
        $forPosition = strpos($name, $forString);

        // Just get the name of the Muzzle Item.
        $muzzleItem->name = substr($name, 0, $forPosition);

        $muzzleItem->guns = getGuns(substr($name, $forPosition + strlen($forString), strlen($name) - $forPosition));

		$nextRowIndex = strpos($content, $rowStartString , $rowIndex) + strlen($rowStartString);

		$searchToIndex = 0;

		// The last row doesn't have a next row, so use the end index value to search within bounds.
		if ($nextRowIndex > $endIndex){
			$searchToIndex = $endIndex;
		}else{
			$searchToIndex = $nextRowIndex;
		}

		$columnStartIndex = strpos($content, $columnDataStartString, $rowIndex);
		$dataIndex = strpos($content, $dataStartString, $columnStartIndex) + strlen($dataStartString);

		while($dataIndex < $searchToIndex){
			$endDataIndex = strpos($content, '</div>', $dataIndex);
			$effectString = substr($content, $dataIndex, $endDataIndex - $dataIndex);
			$effect = Effects::from($effectString);
			$effectValue = substr($effectString, 1, strpos($effectString, "%")-1);
			$effectSign= EffectSign::from($effectString);

			$muzzleEffect = new muzzleEffect();
			$muzzleEffect->effect = $effect;
			$muzzleEffect->value = $effectValue;
			$muzzleEffect->sign = $effectSign;

			$muzzleItem->addEffect($muzzleEffect);
			
			$dataIndex = strpos($content, $dataStartString, $endDataIndex) + strlen($dataStartString);
		}

		$muzzles->addItem($muzzleItem);
		$rowIndex = $nextRowIndex;
	}
	return $muzzles;
	
}

function scrapeUpperRails(){
	
}

function scrapeMagazines(){
	
}

function scrapeStocks(){
	
}



#
# Returns the next patch version found after $offset.
#
# $offset - An index position in $content.
#
function getPatchVersion($offset) { 
	return scrapeBetweenStrings($offset, '<div class="item-last-updated">Last updated patch ', '</div>');
}
 
#
# Returns the next image url found after $offset.
#
# $offset - An index position in $content.
#
function getImageUrl($offset) {
	return scrapeBetweenStrings($offset, '<img class="d-flex" src="', '"');
}
 
#
# Returns the next name found after $offset.
#
# $offset - An index position in $content.
#
function getName($offset) {
	return scrapeBetweenStrings($offset, '<div class="media-body"><h5>', '<');
}

 
#
# Returns all data found after $offset between the first occurences of 
# $startString and $endString.
#
# $offset - An index position in $content.
# $startString - first string to look for. Will not be included in return data.
# $endString - last string to look for.
#
function scrapeBetweenStrings($offset, $startString, $endString) {
	global $content;

	$startIndex = strpos($content, $startString, $offset) + strlen($startString);
	$endIndex = strpos($content, $endString, $startIndex);
	return substr($content, $startIndex, $endIndex - $startIndex);
}

#
# Returns the next index position after $offset that <td> is found in.
#
# $offset - An index position in $content.
#
function nextColumnIndex($offset) {
	global $content, $columnStartString;
	return strpos($content, $columnStartString, $offset) + strlen($columnStartString);
}

#
# Returns the value between $offset and the next </td> found.
#
# $offset - An index position in $content.
#
function nextColumnValue($offset) {
	global $content;
	$columnEndIndex = strpos($content,'</td>', $offset);
	return substr($content, $offset, $columnEndIndex - $offset);
}

#
# Returns the list of guns from a given string. 
#
# Assumes format is "Item name for gun1, gun2, gun3, ... gunX".
#
# $gunsString - string of guns in the format written above.
#
function getGuns($gunsString){
    $commaPosition = strpos($gunsString, ",");
    $position = 0;
    $guns = array();
    while ($commaPosition != false) {
        $guns[count($guns)]=trim(substr($gunsString, $position, $commaPosition - $position));
        $position = $commaPosition + 1;
        $commaPosition = strpos($gunsString, ",", $position);
    }
    $guns[count($guns)]=trim(substr($gunsString, $position));
	return $guns;	

}

?> 