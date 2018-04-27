<div id='body'>
<div id="login">
	
	<?php if(empty($username)) { ?>
	<h2>Inregistrare</h2>
	<?php } else { ?>
	<h2>Update</h2>
	<?php } ?>
	
	<div class="box">
			<?php echo form_open(); ?>
			<?php if(empty($username)) { ?>
			Nume:<br />
			<input type="text" name="username" size="50" class="form" value="<?php echo set_value('username'); ?>" /><br /><?php echo form_error('username'); ?><br />
			Parola:<br />
			<input type="password" name="password" size="50" class="form" value="<?php echo set_value('password'); ?>" /><?php echo form_error('password'); ?><br /><br />
			Confirmarea parolei:<br />
			<input type="password" name="password_conf" size="50" class="form" value="<?php echo set_value('conf_password'); ?>" /><?php echo form_error('conf_password'); ?><br /><br />
			<?php } ?>
			Email:<br />
			<?php if(empty($username)){ ?>
				<input type="text" name="email" size="50" class="form" value="<?php echo set_value('email'); ?>" /><?php echo form_error('email'); ?><br /><br />
			<?php }else{ ?>
			<input type="text" name="email" size="50" class="form" value="<?php echo set_value('email', $email); ?>" /><?php echo form_error('email'); ?><br /><br />
			
			<?php }
			require_once('recaptchalib.php');
     		 $publickey='6Lc2ud8SAAAAAMwLRQI42BEj7T_hOGqcd3MUCNwO';
     	 	echo recaptcha_get_html($publickey)."<br/>";
			 if(empty($username)) { ?>
			<input type="submit" class='submit_button' value="Inregistrare" name="register" />
			<?php } else { ?>
			<input type="submit" class='submit_button' value="Update" name="register" />
			<?php } ?>
			</form>
	</div>
</div>
</div>
