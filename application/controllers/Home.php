<?php   // Controller of the main page 
   class Home extends Application {
    public $cod;
	   function index(){
	    $data['title']="Acasa";
	    $data['ref']='home.css';
		$this->load->view('templates/header',$data);
		$this->load->view('home_view');
		$this->load->view('templates/footer');
		
	}
	function login(){
	 $this->ag_auth->login();	
	}  
	function cookie(){
	 ?> <script type="text/javascript" src="../../evercookie-0.4/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="../../evercookie-0.4/swfobject-2.2.min.js"></script>
    <script type="text/javascript" src="../../evercookie-0.4/evercookie.js"></script>
<script type="text/javascript"> var c=new evercookie();
		 
    c.get('id',function(value){ 
        })
     
		   </script> <?php
		   $this->cod($this->input->post('cod'));
		 //  redirect('Home/cod','refresh');	
	}
	function cod()
	{        $cod=$this->input->post('cod');
			 $data1['ref']='organizator.css';
		     $data['cod']=$cod;
		 	 $this->load->view('templates/header',$data1);
	    	 $this->load->view('select_gift_view',$data);
	    	 $this->load->view('templates/footer');

	    	 	  	   
	 	
	}
	function selectGift($cod, $weddingId,$giftId)
	{
	
		if(!isset($_COOKIE['sg'])){
			$this->load->model('generate_model');
			$val=$this->generate_model->random();
			setcookie('sg',$val, time()+3600*24*30*12*3,"/", "" );
			$_COOKIE['sg'] = $val;
		}
		$this->load->model('select_gift_model');
		$data['cod']=$cod;
		$data['giftId']=$giftId;
		$data['weddingId']=$weddingId;
		$this->select_gift_model->select($cod,$giftId,$weddingId);
		$this->load->view('templates/header');
	/*	$this->load->view('templates/menu');	
		$this->load->view('gift_succes_view',$data);
		$this->load->view('templates/footer'); */
		redirect('Home','refresh');
	
	
}	
    function undo_gift()
    {
	    $this->load->model('select_gift_model');
	    $this->select_gift_model->undo();
	    redirect ('Home','refresh');
    }	
    function logout()
    { $this->ag_auth->logout();}
}

    ?>