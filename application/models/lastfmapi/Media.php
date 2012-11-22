<?php

/** Represents some kind of media and provides common information.
 *
 * @package	php-lastfm-api
 * @author  Felix Bruns <felixbruns@web.de>
 * @version	1.0
 */
class Media {
	/** Name of this medium.
	 *
	 * @var string
	 * @access	private
	 */
	private $name;

	/** MusicBrainz ID of this medium.
	 *
	 * @var string
	 * @access	private
	 */
	private $mbid;

	/** Last.fm URL of this medium.
	 *
	 * @var string
	 * @access	private
	 */
	private $url;

	/** An array of images of this medium.
	 *
	 * @var array
	 * @access	private
	 */
	private $images;

	/** Number of listeners of this medium.
	 *
	 * @var integer
	 * @access	private
	 */
	private $listeners;

	/** Play count of this medium.
	 *
	 * @var integer
	 * @access	private
	 */
	private $playCount;

	/** Possible image sizes.
	 *
	 * @var integer
	 * @access	public
	 */
	const IMAGE_UNKNOWN    = -1;
	const IMAGE_SMALL      =  0;
	const IMAGE_MEDIUM     =  1;
	const IMAGE_LARGE      =  2;
	const IMAGE_HUGE       =  3;
	const IMAGE_EXTRALARGE =  4;
	const IMAGE_ORIGINAL   =  5;

	/** Create a media object.
	 *
	 * @param string	$name		Name for this medium.
	 * @param string	$mbid		MusicBrainz ID for this medium.
	 * @param string	$url		Last.fm URL for this medium.
	 * @param array		$images		An array of images of different sizes.
	 * @param integer	$listeners	Number of listeners for this medium.
	 * @param integer	$playCount	Play count of this medium.
	 *
	 * @acc