<?php
	
class Lastfm_api extends CI_Model{

	static $apiKey = "6ed42890522918c59b5459a65ece5818";
	static $apiSecret = "478d83cd5d9e35df391a933e5eff93dd";
	static $baseURI = "http://ws.audioscrobbler.com/2.0/?format=json&api_key=6ed42890522918c59b5459a65ece5818";
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	
	private function _makeCall($string) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 0);
		curl_setopt($curl, CURLOPT_URL, $string);
		$content = json_decode(curl_exec($curl), true);
		curl_close ($curl);
		return $content;
	}
	

	function getArtistInfo($string){
		$content = $this->_makeCall(Lastfm_api::$baseURI."&limit=1&method=artist.getinfo&artist=".urlencode($string));
/*
		echo '<pre>';
		print_r($content);
		echo '</pre>';
*/
		$data = array();
		$data['bio'] = $content['artist']['bio'];
		$data['name'] = $content['artist']['name'];
		$data['image'] = $content['artist']['image'][3]['#text'];
		$data['url'] = $content['artist']['url'];
		$data['similar'] = array();
		for ($i = 0; $i < 3; $i++) {
			$data['similar'][] = array('name' => $content['artist']['similar']['artist'][$i]['name'], 'url' => $content['artist']['similar']['artist'][$i]['url']);	
		}
		if (is_array($content['artist']['tags']) && array_key_exists('tag', $content['artist']['tags'])){
			$data['tags'] = array();
			for ($i = 0; $i < 3; $i++) {
				$data['tags'][] = array('name' => $content['artist']['tags']['tag'][$i]['name'], 'url' => $content['artist']['tags']['tag'][$i]['url']);
			}
		}
		
		return $data;
	}

	function getAlbumInfo($artistString, $albumString){
		$content = $this->_makeCall(Lastfm_api::$baseURI."&method=album.getinfo&limit=1&artist=".urlencode($artistString)."&album=".urlencode($albumString));
/*
		echo '<pre>';
		print_r($content);
		echo '</pre>';
*/
		$data = array();
		$data['name'] = $content['album']['name'];
		$data['artist'] = $content['album']['artist'];
		$data['image'] = $content['album']['image'][3]['#text'];
		$data['url'] = $content['album']['url'];
		return $data;
	}
	
	function searchTrack($artistString, $trackString){
		$content = $this->_makeCall(Lastfm_api::$baseURI."&method=track.search&limit=1&&track=".urlencode($artistString." ".$trackString));
		$content = $content['results']['trackmatches']['track'];
		$data = array();
		$data['artist'] = $content['artist'];
		$data['title'] = $content['name'];
		return $data;
	}
	function getTrackInfo($artistString, $trackString){
		$content = $this->_makeCall(Lastfm_api::$baseURI."&method=track.getinfo&limit=1&artist=".urlencode($artistString)."&track=".urlencode($trackString));
/*

		echo '<pre>';
		print_r($artistString);
		print_r($trackString);
		echo '</pre>';

*/
		$data = array();
		$data['title'] = $content['track']['name'];
		$data['artist'] = $content['track']['artist']['name'];
		if (array_key_exists('album', $content['track'])){
			$data['album'] = $content['track']['album']['title'];
			$data['albumurl'] = $content['track']['album']['url'];
			$data['image'] = $content['track']['album']['image'][3]['#text'];
		}
		$data['url'] = $content['track']['url'];
		$seconds = $content['track']['duration']/(1000);
		$data['duration'] = array(
			'mins' => floor($seconds/60),
			'secs' => $seconds%60
		);
		return $data;
	}
	

}

?>