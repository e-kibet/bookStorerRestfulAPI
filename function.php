<?php
function get_price($find){
	$books=array(
		"java"=>299,
		"C#" => 300,
		"Python"=>400,
		".NET"=>320

	);

	foreach ($books as $book => $price) {
		if($book==$find){
			return $price;
			break;

		}
	}
}

?>