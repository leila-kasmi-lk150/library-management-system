<?php
session_start();
if (isset($_SESSION['idUser'])) {
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/stl.css">
	<title>Multi step</title>
</head>

<body>
	<style>
		form{
			display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: stretch;
        height: 300px;
		}
		.btn-box button{
			align-self: flex-end;
		}
	</style>
	<?php 
		$idBook= $_GET['idBook'];
		$idUser = $_SESSION['idUser'];
		$idType = $_GET['idType'];
		$Action = $_GET['Action'];
		echo "Action : $Action  ";
		echo "idUser: $idUser  ";
		echo "idBook: $idBook  ";
		echo "idType: $idType";

	}?>