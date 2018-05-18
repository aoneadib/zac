<?php
	$i=0;
	$suggestionsArr=array();
	if($searchText!=""){
	foreach($productsArr as $product)
	{
		if(stristr($product['name'], $searchText) == true) 
			{
				$suggestionsArr[$i]['name']=$product['name'];
				$i++;
			}
	}
	}
	if(count($suggestionsArr)!=0){
	$suggestionsJson=json_encode($suggestionsArr);}
	else {$suggestionsJson='[{"name":" "}]';}
	echo $suggestionsJson;
?>