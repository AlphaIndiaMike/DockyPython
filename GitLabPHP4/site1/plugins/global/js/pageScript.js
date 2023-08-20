// JScript source code
//<![CDATA[
$(".textbox").corner("5px");
$("#footer").corner("left 5px");
$(function () {
    $("#menu_").lavaLamp({
        fx: "backout",
        speed: 700,
        click: function (event, menuItem) {
            return false;
        }
    });
});
//]]>