<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
        <?php echo view_title(); ?>
    </title>
    <?php echo view_meta(); ?>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <?php //<link rel="stylesheet" type="text/css" href="<?php echo get_css('style.css');" /> ?>
    <style type="text/css">
		body{margin:0px; padding:0px;}	
			.to_center{margin:0 auto;}
			.to_right{float:right; display:inline;}
    </style>
    <?php 
     echo insert_js('jquery-1.9.0.min.js'); 
     if (isset($header)) echo $header;?>
</head>

<body>
<body>
		<div style="width:100%; height:80px; padding-top:70px;">
			<div style="position:absolute; z-index:0; height:31px; width:100%;  background-color:black">
				<div class="to_center" style="width:900px; height:74px">
					
					<img onclick="location.href='/ro/default.html'" style="cursor:pointer; position:absolute; z-index:100; width:190px; height:75px; bottom:0px;" alt="reVox" src="<?php echo get_image("logo_mic.jpg"); ?>"/>
					
					<div class="to_right" style="width:650px; height:31px; color:White; font-family: arial; font-size:14pt; font-weight:bold;">
						<div style="top:5px; position:relative;">
							<?php echo main_menu();?>
	    					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="to_center" style="width:900px; padding-top:10px; padding-bottom: 10px;">
		<?php echo $content; ?>
		</div>
	
<div class="to_center" style="width:900px; padding-top:10px; padding-bottom: 10px;">
	<center>
	<p style="font-size:9pt;">&#169; Copyright 2012. All Rights Reserved.<br/>
	Webmaster: <?php show_security();?>
	</p>
	</center>
</div>

</body>
</html>
