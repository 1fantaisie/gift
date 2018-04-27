<div id='body'> 
<?php echo "<h4>Adaugare cadou</h4>";
	    if(isset ($error)) echo $error;
	     ?> <div id='form'> 
	    <?php echo form_open_multipart('Organizator/view_gift/'.$wId); ?>
	    <?php echo validation_errors(); ?>
	      <label>Titlu:</label><br/>
	        <?php echo form_hidden('wedding',$wId);	?>

	              <input type='text' name='title' class='input'> 
	          	  <br/> 
	          	  <label>Link extern</label><br/>
	          	  		<input type='text' name='link' class='input'><br/>
	     		  <label>Descriere:</label><br/>
	     		  <textarea id='textarea' name="description" ></textarea> 
	             <br/>
                 Poza:<input type="file" name="userfile"  />
                 <br /><br />
				
	             <input type="submit" value="Adauga cadou" id='submit'>
	         </form> 
	         </div>
	         
</div>