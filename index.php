<?php
     // session start
     session_name('crudapp');
     session_start([
         'cookie_lifetime' => '300'
     ]);

    require_once ("./inc/functions.php");

    // data seeding

    $task = $_GET['task'] ?? 'info' ;
    $message = '';
    $error = 0;

    if('seed' == $task) {
        if(!isAdmin()) {
            header('location: index.php');
            return;
        }
        seed();
        $message = 'Seeding is complete';
    }

    // add student
    $name = '';
    $department = '';
    $age = '';
    $roll = '';

    if(isset($_POST['submit'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_SPECIAL_CHARS);
        $roll = filter_input(INPUT_POST, 'roll', FILTER_SANITIZE_SPECIAL_CHARS);
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        // update student
        if($id) {
            if(!hasPrivilege()){
                header('location:index.php');
                return;
            }
            $result = updateStudent($id, $name, $department, $age, $roll);
            if($result) {
                header('location:index.php');
            } else {
                $error = 1;
            }
        }else {
            // addstudent
            if($name != '' && $department !='' && $age != '' && $roll != '') {
                if(!hasPrivilege()){
                    header('location:index.php');
                    return;
                }
                $result = addStudent($name, $department, $age, $roll);
                if($result) {
                    header('location:index.php');
                } else {
                    $error = 1;
                } 
        }
    }
}

// delete students
if('delete' == $task) {
    if(!isAdmin()) {
        header('location: index.php');
        return;
    }
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    if($id > 0) {
        deleteStudent($id);
        header('location:index.php');
    }
}

// edit student
if('edit' == $task) {
    if(!hasPrivilege()) {
        header('location:index.php');
        return;
    }
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
            <div class="column column-100 column-offset-0">
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
    <?php if('1' == $error): ?>
        <blockquote>Duplicate roll number</blockquote>
    <?php endif?>

    <?php if('add' == $task): ?>
    <form action="index.php?task=add" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $name ?>">
        <label for="department">Department</label>
        <input type="text" name="department" id="department" value="<?php echo $department ?>">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="<?php echo $age ?>">
        <label for="roll">Roll</label>
        <input type="number" name="roll" id="roll" value="<?php echo $roll ?>">
        <input type="submit" name="submit" value="submit">
    </form>
    <?php endif ?>

    <!-- add student section end -->

    <!-- edit student start -->

    <?php if('edit' == $task):
        $id = filter_input(INPUT_GET, 'id');
        $student = getStudent($id);
        ?>
    <form action="" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $student['name'] ?>">
        <label for="department">Department</label>
        <input type="text" name="department" id="department" value="<?php echo $student['department'] ?>">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="<?php echo $student['age'] ?>">
        <label for="roll">Roll</label>
        <input type="number" name="roll" id="roll" value="<?php echo $student['roll'] ?>">
        <input type="submit" name="submit" value="submit">
    </form>
    <?php endif ?>

    <!-- edit student end -->

    <!-- content section end -->
    </div>

    <!-- main section end -->

    <!-- custom js script -->
    <script src='./assets/script.js'></script>
</body>
</html>