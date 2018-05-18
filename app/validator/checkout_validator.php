<?php
	function isValidAddress($area,$road,$house)
	{
		if($area==""||$road==""||$house=="")
			return false;
		else return true;
	}
	function isValidPhoneNo($phone)
	{
		if($phone!="")
		{
            if(preg_match("/^[0-9+-]*$/",$phone)){
                return true;
            }
			else return false;
		}
		else return false;
	}
	function isValidDeliveryType($delType)
	{
		if($delType=="")
			return false;
		else return true;
	}

	function validateOrder($order)
	{
				if(!isValidAddress($order['area'],$order['RoadNo'],$order['HouseNo'])) 
				{?>
				<script>
					var error1=document.getElementById("addressLegend");
					error1.innerText="Address *Each information is required";
				</script>
				<?php
					return false;
				}
				else if(!isValidPhoneNo($order['PhoneNo'])) 
				{?>
				<script>
					var error2=document.getElementById("PhoneError");
					error1.innerText="*Enter a valid phone number.";
				</script>
				<?php
					return false;
				}
				else if(!isValidDeliveryType($order['DeliveryType'])) 
				{?>
				<script>
					var error3=document.getElementById("DeliveryError");
					error3.innerText="*Select a delivery option.";
				</script>
				<?php
					return false;
				}
				else 
				{
					return true;
				}	
	}
?>