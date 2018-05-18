<?php
    function isValidProductName($productName){
        $parts = explode(" ", $productName);
        $isValid = false;
        if(count($parts)>1){
            if(preg_match("/^[a-zA-Z0-9 ]*$/",$productName)){
                $isValid = true;
            }
        }
        return $isValid;
    }
		
	function isValidProductType($type)
	{
		if($type==NULL) return false;
		else return true;
	}
	
	function isValidProductDescription($description)
	{
		if(str_word_count($description)<2)
		{
			return false;
		}
		else return true;
	}
		
	function isValidProductColor($color)
	{
		if($color==NULL) return false;
		else return true;
	}
	
	function isValidProductPrice($price)
	{
		if($price!=null){
            if(preg_match("/^[0-9]*$/",$price)){
                return true;
            }
			else return false;
        }
		else
		{
			return false;
		}
	}
	
	function isValidProductPhoto($photo,$view)
	{
	if($photo['pic']['size']==0)
	{
		if($view=="modifyProduct") return true;
		else return false;
	}
	else
	{
		if(getimagesize($photo['pic']["tmp_name"]))
		{
			if($photo['pic']['size'] > 2097152)
				{
					return false;
				}
			else return true;
		}
		else 
		{
			return false;
		}
	}
	}
?>