
<div id='body'>
    <h2 class='title' id='title'> Adaugare nunta </h2>
  <div id='add_body'> 
  	<div id='left_add'> 
  	<?php
 echo form_open_multipart('Organizator/view_add'); 
     // Adaugare nunta noua
   
      //	echo "<label>Numele mirelui</label> </br>";
     //	  	echo form_input('numeB');
    	  echo "<br/><label>Prenumele mirelui</label></br> ";
    	  ?><input type="text" name="prenumeB" value="<?php echo set_value('prenumeB'); ?>"  />
          <br/><label>Prenumele miresei</label></br> 
    	  	<input type="text" name="prenumeF" value="<?php echo set_value('prenumeF'); ?>"  />
    	  </br></br><label>Locatie</label></br> 
          	<input type="text" name="loc" value="<?php echo set_value('loc'); ?>"  />
          </br><label>Data</label></br> 
          	<input type="text" id='datepicker' name="data" value="<?php echo set_value('date'); ?>"  />
         <label>Culoarea principala</label></br> 
          	<input class='color' name='pcolor'value="<?php echo set_value('pcolor'); ?>"  />
          	 </br><label>Culoarea secundara</label></br> 
          	<input class='color' name='scolor'value="<?php echo set_value('scolor'); ?>"  />
         
             <br/>
                <label>Poza</label> </br> <input type="file" name="userfile"  />
        </div>
        <?php echo validation_errors(); ?>
    <div id='right_add'> <h2 class='title'> mire </h2>
        <h2 class='title'> mireasa </h2> 
        <div id='submit'> 
   			<input type='submit' value='adauga nunta' id='submit_button'/>	 
        </div>
   		<?php	echo form_close();
		?>
   		<div style='clear:both;'></div>
   	</div>
 </div>
 </div>