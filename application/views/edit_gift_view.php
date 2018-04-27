<div id='body'> 
<?php echo "<h4>Editare cadou</h4>";
	           $query2=$this->db->get_where('gift',array('id' =>$gId));
	           foreach($query2->result() as $row2 ){
	     ?> <div id='form'>  <?php echo '<form method="post" action="../../Organizator/view_edit/'.$gId.'" enctype="multipart/form-data" >'; ?>
	     		<label>Titlu:</label><br/>
	        <?php echo form_hidden('giftId',$row2->id);
	        echo validation_errors();  
	        echo form_input('title',$row2->title); ?> 
	          	  <br/> 
	          	  <label>Link extern</label><br/>
	          	  		<input type='text' name='link' value='<?php echo $row2->link ?> ' class='input'><br/>
	     		  <label>Descriere:</label><br/>
	     		   <?php $data=array(
	          	   'name'        => 'description',
	          	   'value'=> $row2->description,
	          	   'id' => 'textarea' );
	     		echo  form_textarea($data);
?>	             <br/>
                 Poza:<input type="file" name="userfile"  />
                 <br /><br />
				
	             <input type="submit" value="Modifica" id='submit'>
	         </form> 
	
	         </div>
	         
</div>
<?php }
/* else 
		       { ?>
		        <form method="post" action="../../Organizator/editGift" enctype="multipart/form-data" >
	     		Titlu:
	        <?php echo form_hidden('giftId',$row2->id);
	              echo form_input('title',$row2->title); ?>
	          	  <br/>  <?php
	          	
	              ?>
                 <br/>
                 Poza:<input type="file" name="userfile"  />
                 <br />
				<input type="submit" value="Modifica">
	         </form>
			       <?php
		       } */