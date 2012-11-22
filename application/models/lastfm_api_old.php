<?php
	require 'lastfmapi/Util.php';
	require 'lastfmapi/caller/Caller.php';
	require 'lastfmapi/caller/CallerFactory.php';
	require 'lastfmapi/cache/CachePolicy.php';
	require 'lastfmapi/cache/DefaultCachePolicy.php';
	require 'lastfmapi/cache/Cache.php';
	require 'lastfmapi/cache/DiskCache.php';
	require 'lastfmapi/caller/CurlCaller.php';
	require 'lastfmapi/Media.php';
	require 'lastfmapi/Tag.php';
	require 'lastfmapi/Artist.php';
	require 'lastfmapi/Album.php';
	require 'lastfmapi/Track.php';
	require 'lastfmapi/Error.php';
	
class Lastfm_api extends CI_Model{

	static $apiKey = "6ed42890522918c59b5459a65ece5818";
	static $apiSecret = "478d83cd5d9e35df391a933e5eff93dd";
		
	function __construct()
	{
		$caller = CallerFactory::getCurlCaller();
		$caller->setApiKey(Lastfm_api::$apiKey);
		$caller->setApiSecret(Lastfm_api::$apiSecret);		
		parent::__construct();
	}

	function getArtistInfo($string){
		$artist = Artist::getInfo($string);
		$artistData = array();
		$artistData['bio'] = $artist->getBiography();
		$artistData['name'] = $artist->getName();
		$artistData['image'] = $artist->getImage(Media::IMAGE_EXTRALARGE);
		$artistData['url'] = $artist->getUrl();
		$similar = $artist->getSimilar($artistData['name'], 3);
		$tags = $artist->getTopTags($artistData['name']);
		$i = 0;
		foreach ($tags as $a) {
			$artistData['tags'][$i]['name'] = $a->getName();
			$artistData['tags'][$i]['url'] = 'http://'.$a->getUrl();
			$i++;
		}
		
		$i = 0;
		foreach ($similar as $a) {
			$artistData['similar'][$i]['name'] = $a->getName();
			$artistData['similar'][$i]['url'] = 'http://'.$a->getUrl();
			$i++;
		}
		return $artistData;
	}

	function getAlbumInfo($artistString, $albumString){
		$album = Album::getInfo($artistString, $albumString);
		$trackData = array();
		$trackData['bio'] = $album->getName();
		$trackData['image'] = $album->getImage(Media::IMAGE_EXTRALARGE);
		$trackData['url'] = $album->getUrl();
		echo '<pre>';
		print_r($album);
		echo '</pre>';
		return $trackData;
	}
	
	function getTrackInfo($artistString, $trackString){
		$track = Track::getInfo($artistString, $trackString);
		$trackData = array();
		$trackData['album'] = $track->getAlbum();
		$trackData['image'] = $track->getImage(Media::IMAGE_EXTRALARGE);
		$trackData['url'] = $track->getUrl();
		$trackData['title'] = $track->getName();
		$trackData['duration'] = $track->getDuration();
		echo '<pre>';
		print_r($track);
		echo '</pre>';
		return $trackData;
	}
	

}

?>