<?php

	error_reporting(E_ALL);
	ini_set('display_errors', true);

	require 'src/Util.php';
	require 'src/caller/Caller.php';
	require 'src/caller/CallerFactory.php';
	require 'src/cache/CachePolicy.php';
	require 'src/cache/DefaultCachePolicy.php';
	require 'src/cache/Cache.php';
	require 'src/cache/DiskCache.php';
	require 'src/caller/CurlCaller.php';
	require 'src/Media.php';
	require 'src/Tag.php';
	require 'src/Artist.php';
 
	$apiKey = "6ed42890522918c59b5459a65ece5818";
	$apiSecret = "478d83cd5d9e35df391a933e5eff93dd";
	$searchArtist = "The Commander";
	$searchSong = "Never Mind the haters";

	$caller = CallerFactory::getCurlCaller();
	$caller->setApiKey($apiKey);
	$caller->setApiSecret($apiSecret);
	$lastfmArtist = Artist::getInfo("The Commander");	
	echo '<img src='.$lastfmArtist->getImage(Media::IMAGE_EXTRALARGE).'>';
	print "<pre>";
	print_r($artist);
	print "</pre>";
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 0);
	curl_setopt($curl, CURLOPT_URL, "http://ws.spotify.com/search/1/artist.json?q=".urlencode($searchArtist));
	
	$content = json_decode(curl_exec($curl), true);
	$response = curl_getinfo($curl);
	curl_close ($curl);
	print "<pre>";
	print_r($content);
	print "</pre>";
	$spotifyURI = $content['artists'][0]['href'];
	$spotifyArtistName = $content['artists'][0]['name'];
		
	echo '<a href="'.$spotifyURI.'">'.$spotifyArtistName.'</a>';
	
?>