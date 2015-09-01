<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
	}

	public function index()
	{
		//echo base_url();
		//echo "Welcome to CodeIgniter. The default Controller is Main.php";
		$this->load->view("home");
	}

	public function js_ball()
	{
		$this->load->view("js_ball");
	}

	public function frogger() {
		$this->load->view("frogger");
	}

	public function modernize() {
		$this->load->view("modernize");
	}

	public function mail()
	{
		//var_dump($this->input->post());
		// Check for empty fields
		if(empty($_POST['name'])  		||
		   empty($_POST['email']) 		||
		   empty($_POST['phone']) 		||
		   empty($_POST['message'])	||
		   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
		   {
			echo "No arguments Provided!";
			return false;
		   }

		$name 			= $this->input->post('name');
		$email_address 	= $this->input->post('email');
		$phone 			= $this->input->post('phone');
		$message 		= $this->input->post('message');

		$email_subject = "Website Contact Form:  $name";
		$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";			

		$this->load->library('email');
		$this->email->from('thegifgallery@gmail.com', $name);
		$this->email->to('paulchino@gmail.com');
		$this->email->subject($email_subject);
		$this->email->message($email_body);

		if ($this->email->send() )
		{
			return true;
		}
		else 
		{
			return false;
		}

		// $name = $_POST['name'];
		//$email_address = $_POST['email'];
		//$phone = $_POST['phone'];
		//$message = $_POST['message'];



		// Create the email and send the message
		// $to = 'pc.chang@rocketmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
		// $email_subject = "Website Contact Form:  $name";
		// $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
		// $headers = "From: paulchang04@gmail.com\n" . // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		// 			"Reply-To: $email_address";	
		// $test = mail($to,$email_subject,$email_body,$headers);
		// return $test;		
	}
}

//end of main controller