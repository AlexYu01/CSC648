<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = false;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Andrew's About Page</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="http://getbootstrap.com/dist/css/bootstrap.min.css">
<link
	href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css"
	rel="stylesheet">
<link
	href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css"
	rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="header clearfix">
			<nav>
				<ul class="nav nav-pills pull-right">
					<li role="presentation"><a href="#">Home</a></li>
					<li role="presentation" class="active"><a href="#">About</a></li>
					<li role="presentation"><a href="#">Contact</a></li>
				</ul>
			</nav>
			<h3 class="text-muted">Group Team5</h3>
		</div>

		<div class="row marketing" style="margin-top: 20px;">
			<div class="col-lg-12">
				<h4>Andrew Cheng</h4>
				<p>Hi, My name is Andrew (Zhiyang Cheng), I'm a SFSU CS major
					student.</p>
			</div>
			<div class="col-lg-12">
				<img src="https://i.ytimg.com/vi/_FvTVWjLiHM/hqdefault.jpg"
					width="480" height="360" />
			</div>
		</div>

	</div>
</body>
</html>


