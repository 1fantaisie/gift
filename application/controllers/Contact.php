<?php 
   class Contact extends Application {
	 function index ()
	 {	 $this->load->helper('email');
		 $this->load->library('form_validation');
		 $this->form_validation->set_rules('nume','Name','required');
		 $this->form_validation->set_rules('mesaj','Message','required');
		 if ($this->form_validation->run() == FALSE)
		{
		 $data['ref']='contact.css';
		 $data['title']="Contact";
		 $this->load->view('templates/header',$data);
		 $this->load->view('contact_view');
		 $this->load->view('templates/footer'); 
	 }
		else
		{	 require_once('recaptchalib.php');
  $privatekey = "6Lc2ud8SAAAAAKaGNUig9mAXd32DwqeuI9WvpjLR";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die('Ati introdus gresit cuvintele de verificare.Va rugam incercati din nou.'.anchor('register', 'Reincearca'));
    
    
  } 
			$to='dance_denis@yahoo.com';
		 	$subiect=$this->input->post('nume');
		 	$mesaj=$this->input->post('mesaj');
		 	$headers='From: contact@gift.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		 	if(mail($to, $subiect, $mesaj, $headers))
		 	{
				$this->load->view('templates/header');
				echo "<h2>Mesajul dumneavoastra a fost trimis cu succes!<br/>
				Va multumim!</h2>";
				$this->load->view('templates/footer'); 
			}
			else{
				$this->load->view('templates/header');
				echo "<h3>A aparut o eroare, va rugam reincercati.</h3>";
				$this->load->view('templates/footer'); 
			}
		}
	 }  
   }
