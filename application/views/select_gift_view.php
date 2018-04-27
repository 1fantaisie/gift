

<div id='body'>
<?php
	 if($cod != ""){
		// $value = 'something from somewhere';
       // setcookie("TestCookie", $value, time()+3600);  /* expire in 1 hour */
		 $valid_gift=1;
	$query=$this->db->get_where('weddings',array('cod'=>$cod));
     	 if ($query->num_rows() > 0){ 
	         // afisare nunti existente 
	       foreach ($query->result() as $row){
		        if(isset($_COOKIE['sg'])){
		 $cookie=$_COOKIE['sg'];
	 $query_id=$this->db->get_where('id',array('uid'=> $cookie,'weddingId'=> $row->id ));
	 foreach ($query_id->result() as $row_id){
	 $sGift=$row_id->choseen_gift_id;	 
	 
	  $query_cookie=$this->db->get_where('gift',array('id'=> $sGift ));
	 foreach ($query_cookie->result() as $row_cookie){
		$valid=0;
		$chosen=$sGift; 	 
			?> <div id='chosen'> 
			<form method="post" action="undo_gift"> <?php  
			echo '<div class="cgift_photo"><img src="../'.$row_cookie->photo.'" height="150" width="150"  />'."</div>";
			echo "<div id='center'>Ati ales cadoul:".$row_cookie->title; 
			echo  form_hidden ('gift',$chosen);
			 echo $row_cookie->description."</div>";
			 echo  "<input type='submit' value='Anuleaza cadoul ales!' id='add' >";
			 echo  form_close();
			 echo "</div>"; 
 }}}
	   	 $weddingId=$row->id;
	   	     $query_gift=$this->db->get_where('gift',array('weddingId' =>$row->id,'valid'=>'0'));
	   	    $selected_gifts=$query_gift->num_rows();
			$query2=$this->db->get_where('gift',array('weddingId' =>$row->id));
		   
           echo ' <div id="selected_wedding" >';  
	       echo '<br/><img src="../'.$row->photo.'" height="130" width="130" id="wedding_photo"><br/>';
	     echo '<h2 id="wedding_title">'.$row->prenumeB." & ".$row->prenumeF.'</h2>';
	  
	     echo "<img src='../../photos/calendar.png' height='18' class='calendar_p'> <div id='s_date'>".$row->day." ".$row->month_name." ".$row->year."</div><div id='s_day'><br/>".$row->week_day.'</div>';
	     echo "<br/><img src='../../photos/location.png' height='20' class='location_p'> <div id='s_location'>".$row->locatia."</div>";
		 echo "<div id='total_gifts'>".$query2->num_rows()." cadouri<br/>";
		 echo  $selected_gifts." alese</div></div>";
	     //afisare cadouri
	     echo "<div id='upperspace'></div>";
	     $query2=$this->db->get_where('gift',array('weddingId' =>$row->id));
	      if ($query2->num_rows() > 0)
  	      {    
		      foreach ($query2->result() as $row2)
	       {     if($row2->valid == 1 && !isset($sGift) )
		        $valid=1;
		      else
		      	$valid=0; 
		       
		       echo "<div class='gift'>";
		         echo '<div class="gift_photo"><img src="../'.$row2->photo.'" height="150" width="150"  />'."</div>";
		     	 ?><div class='select_div'>
		     <?php	/*  if($valid){ 
			      echo "<form action='selectGift' method='post'>";
		       	   echo form_hidden('id',$row2->id);
		           echo form_hidden ('cod',$cod);
		           echo form_hidden ('gift',$row2->title);
		           echo form_hidden('weddingId',$row2->weddingId);
		           echo  "<input type='submit' value='Alege cadou' class='selec' >";
		           echo form_close()."</li>";
	           } */
	             //selectare cadou
	           if($valid){  
		     echo anchor('Home/selectGift/'.$cod."/".$row2->weddingId."/".$row2->id ,"<img src='../../photos/select.png' height='33px'>","class='select'");
	    }  	 echo "  </div> ";
		         echo "<div class='gift_center'><div class='gift_title'>".$row2->title."</div><br/>";
		         echo "<div class='gift_description'>".$row2->description."</div></div>"; 
	    
			    
			     
	          	  if($row2->valid == 1)
		    	$gift_type='unchosen_gift2';
		    else 
		    	$gift_type="chosen_gift2"; 
		    echo "<div class='".$gift_type."'></div>"; 
		    echo " </div>";
	       
	       }
	       }}}
	         else 
		   {
			   echo "<br/>Cod inexistent";
		   }
	       if ($valid_gift == 0){
		       $queryC=$this->db->get_where('gift',array('id'=>$row3->choseen_gift_id));
		       foreach($queryC->result() as $rowC){
			echo "<h3>Ati ales cadoul:".$rowC->title." </h3>";  
			?> <form method="post" action="undo_gift"> <?php
			 echo  form_hidden ('gift',$row3->choseen_gift_id);
			 echo  form_submit('undo','Anuleaza cadoul ales!');
			 echo  form_close(); 
		  }

		   }
		 
       }
       else redirect ('Home','refresh');
	       ?>
	       </div>