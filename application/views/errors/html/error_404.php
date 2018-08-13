<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>404 - Error Not Found</title>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
	<link rel="icon" href="http://i.imgur.com/I6Udqo8.png" sizes="any" type="image/png">
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

</head>
<style>
	body {
		background: #facac0;
		overflow: hidden;
	}

	#content {
		width: 50%;
		margin: 5% auto;
		text-align: center;
	}

	.background {
		width: 100%;
		height: 140%;
		position: absolute;
		background: -webkit-linear-gradient(top, rgb(161,219,255) 0%,rgb(203,235,255) 53%,rgb(240,249,255) 100%); /* Chrome10+,Safari5.1+ */
		background-size: 100% 100%;
		z-index: -1;
	}

	.clouds {
		width: 200x;
		height: 300px;
		position: absolute;
	}

	.cloud1 {
		top: 80px;
		z-index: 100;
		fill: #ffffff;
		-webkit-animation: move 20s linear infinite;
		-moz-animation: move 20s linear infinite;
		-o-animation: move 20s linear infinite;
		animation: move 20s linear infinite;
	}

	.cloud2 {
		top: 240px;
		z-index: 200;
		fill: #ffffff;
		-webkit-animation: move 35s linear 10s infinite backwards;
		-moz-animation: move 35s linear 10s infinite backwards;
		-o-animation: move 35s linear 10s infinite backwards;
		animation: move 35s linear 10s infinite backwards;
	}


	.cloud3 {
		top: 340px;
		z-index: 200;
		fill: #ffffff;
		-webkit-animation: move 35s linear 6s infinite backwards;
		-moz-animation: move 35s linear 6s infinite backwards;
		-o-animation: move 35s linear 6s infinite backwards;
		animation: move 35s linear 6s infinite backwards;
	}


	.cloud4  {
		top: 480px;
		z-index: 100;
		fill: #ffffff;
		-webkit-animation: move 10s linear infinite;
		-moz-animation: move 10s linear infinite;
		-o-animation: move 10s linear infinite;
		animation: move 10s linear infinite;
	}


	@-webkit-keyframes move {
		from {-webkit-transform: translateX(-400px);}
		to {-webkit-transform: translateX(1350px);}
	}


</style>
<body class="valign-wrapper">
	<div class="background">
		<svg class="clouds cloud1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
		</svg>
		<svg class="clouds cloud2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
		</svg>

		<svg class="clouds cloud3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
		</svg>
		<svg class="clouds cloud4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<path id="cloud-icon" d="M406.1 227.63c-8.23-103.65-144.71-137.8-200.49-49.05 -36.18-20.46-82.33 3.61-85.22 45.9C80.73 229.34 50 263.12 50 304.1c0 44.32 35.93 80.25 80.25 80.25h251.51c44.32 0 80.25-35.93 80.25-80.25C462 268.28 438.52 237.94 406.1 227.63z"/>
		</svg>
	</div>
	<div id="content" class="valign card-panel white">
		<img src="http://i.imgur.com/8VBSXs0.png">
		<h4>Uh oh, it seems that you're lost.</h4>
		It's okay, you can search for directions or <a href="/">go back to the beginning</a>.
		<form id="search" method="get" action="<?= '/search/' ?>">
			<div class="row">
				<div class="input-field col l9">
					<label>Search by a keyword</label>
					<input type="text" name="query"/>
				</div>
				<input type="submit" style="margin-top:1.5em" class="col l3  light-blue lighten-3 right btn waves-effect waves-light" value="Search">
			</div>
		</form>
		<a href="https://codepen.io/saadbess/pen/ejhlr"><small>SVG animation by Saad Koubeissi</small></a>
	</div>
</body>
</html>