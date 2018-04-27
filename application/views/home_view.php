  <div id='body'>  

 <div id='welcome'>Bun venit </div>
 <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
 Maecenas eget magna malesuada odio rutrum condimentum vitae non purus.
  Mauris vitae feugiat nulla. Integer pellentesque venenatis turpis, at
   elementum ante facilisis ut. Sed et sodales eros. Pellentesque eget justo
    sit amet ligula rhoncus posuere hendrerit eu purus. Donec quis sapien
     libero, vitae eleifend quam. Cras fermentum rutrum dolor vel molestie.
     Suspendisse eu mauris in neque lacinia adipiscing. Nullam adipiscing turpis eget nunc consequat pharetra.
      Ut interdum suscipit pharetra. 
  </p>
	<div id="login">
			<form action='login' method='post'>
			Email/Nume:<br />
			<input type="text" name="username" value="<?php echo set_value('username'); ?>"  class="form" /><?php echo form_error('username'); ?><br /><br />
			Parola:<br />
			<input type="password" name="password" value="<?php echo set_value('password'); ?>"  class="form" /><?php echo form_error('password'); ?><br /><br />
			<input type="submit" value="Login" name="login" id='submit_button'/>
			</form>
	</div>
	<div id='date'>
		<?php 
		echo date('l');
		echo '</br><div id="date2">'.date('F j').'</div>'; ?>
	</div>
	
	<div id='search'>
	<form action="Home/cod" method="post"> 
 	<div id='search_body'><label>Introduceti codul</label> <br/><?php
    echo "<input type='text' name='cod' class='form'>";
    echo '</br>'."<input type='submit' id='search_submit' value='ok'>";
    echo form_close();
   ?></div>
   </div><?php
    //afisarea tuturor nuntilor existente
/* $query=$this->db->get('weddings'); 
 foreach ($query->result() as $row)
 {
	  echo "<h3>".$row->numeB." ".$row->prenumeB." & ".$row->numeF." ".$row->prenumeF."</h3>";
	     echo "Data: ".$row->data;
	     echo "<br/>Locatia: ".$row->locatia;
 }
 */

 ?>
  </div>  