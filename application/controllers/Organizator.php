<?php 
  class Organizator extends Application {
function __construct()
{
    parent::__construct();
    if ( ! $this->session->userdata('logged_in'))
    { 
        // Allow some methods?
        $allowed = array(
            'some_method_in_this_controller',
            'other_method_in_this_controller',
        );
        if ( ! in_array($this->router->method, $allowed))
        {
           redirect('../../../../ci/index.php/Home', 'refresh'); 
        }
    }
}
	  function index($edit= false)
	  {//afisarea paginii Organizator	
		 	$data['edit']=$edit;
		 	$data['ref']='organizator.css';
		 	$data['title']="Organizator";
		 	$this->load->view('templates/header',$data);
		 	$this->load->view('organizator_view');
		 	 $this->load->view('templates/footer');
  	  } 
  function wedding($wId){
	  //selecteaza nunta aleasa(in cazul in care user-ul are mai mult de o nunta)	  
	$this->session->set_userdata(array('currentW'=>$wId));  
	redirect ('Organizator','refresh');  
  }	
    function reset()
    // inpoi la lista cu nunti(in cazul in care user-ul are mai mult de o nunta)
    {
	    $this->session->unset_userdata('currentW');
	    redirect('Organizator','refresh');
    }
    function view_add()//deschide pagina de unde se adauga nunti
    {	
	    $data['ref']='add.css';
    	$data['add']='add';
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('prenumeB','Groom surname','required');
		$this->form_validation->set_rules('prenumeF','Bride surname','required');
		$this->form_validation->set_rules('data','Date','required');
		$this->form_validation->set_rules('loc','Location','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header',$data);
	    $this->load->view('add_wedding_view');
	    $this->load->view('templates/footer');
		}
		else 
		{
			$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload() && ($this->input->post('userfile') != ""))
		{
			
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('templates/header',$data);
			$this->load->view('error_view', $error);
			$this->load->view('templates/footer');
		}
		elseif ($this->input->post('userfile') != "")
		{   
			
			$data = array('upload_data' => $this->upload->data());
			$path=$this->upload->data();	
           	$this->load->model('add_model');
		    $this->add_model->add();
			$this->load->view('templates/header');
		    $this->load->view('upload_succes_view', $data);
		    $this->load->view('templates/footer');
		}
		else
		{
			$this->load->model('add_model');
		    $this->add_model->add();
			redirect ('Organizator/reset','refresh');
		}
		
	 	     }		   
		}
	    
	function view_gift()
	{   $data['wId']=$this->session->userdata('currentW');   
		echo "XXXXXXXXXXXXX".var_dump($this->session->all_userdata());
		$data['ref']='gift.css';
		$this->form_validation->set_rules('title','title','required');
		if ($this->form_validation->run() == FALSE)
		{	
			$this->load->view('templates/header',$data);
		$this->load->view('view_gift_view',$data);
		$this->load->view('templates/footer');	
		}
		else{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload() && ($this->input->post('userfile') != ""))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('templates/header');
			$this->load->view('error_view', $error);
			$this->load->view('templates/footer');
		}
		elseif ($this->input->post('userfile') != "")
		{   
			$data = array('upload_data' => $this->upload->data());
			$path=$this->upload->data();
           	$this->load->model('gift_model');
		    $this->gift_model->index();
			$this->load->view('templates/header');
		    $this->load->view('upload_succes_view', $data);
		    $this->load->view('templates/footer');
		}
		else
		{
			$this->load->model('gift_model');
		    $this->gift_model->index();
			redirect ('Organizator','refresh');
		}
		
	}
		
	}
	function view_edit($gift_id)
	{
		$continue=0;
		$query=$this->db->get_where('weddings',array('userId' => $this->session->userdata('id')));	   
		foreach($query->result() as $row)
		{
			$query2=$this->db->get_where('gift',array('weddingId' => $row->id));
			foreach($query2->result() as $row2)
			{
				if($row2->id == $gift_id)	
				   $continue=1;
				
			}	   	
			
		}
		if( $continue== 1){
		$data['gId']=$gift_id;
		$data['ref']='gift.css';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title','title','required');
		if ($this->form_validation->run() == FALSE)
		{	
			$this->load->view('templates/header',$data);
			$this->load->view('edit_gift_view',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload() && ($this->input->post('userfile') != ""))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('templates/header');
			$this->load->view('error_view', $error);
			$this->load->view('templates/footer');
		}
		elseif ($this->input->post('userfile') != "")
		{   
			$data = array('upload_data' => $this->upload->data());
			$path=$this->upload->data();
           	$this->load->model('gift_model');
	        $this->gift_model->edit();
			$this->load->view('templates/header');
		    $this->load->view('upload_succes_view', $data);
		    $this->load->view('templates/footer');
		}
		else
		{
			$this->load->model('gift_model');
	        $this->gift_model->edit();
	       redirect ('Organizator','refresh');
	} 
	}	
		}
		else 
		{
			redirect('../../../../ci/index.php/Organizator', 'refresh'); 
			
		}
		
	}
