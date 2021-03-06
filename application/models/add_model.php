<?php  
   class Add_model extends CI_Model{
	var $id;
	 

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
	   function add(){
	 $get_day=array(
	'Sunday' => 'duminica',
	'Monday' => 'luni',
	'Tuesday' => 'marti',
	'Wednesday'=>'miercuri',
	'Thursday'=>'joi',
	'Friday'=>'vineri',
	'Saturday' => 'sambata',
	);	   
	$get_month=array('decembrie','ianuarie','februarie','martie','aprilie','mai','iunie','iulie','august','septembrie','octombrie','noiembrie','decembrie');
	$v['userId']=id(); 
	//$v['numeB']=$this->input->post('numeB');
	$v['prenumeB']=$this->input->post('prenumeB');
//	$v['numeF']=$this->input->post('numeF');
	$v['prenumeF']=$this->input->post('prenumeF');	
	$date=$this->input->post('data');
	$v['date']=$date;
	$week_day=strftime("%A",strtotime($date));
	$v['week_day']=$get_day[$week_day];
	$date=explode('/',$date);	
	$v['day']=$date['1'];
	$v['month']=$date['0'];
	$v['year']=$date['2'];
	$month=$date['0'];
	$month=intval($month); 
	$v['month_name']=$get_month[$month];
	$v['locatia']=$this->input->post('loc');
	$v['cod']=$this->generate();
	$v['pcolor']=$this->input->post('pcolor');
	$v['scolor']=$this->input->post('scolor');
	 $path=$this->upload->data();
	  $finalpath="../uploads/".$path['file_name'];   
	    if ($path['file_name'] != "" && $path['file_name']!= null)
	    {
	    	$v['photo']=$finalpath;
	    	//square image create
if(!function_exists("create_square_image")){
	function create_square_image($original_file, $destination_file=NULL, $square_size = 96){
		
		if(isset($destination_file) and $destination_file!=NULL){
			if(!is_writable($destination_file)){
				echo '<p style="color:#FF0000">Oops, the destination path is not writable. Make that file or its parent folder wirtable.</p>'; 
			}
		}
		
		// get width and height of original image
		$imagedata = getimagesize($original_file);
		$original_width = $imagedata[0];	
		$original_height = $imagedata[1];
		
		if($original_width > $original_height){
			$new_height = $square_size;
			$new_width = $new_height*($original_width/$original_height);
		}
		if($original_height > $original_width){
			$new_width = $square_size;
			$new_height = $new_width*($original_height/$original_width);
		}
		if($original_height == $original_width){
			$new_width = $square_size;
			$new_height = $square_size;
		}
		
		$new_width = round($new_width);
		$new_height = round($new_height);
		
		// load the image
		if(substr_count(strtolower($original_file), ".jpg") or substr_count(strtolower($original_file), ".jpeg")){
			$original_image = imagecreatefromjpeg($original_file);
		}
		if(substr_count(strtolower($original_file), ".gif")){
			$original_image = imagecreatefromgif($original_file);
		}
		if(substr_count(strtolower($original_file), ".png")){
			$original_image = imagecreatefrompng($original_file);
		}
		
		$smaller_image = imagecreatetruecolor($new_width, $new_height);
		$square_image = imagecreatetruecolor($square_size, $square_size);
		
		imagecopyresampled($smaller_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
		
		if($new_width>$new_height){
			$difference = $new_width-$new_height;
			$half_difference =  round($difference/2);
			imagecopyresampled($square_image, $smaller_image, 0-$half_difference+1, 0, 0, 0, $square_size+$difference, $square_size, $new_width, $new_height);
		}
		if($new_height>$new_width){
			$difference = $new_height-$new_width;
			$half_difference =  round($difference/2);
			imagecopyresampled($square_image, $smaller_image, 0, 0-$half_difference+1, 0, 0, $square_size, $square_size+$difference, $new_width, $new_height);
		}
		if($new_height == $new_width){
			imagecopyresampled($square_image, $smaller_image, 0, 0, 0, 0, $square_size, $square_size, $new_width, $new_height);
		}
		

		// if no destination file was given then display a png		
		if(!$destination_file){
			imagepng($square_image,NULL,9);
		}
		
		// save the smaller image FILE if destination file given
		if(substr_count(strtolower($destination_file), ".jpg")){
			imagejpeg($square_image,$destination_file,100);
		}
		if(substr_count(strtolower($destination_file), ".gif")){
			imagegif($square_image,$destination_file);
		}
		if(substr_count(strtolower($destination_file), ".png")){
			imagepng($square_image,$destination_file,9);
		}

		imagedestroy($original_image);
		imagedestroy($smaller_image);
		imagedestroy($square_image);

	}
}

// in your php pages create images with a code like this:
// create_square_image("sample.jpg","sample_thumb.jpg",200);
// first parameter is the name of the image file to resize
// second parameter is the path where you would like to save the new square thumb, e.g. "sample_thumb.jpg" or just "NULL" if you do not want to save new image. If NULL then this file should be used as the "src" of the image. Folder whre you save image has to be writable, "777" permission code on most servers.
// 200 is the size of the new square thumb

create_square_image('uploads/'.$path['file_name'],'uploads/'.$path['file_name'],240);
    	}
    	else 
    	{
	    	$v['photo']="../uploads/default.jpg";
    	}
	$this->db->insert('weddings',$v);   


	
   }
	   
   } 
?>