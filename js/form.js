$(document).ready(function(){
	var hash = window.location.hash.substr(1);
	if (hash) {
		getTrack(hash);
	}
	else {
		$('#animation-wrapper').hide();
	    $('#content').fadeIn('slow');	
	}
	
	$('#submit').click(function(){go()});	
	$(document).keydown(function(event){
		if (event.keyCode == '13') {
			go();
		}
	});
});

function go() {
	var artist = $('#artist').val();
    var track = $('#track').val();
    $('#animation-wrapper').fadeIn('fast');
    $('#content').fadeOut('slow');
    $.get("song/search/"+artist+"/"+track, function(data, textStatus) {
   		getTrack(data.artist+"/"+data.title);
		window.location.hash = escape("/"+data.artist+"/"+data.title);
    }, 'json');

}

function getTrack(string) {
	$.get("/nowplaying/song/view/"+string, function(trackData, textStatus) {
		$('#content').html(trackData).fadeIn('slow');
		$('#animation-wrapper').fadeOut('slow');
	}, 'text');
}