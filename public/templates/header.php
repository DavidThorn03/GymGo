<?php
require_once "../src/session.php";
session_start();
session::initialiseSessionItems();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

    <link href="../css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../css/style.css" />

    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

<div class="hero_area">
    <!-- header section strats -->
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.php">
            <span>
              GymGo
            </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php"> Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ShoppingCartManager.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bookingAvailable.php">Lessons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                    Login
                  </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                    Sign Up
                  </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    <!-- end header section -->