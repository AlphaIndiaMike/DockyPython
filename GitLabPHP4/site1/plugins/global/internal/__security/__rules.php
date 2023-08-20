<?php

  function has_access($rank_name="S_ID"){
    if ((isset($_SESSION[$rank_name])==true)&&($_SESSION[$rank_name]!="")){
    return true;}
    return 0;
  }

?>