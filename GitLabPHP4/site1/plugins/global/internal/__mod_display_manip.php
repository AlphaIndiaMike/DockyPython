<?php 	
	function redirect($location)
	  		{
	  				echo'
	  				<script type="text/javascript" language="javascript">
	  					window.location ="'.$location.'";
	  				</script>
	  				';
	  		}
	  		
	function set_page($opt)
	{
		echo'
	  				<script type="text/javascript" language="javascript">
	  					setTimeout("move_up('."'".'opt'.$opt."'".','.$opt.');",500);
	  				</script>
	  				';
	}
	
	function tab($no_tabs)
	{
		for ($i=1; $i<=$no_tabs; $i++)
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
    
    function check_email_address($email) { 
           // checks proper syntax
          if( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
          {
            return false;
          }
          return true;
    }
	  		
?>