
<?php

$query=$this->db->get_where('weddings',array('id' => $this->input->post('id')));	
     
	         // afisare nunti existente 
   		foreach ($query->result() as $row){
	   	 $weddingId=$row->id;	
	     echo $row->numeB." ".$row->prenumeB." & ".$row->numeF." ".$row->prenumeF;
	     echo "<br/>Data: ".$row->data;
	     echo "<br/>Locatia: ".$row->locatia;
	     $photo="../".$row->photo;
	      if ($row->photo != "") echo '<br/><img src="uploads/'.$photo.'" width="150"  />';
	     //afisare cadouri
	     $query2=$this->db->get_where('gift',array('weddingId' =>$row->id));
	      if ($query->num_rows() > 0)
  	      {   echo "<h4>Cadouri</h4><ul>";  
	           
		      foreach ($query2->result() as $row2)
	       {
		       echo "<li>".$row2->title."<br/>".$row2->description;
		        $photo2="../".$row2->photo;
		       if ($row2->photo != "") echo '<img src="uploads/'.$photo2.'" width="150"  />';
		       echo "<form action='../Organizator/deleteGift' method='post'>";
		       echo form_hidden('id',$row2->id);
		       echo  "<input type='submit' value='Sterge cadou' >";
		       echo form_close()."</li>"; 
		       
	       }
	       echo "</ul>";
	       }
	     // adaugare cadouri 
	     echo "<h4>Adaugare cadouri</h4>";
	    if(isset ($error)) echo $error;
	     ?>    <form method="post" action="../Organizator/gift"enctype="multipart/form-data" />
	     		Titlu:
	        <?php echo form_hidden('wedding',$row->id);
	              echo form_input('title'); ?>
	          	  <br/> 
	     		  Descriere:<textarea rows="2" cols="36" name="description" ></textarea> 
	             <br/>
                 Poza:<input type="file" name="userfile"  />
                 <br /><br />
				
	             <input type="submit" value="Adauga">
	         </form>
	     <h4>Generare cod:</h4> <!-- Genereaza cod pentru nuntasi -->
	     <form action="generate" method="post">
	     Introduceti numarul de coduri pe care doriti sa le generati:
	           <?php 
	           		 echo form_hidden('id',$weddingId);
	           		 echo form_input('nr');
	                 echo form_submit('generation','Genereaza');
	                 echo form_close();
	    $query2=$this->db->get_where('cod',array('weddingId'=>$weddingId));
	   
			 if ($query2->num_rows() > 0) 
	     {   echo "<ol>";
		     foreach($query2->result() as $row )
	     	{
		     	echo "<li>".$row->cod."</li>";
	     	}
	     	echo "</ol>";
     	 }
       }
       
       ?>