<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
        <?php echo view_title(); ?>
    </title>
    <?php echo view_meta(); ?>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_css('style.css');?>" />
    <link rel="stylesheet" media="all" type="text/css" href="plugins/css/examples.css" />
    <?php if (isset($header)) echo $header;?>
</head>

<body>  
<div id="page_wrapper">
    <div id="header_wrapper">
    <div id="header"> 
        <div id="logo">
           <a style="font-family: Impact; font-size:60px; color:#004083; text-decoration:none;">&nbsp;MISIA</a>
           <a style="font-family: Arial; font-size:20pt; text-decoration:none; color:#eee; position:relative; left:100px; top:0px;">spare parts</a>
        </div>  <?php 
        echo '<div class="functional2">';
        echo $functional; show_security();
        echo '</div>';?>
        
    </div>

	<?php echo main_menu();?>

    </div>

    <?php 
        echo $content;  
   
/*
<div id="footer">
<div style="position: relative; top:90px; left: 520px; width:500px;">
    <a href="index.php">Home</a> | 
    <a href="#">Spare parts catalog</a> | 
    <a href="#">Request a part</a> | 
    <a href="http://www.misiahoist.it" target="_blank">MISIA Hoist</a>
    <br/>
    <a>Misia Paranchi S.r.l - All rights reserved.</a>
</div>
</div>*/
 ?>
</div>
<script type="text/javascript">
//<![CDATA[
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28049414-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
//]]>
</script>
</body>
</html>
