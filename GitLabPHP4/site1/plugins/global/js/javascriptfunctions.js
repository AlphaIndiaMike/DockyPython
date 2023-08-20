
function doNothing() 
{

} 


function display_consultant (textToToggle , cellId)
{

var ele = document.getElementById(textToToggle.toString());
var text = document.getElementById(cellId.toString());
	if(ele.style.display == "block") {
    		ele.style.display = "none";
			text.innerHTML = "More >>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Hide >>";
	}
}



function set_menu_button_color_when_clicked(x)
{
 //document.getElementById(x).style.color="#008aae";
 document.getElementById(x.toString()).style.color="#008aae";
}

function goto_adress(adress)
{
location.replace(adress)
}

function mouseover(id)
{
if(id == 'h25')
	{
		document.getElementById('h25').style.color ="black";
	}
	
}

function mouseout(id)
{
if(id == 'h25')
	{
		document.getElementById('h25').style.color ="#FFFFFF";
	}
	
}

function set_flag_paths(filename)
{
var ro_flag_path = '';
var en_flag_path = '';
var de_flag_path = '';

    if(filename == 'index')
 {
	ro_flag_path = 'http://www.psihologic.ro/' + filename + '.php';
		en_flag_path = 'http://www.psihologic.ro/' + filename + 'en' + '.php';
			de_flag_path = 'http://www.psihologic.ro/' + filename + 'de' + '.php';
 }
	else
 {
		ro_flag_path = 'http://www.psihologic.ro/ro files/' + filename + '.php';
			en_flag_path = 'http://www.psihologic.ro/en files/' + filename + '.php';
				de_flag_path = 'http://www.psihologic.ro/de files/' + filename + '.php';
 }
 
 document.getElementById('lgro').href = ro_flag_path;
	document.getElementById('lgen').href = en_flag_path;
		document.getElementById('lgde').href = de_flag_path;
}

function show_lang_menu()
{
document.getElementById("lang_menu").style.visibility = "visible";
}