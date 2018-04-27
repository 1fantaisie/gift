<!DOCTYPE html> 
<?php if (isset($wId)){ ?>
<div id='body'>
    <h2 class='title' id='title'> Editare nunta </h2>                   
 <?php  
 		$query=$this->db->get_where('weddings',array('id'=>$wId));   
 		foreach($query->result() as $row)
 		{
     ?> 
 <div id='add_body'> 
  	<div id='left_add'>  
  	<?php echo validation_errors();  ?>
   <form method="post" action="view_edit_wedding" enctype="multipart/form-data" />
    <?php  // Editare nunta 
  //  	  echo "Numele mirelui: ";
    //	  	echo form_input('numeB',$row->numeB);
    echo form_hidden('wId',$wId);	  
    echo "<br/>Prenumele mirelui:";
    	  	echo form_input('prenumeB',$row->prenumeB);
      //    echo "<br/></br>Numele miresei: ";
    	//  	echo form_input('numeF',$row->numeF);
          echo "<br/>Prenumele miresei: ";
    	  	echo form_input('prenumeF',$row->prenumeF);
    	  echo "<br/></br>Locatie: ";
          	echo form_input('loc',$row->locatia);
          echo "<br/>Data <br/> ";
          	echo "<input type='text'id='datepicker' name='data' value='".$row->date." '/>";
            
            echo form_hidden ('wId',$wId);                                                                               
       echo "<br/><label>Culoarea principala</label></br> ";
          	echo "<input class='color' name='pcolor' value='".$row->pcolor."'>";
          	 echo "</br><label>Culoarea secundara</label></br> ";
          	echo "<input class='color' name='scolor' value='".$row->scolor."'>";
          	 echo '<br/><img src="../'.$row->photo.'" width="30"  />';
             echo '   Poza: <input type="file" name="userfile"  />';
             //partea dreapta 
             ?></div>  <div id='right_add'> <h2 class='title'> mire </h2>
        <h2 class='title'> mireasa </h2> 
        <div id='submit'>       
                  <input type='submit' value='Salveaza ' id='submit_button'/>	 
        </div>
   		<?php 	echo form_close();
   		?>	
   	<div style='clear:both;'></div>
   	</div>
 </div>
 	</div>
 
  <?php
		}}
		else 
		{
			redirect ('Organizator','refresh');
		}
    ?>
	
