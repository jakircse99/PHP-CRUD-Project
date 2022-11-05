<?php

    require_once ("./inc/functions.php");

    // data seeding

    $task = $_GET['task'] ?? 'info';

    if('seed' == $task) {
        seed();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Project</title>

    <!-- miligram css style link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

    <!-- custom css style link -->
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <!-- main section start -->
    <div class="container">
        <header>
            <h2>PHP CRUD Project</h2>
        </header>
        <!-- navbar start -->
        <div class="row">
            <div class="column column-offset-25">
                <?php include_once "./inc/templates/nav.php" ?>
            </div>
        </div>
        <!-- navbar end -->

    <!-- content section start -->

    <div class="row">
            <div class="column column-offset-25">
                <?php  ?>
            </div>
        </div>

    <!-- content section ends -->
    </div>

    <!-- main section end -->
</body>
</html>