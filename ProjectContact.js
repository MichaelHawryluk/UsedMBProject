/*
* UsedMB Contact Form Validation
*
* Script: Mike Hawryluk
* Author: Mike Hawryluk
* Version: 1.0
* Date created: 20.06.2019
* Last Updated: 20.06.2019
*/

 //Add the event listener for the document load
document.addEventListener("DOMContentLoaded", load );


//	Handles the load event of the document
function load()
{
	document.getElementById("contact").addEventListener("submit", validate, false);

	resetFields();

	let clear = document.getElementById("clearButton");
	clear.addEventListener("click", resetButton, false);
	// let submit = document.getElementById("submit");
	// submit.addEventListener("click", Submit);

}

function validate(e)
{
	hideErrors();

	if(formHasErrors())
	{
		e.preventDefault();

		return false;
	}

	return true;
}

//	Resets values of all error messages on the page
function hideErrors()
{
	//	Call an array of the field id's
	let errorFields = document.getElementsByClassName("error");

	for( let i = 0; i < errorFields.length; i ++ )
	{
		errorFields[i].style.display = "none";
	}
}

//	determines if a text field has input 
//	param fieldElement A text field input element object
//	return True is the field contains input; False if nothing is entered
function formFieldHasInput(fieldElement)
{
	if ( fieldElement.value == null || fieldElement.value == "" )
	{
		//	field was left empty -- returns false
		return false;
	}
	//	valid entry
	return true;
}

//	checks validity of the page checking for errors before the form is submitted
function formHasErrors()
{
	let errorFlag = false;

	var requiredTextFields = ["name","comments"];

	for ( let i = 0; i<requiredTextFields.length; i ++ )
	{
		let textField = document.getElementById(requiredTextFields[i]);

		if(!formFieldHasInput(textField))
		{
			//displaying the appropriate error message
			document.getElementById(requiredTextFields[i] + "_error").style.display = "block";
			if(!errorFlag)
			{
				textField.focus();
				textField.select();
			}

			errorFlag = true;
		}
	}

	let validEmail = document.getElementById("email").value;
	let mailRegEx = new RegExp(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/);

	if( validEmail == "" && !mailRegEx.test(validEmail))
	{
		document.getElementById("email_error").style.display = "block";
		errorFlag = true;
		document.getElementById("email").focus();
	}

	let validPhone = document.getElementById("phone").value;
	let phoneRegex = new RegExp(/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/);

	if( validPhone == "" && !phoneRegex.test(validPhone) )
	{
		document.getElementById("phone_error").style.display = "block";
		errorFlag = true;
	}


	return errorFlag;
}

function resetButton(e)
{
	if(confirm('Clear form?'))
	{
		hideErrors();

		document.getElementById("name").focus();

		return true;
	}
	
	e.preventDefault();

	return false;
}


function resetFields()
{
	document.getElementById("name").value = "";
	document.getElementById("email").value = "";
	document.getElementById("phone").value = "";
	document.getElementById("comments").value = "";
}