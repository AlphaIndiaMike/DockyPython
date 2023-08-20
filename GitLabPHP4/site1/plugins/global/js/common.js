/*
 * ---------------------------
 * functions for the examples
 * ---------------------------
 */
 //USES
function mycallbackfunc(v,m,f){
	$.prompt('i clicked ' + v);
}

function write_part(id,name){
var txt = '<br/><div class="mainpopup"><div class="inpopup">You selected the following part:&nbsp;';
var txt2 ='<br/>Insert hoist serial for selected part: '+
//Inputs
'<input type="text" id="CraneID" name="CraneID" value="" /><br /><br/><input type="hidden" id="PartID" name="PartID" value="'+
id+'" /><input type="hidden" id="PartName" name="PartName" value="'+name+
'" /><input type="hidden" id="PageNumber" name="PageNumber" value="'+get_page_number()+'" /></div>';
//Image
var txt3 = '<div class="inpopup" style="width:320px;"><img src="../plugins/global/images/serial.jpg" alt="serial" width="310"/></div></div>';
return txt+"<br/><b class='blue_text'>"+name+"</b>"+txt2+txt3;
}

function write_form(){
var txt = '<br/>Dear Sir/Madam, we are sorry,  your inquiry cannot be processed if the serial # is not given - Thank you&nbsp;';
var txt2 ='<br/>Insert serial for all parts: <input type="text" id="CraneID" name="CraneID" value="" />';
return txt+txt2;
}

function delete_form(deleteID){
var txt = '<br/>Are you sure you want to delete selected request?';
var txt2 ='<br/><input type="hidden" id="DeleteID" name="DeleteID" value="'+deleteID+'" /><br/><br/>';
return txt+txt2;
}

function deleteCallback(v,m,f){
    if(v != false){
      location.href="?delete_req="+f.DeleteID;
    }
}

function callbackfunction(v,m,f)
{
    if(v != false){
      location.href="?add="+f.PartID+"&name="+f.PartName+"&uid="+f.CraneID+"&page_catalog="+f.PageNumber;
    }
}

function callbackform(v,m,f){
	if((v != false)&&(f.CraneID!=""))
		location.href="?global_ID="+f.CraneID;
}
//BLOWTWARE
function mycallbackform(v,m,f){
	if(v != undefined)
		$.prompt(v +' ' + f.alertName);
}


function mysubmitfunc(v,m,f){
	an = m.children('#alertName');
	if(f.alertName == ""){
		an.css("border","solid #ff0000 1px");
		return false;
	}
	return true;
}

(function($){
	$.fn.extend({
		dropIn: function(speed,callback){
			var $t = $(this);

			if($t.css("display") == "none"){
				eltop = $t.css('top');
				elouterHeight = $t.outerHeight(true);

				$t.css({ top: -elouterHeight, display: 'block' }).animate({ top: eltop },speed,'swing',callback);
			}
		}
	});
})(jQuery);


//var txt2 = 'Try submitting an empty field:<br /><input type="text" id="alertName" name="alertName" value="" />';	

var brown_theme_text = '<h3>Example 13</h3><p>Save these settings?</p><img src="images/help.gif" alt="help" class="helpImg" />';

var statesdemo = {
	state0: {
		html:'test 1.<br />test 1..<br />test 1...',
		buttons: { Cancel: false, Next: true },
		focus: 1,
		submit:function(v,m){ 
			if(!v) return true;
			else $.prompt.goToState('state1');//go forward
			return false; 
		}
	},
	state1: {
		html:'test 2',
		buttons: { Back: -1, Exit: 0 },
		focus: 1,
		submit:function(v,m){ 
			if(v==0) $.prompt.close()
			else if(v=-1) $.prompt.goToState('state0');//go back
			return false; 
		}
	}
};
