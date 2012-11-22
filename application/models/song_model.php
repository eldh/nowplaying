<?php

class Song_model extends CI_Model {


	function __construct()
	{
		parent::__construct();
	}

	function getSong($artist, $songTitle) {
		$this->load->model('Spotify_api');
		$this->load->model('Lastfm_api');
		
		$songData = array();
		$songData['artist'] = $this->Spotify_api->getArtist($artist);
		$songData['title'] = $songTitle;
		$songData['artistinfo'] = $this->Lastfm_api->getArtistInfo($artist);
		$songData['trackinfo'] = $this->Lastfm_api->getTrackInfo($artist, $songTitle);
		$songData['albuminfo'] = $this->Lastfm_api->getAlbumInfo($artist, $songTitle);
		return $songData;
	}
	


}
?>