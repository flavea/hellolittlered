<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class social_model extends CI_Model {
    
    function post_tweet($message) {
        $consumer            = "HE0MLJMYsy5Yt5N499rHdxDcQ";
        $consumer_secret     = "z5eLl6ye3k9KXuSvjMKoBecWouGF0z9PpgJx5mgutDyHpXUXOK";
        $access_token        = '578015754-7b1DhTEVKIGf2ew8iSM3M7xciWwIzyfHlJ0Qqdaz';
        $access_token_secret = 'm8Ic3hRR4qEeItTyjBSJsyrj1zlhRCe6LGz4HpWb2rmuB';
        
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
        $api_key = '5b1c8692421ef44b7247bb7d97ab96f8';
        
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
        $token = '744320566.d3275fc.7aac8b9f84f24415a47a313d79b565b1';
        
        $perPage = 9;
        $url     = 'https://api.instagram.com/v1/users/self/media/recent/';
        $url .= '?access_token=' . $token;
        $url .= '&count=' . $perPage;
        
        $response = json_decode(file_get_contents($url), true);
        
        return $response;
    }
    
    function get_latest_lastfm() {
        $api    = 'a25573a1905bb755bbe3e4d2d1894d7c';
        $secret = '293355ec39bfce6244b657d02c47f71a';
        
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
        $url     = 'https://www.goodreads.com/review/list/3593336?format=xml&key=yRYcVx1lTLk6aU5s1gTqqQ&v=2&shelf=read&per_page=1';
        $xml     = file_get_contents($url, false, $context);
        $xml     = simplexml_load_string($xml);
        $xml     = (array) $xml->reviews->review->book;
        $text    = $xml['title'] . ' by ' . $xml['authors']->author->name;
        
        return $text;
    }
    
    function get_tumblr_posts($perPage = 3, $username = "gyuseu", $tag = false) {
        $api_key = 'fak3IzisOoJlGleXVohBwKYpgWBEt7jMZJ7qr6kePzzwh1NQYy';
        
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