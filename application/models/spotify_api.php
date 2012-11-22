<?php

class Spotify_api extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	static $baseURI = "http://ws.spotify.com/search/1/";
	
	private function _makeCall($string) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 0);
		curl_setopt($curl, CURLOPT_URL, $string);
		$content = json_decode(curl_exec($curl), true);
		curl_close ($curl);
		return $content;
	}
	
	function getArtist($string){
		$content = 	$this->_makeCall(Spotify_api::$baseURI."artist.json?q=".urlencode($string));
		$artistData = array();
		$artistData['url'] = $content['artists'][0]['href'];
		$artistData['name'] = $content['artists'][0]['name'];
		return $artistData;
	}

	function getTrack($artist, $songName){
		$content = 	$this->_makeCall(Spotify_api::$baseURI."track.json?q=".urlencode($artist.' '.$songName));
/*
		echo '<pre>';
		print_r($content);
		echo '</pre>';
*/
		try{
			$data = array();
			$data['url'] = $content['tracks'][0]['href']; 
			$data['album'] = $content['tracks'][0]['album']['name'];
		}
		catch (Exception $e){
			$data['url'] = null;
			$data['album'] = null;
		}
		return $data;
	}
	


}

?>