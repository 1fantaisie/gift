<!-- <div id="login">
-->	
	<h2>Login</h2>
	<div class="box">
			<?php echo form_open(); ?>
			Email/Nume:<br />
			<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" class="form" /><?php echo form_error('username'); ?><br /><br />
			Parola:<br />
			<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" class="form" /><?php echo form_error('password'); ?><br /><br />
			<input type="submit" value="Login" name="login" />
			</form>
	</div>