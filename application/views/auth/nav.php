<ul id="navigation">
<?php
	if(logged_in())
	{
	?>
	<!--	<li><?php echo anchor('admin/dashboard', 'Dashboard'); ?></li> -->
	    <li><?php echo anchor('Home', 'Acasa'); ?></li>
	    <li><?php echo anchor('Organizator', 'Organizator'); ?></li>
		<li><?php if(user_group('admin')) { echo anchor('admin/users/manage', 'Manage Users'); } ?></li>
		<li><?php echo anchor('logout', 'Logout'); ?></li>
	<?php
	}
	else
	{
	?>
		<li><?php echo anchor('login', 'Logare'); ?></li>
		<li><?php echo anchor('register', 'Inregistrare'); ?></li>
	<?php
	}
?>	

</ul>