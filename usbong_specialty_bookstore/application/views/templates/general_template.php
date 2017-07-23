<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<title>Usbong Store Header</title>
	<style type="text/css">

	::selection { background-color: #f07746; color: #fff; }
	::-moz-selection { background-color: #f07746; color: #fff; }

	body {
		background-color: #fff;
		margin: 0px auto;
		margin-top: 10px;
		max-width: 1024px;
		font: 16px/24px normal "Helvetica Neue",Helvetica,Arial,sans-serif;
		color: #808080;
	}
	
	p {
		 margin: 0 0 10px;
		 padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 12px;
		border-top: 1px solid #d0d0d0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
		background:#8ba8af;
		color:#fff;
	}
	
	.Search {
	}

	.Search-input {
		width: 60%;
		float:left;
		font-size: 22px;
		padding: 6px;
		border: #ffffff;		
		border-top: 1px solid #d0d0d0;
		border-left: 1px solid #d0d0d0;
		border-bottom: 1px solid #d0d0d0;
	}
	
	.Button-container {
	}
	
	.Button {		
		padding: 5.5px;
		border-top: 1px solid #d0d0d0;
		border-right: 1px solid #d0d0d0;
		border-bottom: 1px solid #d0d0d0;
		border-left: #ffffff;		
		background:#ffffff;
	}
}
	
	</style>
</head>
<body>
<!--	<img src="<?php echo base_url('assets/images/usbongStoreBrandLogo.png'); ?>">	-->
	<div class="Search">
		<input type="text" class="Search-input" placeholder="I'm looking for...">
		<div class="Button-container"><button type="button" class="Button"><img src="<?php echo base_url('assets/images/magnifying_glass.png'); ?>"></button></div>
    </div>
	<nav class="navbar navbar">
	  <div class="container-fluid">
		<ul class="nav navbar-nav">
		  <li class="active"><a href="#">BOOKS</a></li>
		  <li><a href="#">COMBOS</a></li>
		  <li><a href="#">BEVERAGES</a></li>
		  <li><a href="#">COMICS</a></li>
		  <li><a href="#">MANGA</a></li>
		  <li><a href="#">TOYS & COLLECTIBLES</a></li>
		  </ul>
	  </div>
	</nav>
	
</body>
</html>
