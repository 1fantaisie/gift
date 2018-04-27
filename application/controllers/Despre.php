 <?php 
   class Despre extends Application {
	 function index ()
	 {   $data['title']="Despre noi";
		 $this->load->view('templates/header',$data);
		 $this->load->view('despre_view');
		 $this->load->view('templates/footer');
		 
	 }   
	   
   }
    