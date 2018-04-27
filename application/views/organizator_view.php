  <?php // hex to rgb function
   function rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
} ?> 
   <!-- Page Start -->
 <div id='body'>
     
                
        <?php  //   display current wedding
     	   
	    
      $w_id=$this->session->userdata('currentW');   
        if ($this->session->userdata('currentW'))
      {  
	    $query=$this->db->get_where('weddings',array('id'=>$w_id));	   
	      
      }
	    else {      
		       
   		 $query=$this->db->get_where('weddings',array('userId' => $this->session->userdata('id')));	}
  	 if (($query->num_rows() == 1) || ($this->session->userdata('currentW'))){ 
	         // afisare nunta
   		 foreach ($query->result() as $row){
	   	 $weddingId=$row->id;
	   	     $query_gift=$this->db->get_where('gift',array('weddingId' =>$row->id,'valid'=>'0'));
	   	    $selected_gifts=$query_gift->num_rows();
			$query2=$this->db->get_where('gift',array('weddingId' =>$row->id));
		echo "<h2 id='spage_title'> Organizator </h2>";
     echo ' <div id="selected_wedding" >';  
	       echo '<br/><img src="'.$row->photo.'" height="175" width="175" id="wedding_photo"><br/>';
	     echo '<h2 id="wedding_title">'.$row->prenumeB." & ".$row->prenumeF.'</h2>';
	  
	     echo "<img src='../photos/calendar.png' height='18' class='calendar_p'> <div id='s_date'>".$row->day." ".$row->month_name." ".$row->year."</div><div id='s_day'><br/>".$row->week_day.'</div>';
	     echo "<br/><img src='../photos/location.png' height='20' class='location_p'> <div id='s_location'>".$row->locatia."</div>";
		 echo "<div id='total_gifts'>".$query2->num_rows()." cadouri<br/>";
		 echo  $selected_gifts." alese</div>";
		 echo "Codul nuntii: ".$row->cod;
		 echo '<div class="wedding_buttons">';
	     echo anchor('Organizator/view_gift','adauga un cadou','class="add_link"');  
	       ?> </div>    
	        <form method='post' action='Organizator/view_edit_wedding'>
	     <?php  echo form_hidden('wId',$weddingId); ?>
	        <input type="submit" value='modifica nunta' id="wedding_submit"/>
	        </form> 
	     <?php
	     	 echo '<div class="wedding_buttons">';
	     	echo anchor('Organizator/delete_wedding/'.$weddingId,'sterge nunta','class="add_link"');
	     	echo "</div></div>";
         if( $this->session->userdata('currentW')) 
	    { 
		 echo "<div class='add'>".anchor ("Organizator/reset","Lista nunti",'class="add_link"')."</div>";
	    } 
	    else {
		     echo "<div class='add'>".anchor('Organizator/view_add','Adauga nunta','class="add_link"')."</div>";  
		    }
	     //afisare cadouri
	     ?> <div  style='clear:left'></div> <?php
       //  $edit=$this->input->post("giftId");   
	     
	      if ($query2->num_rows() > 0)
  	      {  
	           
		      foreach ($query2->result() as $row2)
	       {   
			    
			   if ($edit != $row2->id) {
		         
		         echo "<div class='gift'>";
		         echo '<div class="gift_photo"><img src="'.$row2->photo.'" height="150" width="150"  />'."</div>";
		      echo "<div class='edit_gift_div'>".anchor('Organizator/view_edit/'.$row2->id,"<img src='../photos/edit.png' height='18px'>"," class=edit_gift");
		      echo "</div>";
		     
			   echo  "<br/></br><div class='trash_div'>".anchor('Organizator/deleteGift/'.$row2->id,"<div class='trash'><img src='../photos/trash.png' height='21px'></div>");
			   echo "</div>";	
			    echo  "<br/></br><div class='trash_div'>".anchor($row2->link,"<img src='../photos/extern.png' height='20px'>",'class="trash" target="_blank"');
			    echo "</div>";		       
		         echo "<div class='gift_center'><div class='gift_title'>".$row2->title."</div><br/>";
		         echo "<div class='gift_description'>".$row2->description."</div></div>";  }
		      
		    if($row2->valid == 1)
		    	$gift_type='unchosen_gift';
		    else 
		    	$gift_type="chosen_gift"; 
		    echo "<div class='".$gift_type."'></div>"; 
		    echo " </div>";
	       }
			}
	       }
	     
	 /*  ?>  
	     <h4>Generare cod:</h4> <!-- Genereaza cod pentru nuntasi -->
	     <form action="Organizator/generate" method="post">
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
      */ }
       
        // afisare lista nunti
       elseif($query->num_rows() > 1)
       { ?>
	 <h2 id='page_title'> Organizator </h2>           
     <div id='date'> <?php 
		echo date('l');
?>	<div id='date2'> <?php	echo '<div id="date2">'.date('F j').'</div>'; ?>
	</div></div>
	     <div class='add'>
     <?php echo anchor('Organizator/view_add','Adauga nunta','class="add_link"');  ?>
         </div>
       <div id='clear' style='clear:both'></div> <?php
	       foreach ($query->result() as $row){
		       $pcolor=rgb($row->pcolor);
       		$scolor=rgb($row->scolor);
	       	$pr=$pcolor[0];
       		$pg=$pcolor[1];
       		$pb=$pcolor[2];
       		$sr=$scolor[0];
       		$sg=$scolor[1];
       		$sb=$scolor[2];
		      echo "<div class='wedding_body' >";
		  	  echo "<div class='wedding_color_left' style='background-color:rgba(".$sr.",".$sg.",".$sb.",0.26);'></div>";
		      	   $weddingId=$row->id;
		           $fullname="<h4>".$row->prenumeB." & ".$row->prenumeF.'</h4>';
		  		   $link='Organizator/wedding/'.$weddingId;
	        echo "<div class='wedding_color_right' style='background-color:rgba(".$pr.",".$pg.",".$pb.",0.26);'>";
		  	echo "<div class='photo'>";
	           $photo='<img src="'.$row->photo.'" height="123px" width="123px"  />';   
	     echo anchor($link,$photo).'</div>';
	     echo '<div class="center">'.anchor($link,$fullname,'class="name"')."<div class='loc'>".$row->locatia.'</div></div>';
	     echo "<div class='right'> <div class='day'>".$row->day."</div><div class='month'>";
	     echo $row->month."</div><div class='year'>".$row->year.'</div></div></div></div>';
       }
	       
       }
       
       else { ?>
		   <h2 id='page_title'> Organizator </h2>           
     <div id='date'> <?php 
		echo date('l');
?>	<div id='date2'> <?php	echo '<div id="date2">'.date('F j').'</div>'; ?>
	</div></div>
	     <div class='add'>
     <?php echo anchor('Organizator/view_add','Adauga nunta','class="add_link"');  ?>
         </div>   <div id='clear' style='clear:both'></div><?php
		   echo "<h4>Nu ati adaugat nici o nunta inca</h4>"; }
   		?>
   </div>
