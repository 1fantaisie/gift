 <?php 
  class Generate_model extends CI_Model {
   
 	function random() //genereaza un cod random
	{ 
 			$pw = ''; //intialize to be blank 
 			for($i=0;$i<10;$i++) 
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
	function generate()// genereaza un cod random si il introduce in tabelul cod
	{   $nr=$this->input->post('nr');// numarul de coduri generate
	    $id=$this->input->post('id');//id nunta		 
		for($i=0;$i<$nr;$i++)
    	{ 	$n=$this->random();
      		$query=$this->db->get('cod');
      		foreach($query->result() as $row)
      		{
	      		if($row->cod == $n)
	      		{
		      		$i=$i-1;
		      		continue;
	      		}
      		}
      		$this->db->insert('cod',array('cod'=>$n,'weddingId'=>$id));
	    	 	  
  		}
  }
}