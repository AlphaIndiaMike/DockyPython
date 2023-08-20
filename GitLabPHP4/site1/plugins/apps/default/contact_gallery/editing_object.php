<?php
function editing_object($update=false)
{
    $body='';
    $dba=new contact_gallery_model(return_language());
    $p2=link_2e($_GET["topic"],"saveNew");
    if ($update!=false){
       $row=opentb($dba->table_name(),"id=".$update);
       $p2=link_2e($_GET["topic"],"savePerson".substr($_GET["param"],10));
    }
    
         if (allow_edit()==true){
               $body.='
               <form action="'.$p2.'" method="post">
               <div class="floatleft gallery_item">
               <div class="featurebox">
                    
               </div>
                <p class="titlu_mijlociu">Nume: <input class="edit_field" '; if ($update==true) $body.='value="'.$row["nume"].'"'; $body.=' type="text" maxlength="200" id="nume" name="nume"/></p>
                        <p class="text_italic">Functie: <input type="text"'; if ($update==true) $body.='value="'.$row["functie"].'"'; $body.='  class="edit_field" maxlength="200" id="fct" name="fct"/></p>
                        <p class="text_simplu">
                            Tel: &nbsp;&nbsp;&nbsp;&nbsp;<b><input type="text"'; if ($update==true) $body.='value="'.$row["tel1"].'"'; $body.='  class="edit_field" maxlength="20" id="tel1" name="tel1"/></b> <br/>
                            Tel(2): &nbsp;&nbsp;&nbsp;&nbsp;<b><input type="text"'; if ($update==true) $body.='value="'.$row["tel2"].'"'; $body.='  class="edit_field" maxlength="20" id="tel2" name="tel2"/></b> <br/>';
                    $body.='
                        </p>
                        <p class="text_simplu">
                            Mail : &nbsp;&nbsp;&nbsp;&nbsp;<b><input type="text"'; if ($update==true) $body.='value="'.$row["mail1"].'"'; $body.='  class="edit_field" maxlength="200" id="mail1" name="mail1"/></b> <br/>
                            Mail(2): &nbsp;&nbsp;&nbsp;&nbsp;<b><input type="text"'; if ($update==true) $body.='value="'.$row["mail2"].'"'; $body.='  class="edit_field" maxlength="200" id="mail2" name="mail2"/></b> <br/>';
                    $body.='
                        </p>
                <input type="submit" class="menu_edit_submitbtn" value=" " style="position:relative; float:right;"/>
                </div>
                
                </form>
                ';
            }
    return $body;
}
?>