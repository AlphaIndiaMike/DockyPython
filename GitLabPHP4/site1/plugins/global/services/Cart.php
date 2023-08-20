<?php 

function view_number_of_selected_products(){
                    if (isset($_GET["proceed"])) return 0;
				    if (isset($_SESSION["p_num"])&&$_SESSION["p_num"]!="") return $_SESSION["p_num"];
                    return 0;
}




