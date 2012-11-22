<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	error_reporting(E_ERROR);
	ini_set('display_errors', false);
	# Set PHP's internal character encoding to UTF-8
	mb_internal_encoding('UTF-8');
	
	# Set the character encoding to UTF-8 for all page output
	header('Content-type: text/html; charset=UTF-8'); 

class Song extends CI_Controller {

	
	public function index()
	{
		$this->load->helper('url');
		$data = array(
    		'base_url' => base_url(),
    		'title' => '#nowplaying'
    	);
		$this->load->view('song_view', $data);
	}
	
	public function view()
	{
		$this->load->helper('url');
		$artist = $this->input->post('artist');
		$track = $this->input->post('track');
		$data = array(
    		'title' => '#nowplaying'
    	);
    	$data['songdata'] = $this->_getTrack($artist, $track);
    	$data['url'] = base_url()."#/".$data['songdata']['trackinfo']['artist']."/".$data['songdata']['trackinfo']['title'];
    	$this->load->view('track_view', $data);
	}

	public function form()
	{
		$data = array(
    		'title' => '#nowplaying'
    	);
    	$this->load->view('form_view', $data);
	}
	
	public function search()
	{
		$this->load->helper('url');
		$this->load->model('Lastfm_api');
		$artist = $this->input->post('artist');
		$track = $this->input->post('track');
		$data = $this->Lastfm_api->searchTrack($artist, $track);
		echo json_encode($data);
	}
	
	private function _getTrack($artist, $songTitle) {
		$this->load->model('Spotify_api');
		$this->load->model('Lastfm_api');
		
		$songData = array();
		$songData['trackinfo'] = $this->Lastfm_api->getTrackInfo($artist, $songTitle);
		$artist = $songData['trackinfo']['artist'];
		$songTitle = $songData['trackinfo']['title'];
		$songData['spotifyinfo'] = $this->Spotify_api->getTrack($artist, $songTitle);
		if (!array_key_exists('album', $songData['trackinfo'])){
			$songData['trackinfo']['album'] = $songData['spotifyinfo']['album'];
			$songData['trackinfo']['albumurl'] = null;
		}
		

		$songData['artistinfo'] = $this->Lastfm_api->getArtistInfo($artist);
/*
		echo '<pre>';
		print_r($songData);
		echo '</pre>';
*/
		if (!array_key_exists('image', $songData['trackinfo']) || ($songData['trackinfo']['image'] == null)) {
			$songData['trackinfo']['image']  = $songData['artistinfo']['image']; 
		}
		$songData['title'] = $songData['trackinfo']['title'];
		return $songData;
	}
}