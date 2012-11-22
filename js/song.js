$(document).ready(function(){
/*
	var args = getPathArgs();
	if(args != null) {
		console.log(location.href);
		console.log($.address.path());
		console.log($.address.baseURL());
		console.log($.address.value());
		
		$.address.value("http://www.digitalmagi.se/nowplaying");
		$.address.update();
		$.address.hash("/"+args[1]+"/"+args[2]);	
	}
	else {
	    getForm();
	}
*/

	$.address.externalChange(function() {
		var args = getArgs()
		if (args != null) {
			getTrack(decodeURI(args[0]), decodeURI(args[1]));
		}
		else {
			getForm();
		}
	});

	$('form').submit(function(eve) {
		eve.preventDefault();
		search();
	});
});

function getArgs() {
	var url = window.location.href.split("#/");
	var args = null;
	if (url[1] != null) {
		args = url[1].split("/");	
	}
	console.log(args);
	return args;
}
function getPathArgs() {
	var url = window.location.pathname.split("/");
	var args = null;
	console.log(url);
	if ((url[2] != null) && (url[3] != null)) {
		args = [url[1],url[2],url[3]];	
	}
	return args;
}

function search() {
	var artist = $('#artist').val();
    var track = $('#track').val();
    doSearch(artist, track);
}
function doSearch(artist,track) {
    $('#animation-wrapper').fadeIn('fast');
    $('#content').fadeOut('slow');
    console.log("Search: "+ artist + " " + track);
    $.post("/nowplaying/song/search/",{"artist": artist, "track": track}, function(data) {
		console.log(data.artist + data.title);
   		getTrack(data.artist,data.title);
		window.location.hash = "/"+ encodeURI(data.artist+"/"+data.title);
    }, 'json');

}

function getTrack(artist, track) {
	console.log(encodeURI(artist)+encodeURI(track));
	$.post("/nowplaying/song/view",{artist: artist, track: track}, function(trackData) {
		$('#content').html(trackData).fadeIn('slow');
		$('#animation-wrapper').fadeOut('slow');
	}, 'text');
}
function getForm() {
	$.get("/nowplaying/song/form", function(data, textStatus) {
		$('#content').html(data).fadeIn('slow');
		$('#animation-wrapper').fadeOut('slow');
	}, 'text');
}