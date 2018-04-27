 <html>
 <head>
   <link rel="stylesheet" type="text/css" href=" ../css/reset.css "/> 
<?php if(isset ($add)) { ?>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  
  </script>
  <script type="text/javascript" src="../../jscolor/jscolor.js"></script>
 <?php }
  if(isset ($wedding_color))
  {
	echo '<link rel="stylesheet" type="text/css" href="'.base_url($wedding_color).' "/> ';	  
  }
  $menu_ref=base_url('css/menu.css');  
   if(isset($ref)){ 
  $ref=base_url('css/'.$ref) ;	?>
 <link rel="stylesheet" type="text/css" href=" <?php echo $ref ?> "/> 
 <?php } ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $menu_ref ?>"/>
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
 
 
 
 <title> <?php if (isset ($title)) echo $title  ?>
 </title>
 
 </head>
 <body>
 <div class='menu' id='menus' > <div id='wrapper'>

 <?php   	   	
      echo  anchor('Home','Acasa','class="menul"');
      if(!logged_in()){
	   //echo anchor ('login','Logare','class="menul"');   
	   echo anchor('register','Inregistrare','class="menul"');   
      }
  	  else{ echo anchor('Organizator/reset','Organizator','class="menul"');
  	        if(user_group('admin') === TRUE)
  	        {
	  	        echo anchor('admin/users/manage','Admin','class="menul"');
  	        }
  	        echo anchor('Home/logout','Logout','class="menul"');
  	   	  	} 
  	   	  	echo anchor('Contact','Contact','class="menul"');
  	  		echo anchor('Despre','Despre noi','class="menul"');	
  	  		?> 
</div></div>
