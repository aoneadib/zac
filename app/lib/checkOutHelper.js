function isValidAddress(area,road,house)
	{
		if(area==""||road==""||house=="")
			return false;
		else return true;
	}
function isValidPhoneNo(phone)
	{
		if(phone!="")
		{
			var myRegEx= new RegExp('^[0-9]*$');
			if(myRegEx.test(phone)) 
			{
				return true;
			}
			else return false;
		}
		else return false;
	}
function isValidDeliveryType(delType)
	{
		if(delType=="")
			return false;
		else return true;
	}
