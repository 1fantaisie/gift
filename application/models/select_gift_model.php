<?php 
    class Select_gift_model extends CI_Model {
	    function select($cod,$giftId,$weddingId){
		
		//$cod=$this->input->post('cod');
	 	//$giftId=$this->input->post('id');
	 	//$gift=$this->input->post('gift');
	 	$query=$this->db->get_where('cod',array('cod'=>$cod));
	 	$this->db->update('gift',array('valid'=> '0'),array('id'=> $giftId));
	 	$v['weddingId']=$weddingId;
	 	$v['choseen_gift_id']=$giftId;
	 	$v["uid"]=$_COOKIE['sg'];
	 	$v['cod']=$cod;
	 	$this->db->insert('id',$v);
//$val=$weddingId."-".$giftId;
//setcookie('sg',$val, time()+3600*24*30*12*3,"/", "" );

	//return $gift;
  }
  function undo()
  {
	  $gift=$this->input->post('gift');
	  $this->db->delete('id',array('choseen_gift_id'=>$gift));
	  $this->db->update('gift',array('valid'=>'1'),array('id'=>$gift));
  }	




    function random() //genereaza un cod random
	{ 
 			$pw = ''; //intialize to be blank 
 			for($i=0;$i<12;$i++) 
 			{ 
   				switch(rand(1,3)) 
   					{ 
     					case 1: $pw.=chr(rand(48,57));  break; //0-9 
     					case 2: $pw.=chr(rand(65,90));  break; //A-Z 
     					case 3: $pw.=chr(rand(97,122)); break; //a-z 
   					} 
 			} 
 			return $pw; 
 	} 
	function generate()// genereaza un cod random unic
	{   $nr=1;   // numarul de coduri generate
	    
		for($i=0;$i<$nr;$i++)
    	{ 	$n=$this->random();
      		$query=$this->db->get('weddings');
      		foreach($query->result() as $row)
      		{
	      		if($row->cod == $n)
	      		{
		      		$i=$i-1;
		      		continue;
	      		}
      		}
      		return $n;
	    	 	  
  		}
  }
}