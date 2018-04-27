 <div id='body'>
 
    <div id='form'>
		<form action='Contact' method='post'>
		<?php echo validation_errors(); ?>
		Nume<br/>
		<input type="text" name='nume' >
        <br/>E-mail<br/>
        <input type="text" name='email'>
        <br/>Mesaj<br/>
        <textarea id="tarea" name='mesaj'></textarea><br/>
        <?php require_once('recaptchalib.php');
     		 $publickey='6Lc2ud8SAAAAAMwLRQI42BEj7T_hOGqcd3MUCNwO';
     	 	echo recaptcha_get_html($publickey)."<br/>"; ?>
		<input class="submit_button" type="submit" value="Trimite">
		</form>
	</div>
	<?php if(! logged_in()){ ?>
		<div id='cod'> 
  <form action="Home/cod" method="post"> 
 	Introduceti codul : <?php
    echo form_input('cod');
    echo form_submit('code','Ok','id="search_submit"');
    echo form_close(); 
    echo "</div> ";
} 
   ?>
   
</div>	
</body>
</html>
