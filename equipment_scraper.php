<?php 

include 'Headgear.php';
include 'Vests.php';
include 'Belts.php';
include 'Outer.php';
include 'Back.php';

# Equipment Scraper

# Each row starts with <tr>.
$rowStartString = '<tr>';

# Each column starts with <td>.
$columnStartString = '<td>';

echo "Scraping equipment...\n\n";

# URL data exists in.
$targetUrl = "https://pubg.me/items/equipment";

# Webpage data loaded into a string.
$content = file_get_contents($targetUrl);

echo scrapeHeadgear()->toJson();
echo "\n\n";
echo scrapeVests()->toJson();
echo "\n\n";
echo scrapeBelts()->toJson();
echo "\n\n";
echo scrapeOuter()->toJson();
echo "\n\n";
echo scrapeBack()->toJson();
echo "\n\n";


echo "\n";

#
# Returns HeadGear data.
#
function scrapeHeadgear() {
	global $content, $rowStartString, $columnStartString; 

	$headgear = new Headgear();

	$startIndex = strpos($content, '<h1 class="mb-0">Headgear</h1>');
 
	$headgear->version = getPatchVersion($startIndex);
	
	$startIndex = strpos($content, "<tbody>", $startIndex);
	$endIndex = strpos($content, '</tbody>', $startIndex); 
	$rowIndex = strpos($content, $rowStartString, $startIndex) + strlen($rowStartString);
 
	while ($rowIndex < $endIndex) {

		$item = new HeadgearItem();
 
		$item->imageUrl = getImageUrl($rowIndex);
		$item->name = getName($rowIndex); 

		$columnStartIndex = nextColumnIndex($rowIndex);
		$item->damageReduction = nextColumnValue($columnStartIndex);
		 
		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->durability = nextColumnValue($columnStartIndex);

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->weight = nextColumnValue($columnStartIndex);

		$headgear->addItem($item);

		$rowIndex = strpos($content, $rowStartString, $rowIndex) + strlen($rowStartString);
 

	} 
	return $headgear;

}

#
# Returns Vests data
#
function scrapeVests() {
	global $content, $rowStartString, $columnStartString; 

	$vests = new Vests();

	$startIndex = strpos($content, '<h1 class="mb-0">Armored Vests</h1>');
 
	$vests->version = getPatchVersion($startIndex);
	
	$startIndex = strpos($content, "<tbody>", $startIndex);
	$endIndex = strpos($content, '</tbody>', $startIndex); 
	$rowIndex = strpos($content, $rowStartString, $startIndex) + strlen($rowStartString);

	while ($rowIndex < $endIndex) {

		$item = new VestsItem();
 
		$item->imageUrl = getImageUrl($rowIndex);
		$item->name = getName($rowIndex); 

		$columnStartIndex = nextColumnIndex($rowIndex);
		$item->capacityExtension = nextColumnValue($columnStartIndex);

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->damageReduction = nextColumnValue($columnStartIndex);

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->durability = nextColumnValue($columnStartIndex);

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->weight = nextColumnValue($columnStartIndex);

		$vests->addItem($item);

		$rowIndex = strpos($content, $rowStartString, $rowIndex) + strlen($rowStartString);
 
	}

	return $vests;	
}

#
# Returns Belts data
#
function scrapeBelts() {
	global $content, $rowStartString, $columnStartString; 

	$belts = new Belts();

	$startIndex = strpos($content, '<h1 class="mb-0">Belts</h1>');
 
	$belts->version = getPatchVersion($startIndex);
	
	$startIndex = strpos($content, "<tbody>", $startIndex);
	$endIndex = strpos($content, '</tbody>', $startIndex); 
	$rowIndex = strpos($content, $rowStartString, $startIndex) + strlen($rowStartString);

	while ($rowIndex < $endIndex) {

		$item = new BeltsItem();
 
		$item->imageUrl = getImageUrl($rowIndex);
		$item->name = getName($rowIndex); 

		$columnStartIndex = nextColumnIndex($rowIndex);
		$item->capacityExtension = nextColumnValue($columnStartIndex);

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->damageReduction = nextColumnValue($columnStartIndex); 

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->weight = nextColumnValue($columnStartIndex);

		$belts->addItem($item);

		$rowIndex = strpos($content, $rowStartString, $rowIndex) + strlen($rowStartString);
 
	}

	return $belts;
	
}

#
# Returns Outer data
#
function scrapeOuter() {
	global $content, $rowStartString, $columnStartString; 

	$outer = new Outer();

	$startIndex = strpos($content, '<h1 class="mb-0">Outer</h1>');
 
	$outer->version = getPatchVersion($startIndex);
	
	$startIndex = strpos($content, "<tbody>", $startIndex);
	$endIndex = strpos($content, '</tbody>', $startIndex); 
	$rowIndex = strpos($content, $rowStartString, $startIndex) + strlen($rowStartString);

	while ($rowIndex < $endIndex) {

		$item = new OuterItem();
 
		$item->imageUrl = getImageUrl($rowIndex);
		$item->name = getName($rowIndex); 

		$columnStartIndex = nextColumnIndex($rowIndex);
		$item->capacityExtension = nextColumnValue($columnStartIndex);

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->damageReduction = nextColumnValue($columnStartIndex); 

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->weight = nextColumnValue($columnStartIndex);

		$outer->addItem($item);

		$rowIndex = strpos($content, $rowStartString, $rowIndex) + strlen($rowStartString);
 
	}

	return $outer;
	
}

function scrapeBack() {
	global $content, $rowStartString, $columnStartString; 

	$back = new Back();

	$startIndex = strpos($content, '<h1 class="mb-0">Back</h1>');
 
	$back->version = getPatchVersion($startIndex);
	
	$startIndex = strpos($content, "<tbody>", $startIndex);
	$endIndex = strpos($content, '</tbody>', $startIndex); 
	$rowIndex = strpos($content, $rowStartString, $startIndex) + strlen($rowStartString);

	while ($rowIndex > $startIndex && $rowIndex < $endIndex) {
		$item = new BackItem();
 
		$item->imageUrl = getImageUrl($rowIndex);
		$item->name = getName($rowIndex); 

		$columnStartIndex = nextColumnIndex($rowIndex);
		$item->capacityExtension = nextColumnValue($columnStartIndex);

		$columnStartIndex = nextColumnIndex($columnStartIndex);
		$item->weight = nextColumnValue($columnStartIndex);

		$back->addItem($item);

		$rowIndex = strpos($content, $rowStartString, $rowIndex) + strlen($rowStartString);
 
	}

	return $back;
	
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
	return scrapeBetweenStrings($offset, '<img class="d-flex mr-4" src="', '"');
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


?> 