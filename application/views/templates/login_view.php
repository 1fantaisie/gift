 <h3>Logare</h3>
   <form method="post" action="Login"> 
       Email: 
 		<?php echo form_input('email');
       		echo "<br/> Parola: ".form_password('parola');    
       		echo "<br/>".form_submit("login","Login");
       		echo form_close();
       		
   ?>