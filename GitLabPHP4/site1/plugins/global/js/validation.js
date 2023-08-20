/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#customForm");
	var name = $("#name");	name.blur(validateName); name.keyup(validateName);
	var nameInfo = $("#nameInfo");
	var email = $("#email"); email.blur(validateEmail);
	var emailInfo = $("#emailInfo");
	var pass1 = $("#pass1"); pass1.blur(validatePass1); pass1.keyup(validatePass1);
	var pass1Info = $("#pass1Info");
	var pass2 = $("#pass2"); pass2.blur(validatePass2); pass2.keyup(validatePass2);
	var pass2Info = $("#pass2Info");
	var message = $("#address"); message.keyup(validateMessage);
    var company = $("#company"); company.blur(validateCompany); company.keyup(validateCompany);
	var companyInfo = $("#companyinfo");
    var city = $("#city"); city.blur(validateCity); city.keyup(validateCity);
	var cityInfo = $("#cityinfo");
    var country = $("#country"); country.blur(validateCountry); country.keyup(validateCountry);
	var countryInfo = $("#countryinfo");
    var tel = $("#tel"); tel.blur(validateNumber); tel.keyup(validateNumber);
	var telInfo = $("#telinfo");
	
	form.submit(function(){
		if(validateName() & validateEmail() & validatePass1() & validatePass2() & validateMessage() & validateCountry()
        & validateCompany() & validateCity() & validateNumber())
			return true
		else
			return false;
	});
    
	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error");
			emailInfo.text("You typed an valid e-mail address!");
			emailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			emailInfo.text("Type an valid e-mail address please !");
			emailInfo.addClass("error");
			return false;
		}
	}
	function validateName(){
		//if it's NOT valid
		if(name.val().length < 4){
			name.addClass("error");
			nameInfo.text("Name may have more than 3 letters!");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			name.removeClass("error");
			nameInfo.text("Please eneter your name");
			nameInfo.removeClass("error");
			return true;
		}
	}
	
    function validateCompany(){
		//if it's NOT valid
		if(company.val().length < 2){
			company.addClass("error");
			companyInfo.text("Company name may have more than 2 letters!");
			companyInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			company.removeClass("error");
			companyInfo.text("Company`s name, it`s important for inquiries` validation.");
			companyInfo.removeClass("error");
			return true;
		}
	}
    
    function validateCountry(){
		//if it's NOT valid
		if(country.val().length < 2){
			country.addClass("error");
			countryInfo.text("Country name too short!");
			countryInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			country.removeClass("error");
			countryInfo.text("Please insert your country name.");
			countryInfo.removeClass("error");
			return true;
		}
	}
    
    function validateCity(){
		//if it's NOT valid
		if(city.val().length < 2){
			city.addClass("error");
			cityInfo.text("City too short!");
			cityInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			city.removeClass("error");
			cityInfo.text("Please insert your city name.");
			cityInfo.removeClass("error");
			return true;
		}
	}
    
// PHONE
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}
function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
var bracket=3
strPhone=trim(strPhone)
if(strPhone.indexOf("+")>1) return false
if(strPhone.indexOf("-")!=-1)bracket=bracket+1
if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
var brchr=strPhone.indexOf("(")
if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false
if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
s=stripCharsInBag(strPhone,validWorldPhoneChars);
return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}
/*PHONE */


    function validateNumber(){
		//if it's NOT valid
		if(checkInternationalPhone($("#tel").val())==false){
			tel.addClass("error");
			telInfo.text("Please enter a valid phone number (international format)!");
			telInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			tel.removeClass("error");
			telInfo.text("Please insert a valid phone number (international)!");
			telInfo.removeClass("error");
			return true;
		}
	}
	   
	function validatePass1(){
		var a = $("#password1");
		var b = $("#password2");

		//it's NOT valid
		if(pass1.val().length <5){
			pass1.addClass("error");
			pass1Info.text("Password must have at least 5 characters: letters, numbers and '_'");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			pass1.removeClass("error");
			pass1Info.text("Password must have at least 5 characters: letters, numbers and '_'");
			pass1Info.removeClass("error");
			validatePass2();
			return true;
		}
	}
	function validatePass2(){
		var a = $("#password1");
		var b = $("#password2");
		//are NOT valid
		if( pass1.val() != pass2.val() ){
			pass2.addClass("error");
			pass2Info.text("Passwords doesn't match!");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2.removeClass("error");
			pass2Info.text("Confirm password");
			pass2Info.removeClass("error");
			return true;
		}
	}
	function validateMessage(){
		//it's NOT valid
		if(message.val().length < 10){
			message.addClass("error");
			return false;
		}
		//it's valid
		else{			
			message.removeClass("error");
			return true;
		}
	}
});