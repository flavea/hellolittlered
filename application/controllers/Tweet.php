<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tweet extends MY_Controller {
    protected $data = array();

	function __construct()
	{
		parent::__construct();
	}

	public function index($offset = 0)
	{

		$consumer= "HE0MLJMYsy5Yt5N499rHdxDcQ";
		$consumer_secret = "z5eLl6ye3k9KXuSvjMKoBecWouGF0z9PpgJx5mgutDyHpXUXOK";
		$access_token = '578015754-7b1DhTEVKIGf2ew8iSM3M7xciWwIzyfHlJ0Qqdaz';
		$access_token_secret = 'm8Ic3hRR4qEeItTyjBSJsyrj1zlhRCe6LGz4HpWb2rmuB';

		$this->load->library('twitteroauth');
		$connection = $this->twitteroauth->create($consumer, $consumer_secret, $access_token, $access_token_secret);
		$content = $connection->get('account/verify_credentials');

		$data = array(
		    'status' => "yay test"
		);

		$result = $connection->post('statuses/update', $data);

	}
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */