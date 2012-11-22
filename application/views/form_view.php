<div id="form">
	<h1><?= $title ?></h1>
	<form id="form" name="form" action="javascript:search();">
		<div class="input-wrapper clearfix">
			<label for="artist">Artist:</label>
			<input type="text" name="artist" id="artist" autofocus required />
		</div>
		<div class="input-wrapper clearfix">
			<label for="track">Song:</label>
			<input type="text" name="track" id="track" required />
		</div>
		<input type="submit" value="Go!" name="submit" id="submit" />
	</form>
</div>