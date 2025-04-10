<?php
include('../../../private/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel | Library</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="../assets/css/styles.css" rel="stylesheet" /> -->
    <link rel="icon" type="image/x-icon" href="../../image/icon.jpg">
  </head>



 

<body>
  <style>
    <?php
  include("../assets/css/styles.css");
?>
  </style>
<nav>
              <a href="index.php"><img id="img" src="../../home/image/icon.jpg"></a>
              <!-- <form class="formSearch" action="search.php" method="post">
                <input type="text" name="search" placeholder="Search ...">
                <label type="submit" for="" class="fas fa-search"></label>
              </form> -->
            
              <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li>
                    <a href="../dashboard/index.php" id="dashboard">Dashboard</a>
                    </li>
                    <li>
                    <a id="member" href="../member/index.php">Member</a>
                    </li>
                    <li>
                    <a id="info" href="../books/index.php?idCategorie=1">Info</a>
                    </li>
                    <li>
                    <a id="maths"  href="../books/index.php?idCategorie=2">Maths</a>
                    </li>
                    <li><a  id="chemistry" href="../books/index.php?idCategorie=4">Chemistry</a></li>
                    <li><a id="physics" href="../books/index.php?idCategorie=3">Physics</a></li>
                    <li>
                        <a id="settings" href="../settings/index.php">Settings</a>
                    </li>
                    <li>
                        <a href="../../../private/login/logout.php">Logout</a>
                    </li>
                </ul>
              </div>
              <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
<!-- <nav>
  <input id="nav-toggle" type="checkbox">
  <div class="logo"><img src="../assets/imgs/icon.jpg" width="60"><strong>Library</strong></div>
  <ul class="links">
		<li><a href="../dashboard/index.php">Dashboard</a></li>
		<li><a href="../member/index.php">Member</a></li>
    <li><a href="../books/index.php?idCategorie=1">Info</a></li>
		<li><a href="../books/index.php?idCategorie=2">Maths</a></li>
		<li><a href="../books/index.php?idCategorie=4">Chemistry</a></li>
    <li><a href="../books/index.php?idCategorie=3">Physics</a></li>
    <li><a href="../../../private/login/logout.php">Logout</a></li>
	</ul>
	<label for="nav-toggle" class="icon-burger">
		<div class="line"></div>
		<div class="line"></div>
		<div class="line"></div>
	</label>
</nav> -->
<script src="../../home/script.js"></script>

<div class="container" id="container">