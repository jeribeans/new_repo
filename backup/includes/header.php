<!DOCTYPE html>
	<html>
		<head>
			<title>DEVAPP</title>
		</head>
	<body>
	<?php include('plugins.php'); ?>
	<?php include('resources/config/db.php'); ?>
	<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
	date_default_timezone_set('Asia/Manila');
		}?>
