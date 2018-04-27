
    <?php header("Content-type: text/css; charset: UTF-8"); ?>  
    <?php  
$primaryTextColor = '#000';  
$secondaryTextColor = '#fff';  
$tertiaryTextColor = '#555';  
$primaryBGColor = '#fff';  
$secondaryBGColor = '#ccc';  
$tertiaryBGColor = '#000';  
$primaryTextSize = '100'; //pixels  
?>  
body {  
 color: <?=$primaryTextColor?>;  
 background: <?=$primaryBGColor?>;  
 font-size: <?=$primaryTextSize?>px;  
}  
 .wedding_body{
         background-color:blue;

     }
     body{
     background-color:red;
   }
  <!-- 
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
} 
    header("Content-type: text/css; charset: UTF-8");
       $query=$this->db->get_where('weddings',array('userId' => $this->session->userdata('id')));
      foreach ($query->result() as $row){
        $prgb=rgb($row->pcolor);
        $srgb=rgb($row->scolor);
     ?>

     <?php      
      }
        
?> -->