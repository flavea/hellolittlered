<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class social_model extends CI_Model {
    
    function post_tweet($message) {
        $consumer            = "";
        $consumer_secret     = "";
        $access_token        = '';
        $access_token_secret = '';
        
        $this->load->library('twitteroauth');
        $connection = $this->twitteroauth->create($consumer, $consumer_secret, $access_token, $access_token_secret);
        $content    = $connection->get('account/verify_credentials');
        
        if (strlen($message) > 140)
            $message = substr($message, 0, 140);
        
        $data = array(
            'status' => $message
        );
        
        $result = $connection->post('statuses/update', $data);
    }
    
    function get_latest_flickr() {
        $api_key = '';
        
        $user    = '113411780@N03';
        $perPage = 9;
        $url     = 'https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos';
        $url .= '&api_key=' . $api_key;
        $url .= '&user_id=' . $user;
        $url .= '&per_page=' . $perPage;
        $url .= '&format=json';
        $url .= '&nojsoncallback=1';
        
        $response = json_decode(file_get_contents($url));
        
        return $response->photos->photo;
    }
    
    function get_latest_instagram() {
        $token = '';
        
        $perPage = 9;
        $url     = 'https://api.instagram.com/v1/users/self/media/recent/';
        $url .= '?access_token=' . $token;
        $url .= '&count=' . $perPage;
        
        $response = json_decode(file_get_contents($url), true);
        
        return $response;
    }
    
    function get_latest_lastfm() {
        $api    = '';
        $secret = '';
        
        $perPage = 1;
        $url     = 'http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=iBear2&format=json';
        $url .= '&api_key=' . $api;
        $url .= '&limit=' . $perPage;
        $response = json_decode(file_get_contents($url));
        $array    = (array) $response->recenttracks->track[0]->artist;
        $text     = $array['#text'] . ' - ' . $response->recenttracks->track[0]->name;
        
        return $text;
    }
    
    function get_latest_read() {
        $context = stream_context_create(array(
            'http' => array(
                'header' => 'Accept: application/xml'
            )
        ));
        $url     = '';
        $xml     = file_get_contents($url, false, $context);
        $xml     = simplexml_load_string($xml);
        $xml     = (array) $xml->reviews->review->book;
        $text    = $xml['title'] . ' by ' . $xml['authors']->author->name;
        
        return $text;
    }
    
    function get_tumblr_posts($perPage = 3, $username = "gyuseu", $tag = false) {
        $api_key = '';
        
        $url = 'http://api.tumblr.com/v2/blog/' . $username . '.tumblr.com/posts';
        $url .= '?api_key=' . $api_key;
        $url .= '&limit=' . $perPage;
        if ($tag != false) {
            $url .= '&tag=' . $tag;
        }
        
        $response = json_decode(file_get_contents($url));
        
        $result = $response->response->posts;
        
        return $result;
    }
    
    
}