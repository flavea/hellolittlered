<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class social_model extends CI_Model {

	function post_tweet($message)
	{
		$consumer= "CONSUMER";
		$consumer_secret = "CONSUMER_SECRET";
		$access_token = 'ACCESS_TOKE';
		$access_token_secret = 'ACCESS_TOKEN_SECRET';

		$this->load->library('twitteroauth');
		$connection = $this->twitteroauth->create($consumer, $consumer_secret, $access_token, $access_token_secret);
		$content = $connection->get('account/verify_credentials');

		$data = array(
		    'status' => $message
		);

		$result = $connection->post('statuses/update', $data);
	}

	function get_latest_flickr() {
		$api_key = 'API';

		$user = '113411780@N03';
		$perPage = 9;
		$url = 'https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos';
		$url.= '&api_key='.$api_key;
		$url.= '&user_id='.$user;
		$url.= '&per_page='.$perPage;
		$url.= '&format=json';
		$url.= '&nojsoncallback=1';

		$response = json_decode(file_get_contents($url));

		return $response->photos->photo;
	}

	function get_latest_instagram() {
		$token = 'TOKEN';
 
		$perPage = 9;
		$url = 'https://api.instagram.com/v1/users/self/media/recent/';
		$url.= '?access_token='.$token;
		$url.= '&count='.$perPage;

		$response = json_decode(file_get_contents($url), true);

		return $response;
	}

	function get_tumblr_posts($perPage = 3, $username = "gyuseu", $tag = false) {
		$api_key = 'API';

		$url = 'http://api.tumblr.com/v2/blog/'.$username.'.tumblr.com/posts';
		$url.= '?api_key='.$api_key;
		$url.= '&limit='.$perPage;
		if($tag != false) {
			$url.= '&tag='.$tag;
		}

		$response = json_decode(file_get_contents($url));

		$result = $response->response->posts;

		return $result;
	}


}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */