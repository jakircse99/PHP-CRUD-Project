<?php

    require_once ("./inc/functions.php");

    // data seeding

    $task = $_GET['task'] ?? 'info';
    $message = '';

    if('seed' == $task) {
        seed();
        $message = 'Seeding is complete';
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

    <!-- seeding section start -->
    <?php if('seed' == $task): ?>
        <div class="row">
            <div class="column column-offset-25">
                <blockquote><?php echo $message ?></blockquote>
            </div>
        </div>
    <?php endif ?>
    <!-- sedding section end -->
    
    <!-- info section start -->
    <?php if('info' == $task): ?>
    <div class="row">
            <div class="column">
                <?php info();?>
            </div>
    </div>
    <?php endif?>
    <!-- info section end -->

    <!-- add student section start -->

    <?php if('add' == $task): ?>
    <form action="" medtod="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label for="department">Department</label>
        <input type="text" name="department" id="department">
        <label for="age">Age</label>
        <input type="number" name="age" id="age">
        <label for="roll">Roll</label>
        <input type="text" name="roll" id="roll">
        <input type="submit" value="submit">
    </form>
    <?php endif ?>

    <!-- add student section end -->

    <!-- content section end -->
    </div>

    <!-- main section end -->
</body>
</html>