/*	function gift(){//adaugare cadouri
	
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload() && ($this->input->post('userfile') != ""))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('templates/header');
			$this->load->view('error_view', $error);
			$this->load->view('templates/footer');
		}
		elseif ($this->input->post('userfile') != "")
		{   
			$data = array('upload_data' => $this->upload->data());
			$path=$this->upload->data();
           	$this->load->model('gift_model');
		    $this->gift_model->index();
			$this->load->view('templates/header');
		    $this->load->view('upload_succes_view', $data);
		    $this->load->view('templates/footer');
		}
		else
		{
			$this->load->model('gift_model');
		    $this->gift_model->index();
			redirect ('Organizator','refresh');
		}
		
	} 	*/
	function deleteGift($id){// stergere cadouri	
	$continue=0;
		$query=$this->db->get_where('weddings',array('userId' => $this->session->userdata('id')));	   
		foreach($query->result() as $row)
		{
			$query2=$this->db->get_where('gift',array('weddingId' => $row->id));
			foreach($query2->result() as $row2)
			{
				if($row2->id == $id)	
				   $continue=1;
				
			}	   	
			
		}
		if( $continue== 1){
	
	
	$query2=$this->db->get_where('gift',array('id'=>$id));
				foreach($query2->result() as $row2){
					if($row2->photo != '../uploads/default_gift.jpg'){
					$u_gift=str_replace('../','',$row2->photo);
					unlink($u_gift);
				}}
	$this->db->delete('gift',array('id'=>$id));
	redirect ('Organizator','refresh');
	}
	else 
		{
			redirect('../../../../ci/index.php/Organizator', 'refresh'); 
			
		}
	}
	 
/*	function editGift ()
	{	$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload() && ($this->input->post('userfile') != ""))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('templates/header');
			$this->load->view('error_view', $error);
			$this->load->view('templates/footer');
		}
		elseif ($this->input->post('userfile') != "")
		{   
			$data = array('upload_data' => $this->upload->data());
			$path=$this->upload->data();
           	$this->load->model('gift_model');
	        $this->gift_model->edit();
			$this->load->view('templates/header');
		    $this->load->view('upload_succes_view', $data);
		    $this->load->view('templates/footer');
		}
		else
		{
			$this->load->model('gift_model');
	        $this->gift_model->edit();
	       redirect ('Organizator','refresh');
	} 
	   } */
	function generate(){
		// generareaza coduri unice si le introduce in baza de date 
	  $this->load->model('generate_model');
	  $this->generate_model->generate();	
	  redirect ('Organizator','refresh');
	}

	function view_edit_wedding()//afisare editare nunta
	{	$data['add']='add';
		$data['ref']='add.css';
		$data['wId']=$this->input->post('wId');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('prenumeB','Groom surname','required');
		$this->form_validation->set_rules('prenumeF','Bride surname','required');
		$this->form_validation->set_rules('data','Date','required');
		$this->form_validation->set_rules('loc','Location','required');
		
		if ($this->form_validation->run() == FALSE)
		{
		$this->load->view('templates/header',$data);
		$this->load->view('edit_wedding_view',$data);
		$this->load->view('templates/footer');
		}
		else
		{
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
			$config['max_size']	= '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload() && ($this->input->post('userfile') != ""))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('templates/header');
				$this->load->view('error_view', $error);
				$this->load->view('templates/footer');
			}
			else
			{   
				$data = array('upload_data' => $this->upload->data());
				$path=$this->upload->data();
          	 	$this->load->model('edit_wedding_model');
		   	 $this->edit_wedding_model->update();
	       	 redirect ('Organizator','refresh');
			}			
		}
	}
	function edit_wedding()
	{	$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload() && ($this->input->post('userfile') != ""))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('templates/header');
			$this->load->view('error_view', $error);
			$this->load->view('templates/footer');
		}
		else
		{   
			$data = array('upload_data' => $this->upload->data());
			$path=$this->upload->data();
           	$this->load->model('edit_wedding_model');
		    $this->edit_wedding_model->update();
	        redirect ('Organizator','refresh');
		}		
	}
	function delete_wedding($wId)
	{
		$continue=0;
		$query=$this->db->get_where('weddings',array('userId' => $this->session->userdata('id')));	   
		foreach($query->result() as $row)
		{
				if($row->id == $wId)	
				   $continue=1;	
		}
		if( $continue== 1){
		
			$query=$this->db->get_where('weddings',array('id'=> $wId));
			foreach($query->result() as $row)
			{   if($row->photo != '../uploads/default.jpg'){
				$u_file=str_replace('../','',$row->photo);
				unlink($u_file);	
			}
				$query2=$this->db->get_where('gift',array('weddingId'=>$wId));
				foreach($query2->result() as $row2){
					if($row2->photo != '../uploads/default_gift.jpg'){
					$u_gift=str_replace('../','',$row2->photo);
					unlink($u_gift);
				}
			}
				$this->db->delete('gift',array('weddingId'=> $wId));
			}
			$this->db->delete('weddings',array('id'=> $wId));
			$this->session->unset_userdata('currentW');
			
			redirect('Organizator','refresh');
}
          else 
          {
	         redirect('Organizator','refresh'); 
          }	
	}


	  }
