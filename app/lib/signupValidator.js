function isValidName(name)
{
		var nameErrorObj= document.getElementsByClassName("nameError")[0];
		var myRegEx= new RegExp('^[a-zA-Z ]+\ \[a-zA-Z]');
		if(!myRegEx.test(name)) {
			nameErrorObj.innerHTML = "*Invalid Username";
			return false;
		}
		else{
			nameErrorObj.innerHTML = "";
			return true;
		}
}
function isValidEmail(email)
{		
		var emailErrorObj= document.getElementsByClassName("emailError")[0];
		if(email!="")
		{
			var myRegEx= new RegExp('[^@]\@[^@]\.');
			if(myRegEx.test(email))					
			{
				emailErrorObj.innerHTML = "";
				return true;
			}
			else
			{
				emailErrorObj.innerHTML = "*Invalid E-mail";
				return false;
			}
		}
		else
		{
			emailErrorObj.innerHTML = "*Invalid E-mail";
			return false;
		}
}
function isValidPassword(password)
{
		var passErrorObj= document.getElementsByClassName("passError")[0];
		if(password.length<9)
		{
			passErrorObj.innerHTML = "*Invalid Password";
			return false;
		}
		else
		{
			passErrorObj.innerHTML = "";
			return true;
		}
}
function isPasswordConfirmed(password,confirmPassword)
{
		var confirmPassErrorObj= document.getElementsByClassName("confirmPassError")[0];
		if(password===confirmPassword) 
		{
			confirmPassErrorObj.innerHTML = "";
			return true;
		}
		else 
		{
			confirmPassErrorObj.innerHTML = "*Confirm password not matching";
			return false;
		}
}
function isGenderSelected(gender)
{
	var genderErrorObj= document.getElementsByClassName("genderErrorObj")[0];
	for(var i=0;i<gender.length;i++)
	{
		if(gender[i].checked) 
		{
			genderErrorObj.innerHTML = "";
			return true;
		}
	}
		genderErrorObj.innerHTML = "*Please select a gender";
		return false;
}
function isValidDate(dobDay,dobMonth,dobYear)
{		
		console.log(dobDay);
		var dateErrorObj= document.getElementsByClassName("dateError")[0];
		if(dobDay=="" || dobMonth=="" || dobYear=="")
		{
			dateErrorObj.innerHTML = "*Invalid date";
			return false;
		}
		else if(dobMonth==2)
		{
			if((dobYear%4) == 0)
			{
				if(dobDay >29)
				{
					dateErrorObj.innerHTML = "*Invalid date";
					return false;
				}
				else 
				{
					dateErrorObj.innerHTML = "";
					return true;
				}
			}
			else if (dobDay >28)
				{
					dateErrorObj.innerHTML = "*Invalid date";
					return false;
				}
			else
			{
				dateErrorObj.innerHTML = "";
				return true;
			}
		}
		else
		{
			dateErrorObj.innerHTML = "";
			return true;
		}
}
function isValidType(type)
{
	var typeErrorObj= document.getElementsByClassName("typeError")[0];	
	if(type=="") 
	{
		typeErrorObj.innerHTML = "*Please select a type";
		return false;
	}
	else 
	{
		typeErrorObj.innerHTML = "";
		return true;
	}
}
function isValidPhoneNo(phone)
	{
		var phoneErrorObj= document.getElementsByClassName("phoneError")[0];	
		if(phone.length>6)
		{
			var myRegEx= new RegExp('^[0-9]*$');
			if(myRegEx.test(phone)) 
			{
				phoneErrorObj.innerHTML="";
				return true;
			}
			else 
			{
				phoneErrorObj.innerHTML="*Insert a valid phone number.";
				return false;
			}
		}
		else 
		{
			phoneErrorObj.innerHTML="*Insert a valid phone number.";
			return false;
		}
	}