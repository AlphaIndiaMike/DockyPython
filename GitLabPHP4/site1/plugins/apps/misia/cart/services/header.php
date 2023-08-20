<?php
     if (isset($_GET["add"])&&($_GET["add"]!="")&&isset($_GET["name"])&&($_GET["name"]!="")){
  			$id=addslashes($_GET["add"]);
			if (!isset($_SESSION["p_num"])) $_SESSION["p_num"]=0;
			if ($_SESSION["p_num"]=="") $_SESSION["p_num"]=0;
			
			$ck=0;
			if ($_SESSION["p_num"]<=250){
				if (isset($_SESSION["cart"]))
				for ($i=0; $i<=$_SESSION["p_num"]; $i++)
				{
					if ((isset($_SESSION["cart"][$i]))&&($_SESSION["cart"][$i]==$id)) $ck=1;
				}
				if ($ck==0){
					$_SESSION["cart"][$_SESSION["p_num"]]=$id;
                    $_SESSION["cart_name"][$_SESSION["p_num"]]=$_GET["name"];
                    if(isset($_GET["uid"])&&($_GET["uid"]!="")) $_SESSION["set_id"][$_SESSION["p_num"]]=$_GET["uid"];
					$_SESSION["p_num"]=$_SESSION["p_num"]+1;
                    //echo '<script type="text/javascript">location.href="'.self_hrefr(false,"page_catalog",return_random_tag("page_catalog")).'"</script>';
			    }
			}
			else 
			{
				$ck=2;
			}
     }
     if (isset($_GET["q"]))
     {
    	$id=addslashes($_GET["q"]);
    	if (($_SESSION["cart"][$id]!="")&&(isset($_POST["q_num".$id.""])))
    	$_SESSION["quantity"][$id]=addslashes($_POST["q_num".$id.""]);
     }

    if (isset($_GET["set_id"]))
     {
    	$id=addslashes($_GET["set_id"]);
    	if (isset($_POST["id_num".$id.""]))
    	$_SESSION["set_id"][$id]=addslashes($_POST["id_num".$id.""]);
     }
     
     if (isset($_GET["global_ID"]))
     {
    	$id=addslashes($_GET["global_ID"]);
        for ($i=0; $i<$_SESSION["p_num"]; $i++)
    	   $_SESSION["set_id"][$i]=$id;
     }

    if (isset($_GET["del_pr"]))
    {
    	$id=addslashes($_GET["del_pr"]);
    	
    	if (isset($_SESSION["cart"][$id]))
    	if (($_SESSION["cart"][$id]!=""))
    	{
    		
    		for ($i=$id; $i<$_SESSION["p_num"]-1; $i++)
    		{
    			if (isset($_SESSION["cart"][$i+1]))
    				$_SESSION["cart"][$i]=$_SESSION["cart"][$i+1];
    			else 
    				unset($_SESSION["cart"][$i]);
                    
                if (isset($_SESSION["cart_name"][$i+1]))
    				$_SESSION["cart_name"][$i]=$_SESSION["cart_name"][$i+1];
    			else 
    				unset($_SESSION["cart_name"][$i]);
                    
                if (isset($_SESSION["set_id"][$i+1]))
    				$_SESSION["set_id"][$i]=$_SESSION["set_id"][$i+1];
    			else 
    				unset($_SESSION["set_id"][$i]);
    			
    			if (isset($_SESSION["quantity"][$i])&&isset($_SESSION["quantity"][$i+1]))
    				$_SESSION["quantity"][$i]=$_SESSION["quantity"][$i+1];
    			else 
    				if (isset($_SESSION["quantity"][$i]))
    					unset($_SESSION["quantity"][$i]);
    		}
    		if (isset($_SESSION["cart"][$_SESSION["p_num"]-1])) unset($_SESSION["cart"][$_SESSION["p_num"]-1]);
            if (isset($_SESSION["cart_name"][$_SESSION["p_num"]-1])) unset($_SESSION["cart_name"][$_SESSION["p_num"]-1]);
            if (isset($_SESSION["set_id"][$_SESSION["p_num"]-1])) unset($_SESSION["set_id"][$_SESSION["p_num"]-1]);
    		if (isset($_SESSION["quantity"][$_SESSION["p_num"]-1])) unset($_SESSION["quantity"][$_SESSION["p_num"]-1]);
    		$_SESSION["p_num"]=$_SESSION["p_num"]-1;
    		
    	}
    }

?>