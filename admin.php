<?php
    // session start
    session_name('crudapp');
    session_start([
        'cookie_lifetime' => '300'
    ]);

    // authentication
    $_SESSION['loggedin'] = $_SESSION['loggedin'] ?? false;
    $userName = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $error = false;

    $fp = fopen('./data/users.txt', 'r');
    if(isset($userName) && isset($password)) {
        $_SESSION['loggedin'] = false;
        $_SESSION['role'] = false;

        while($data = fgetcsv($fp)) {
            if($data[0] == $userName && $data[1] == md5($password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = $data[2];
                header('location:index.php');
            }
        }
        if(!$_SESSION['loggedin']) {
            $error = true;
        }
    }
    if(isset($_GET['logout'])) {
        $_SESSION['loggedin'] = false;
        $_SESSION['username'] = false;
        $_SESSION['role'] = false;
        session_destroy();
        header('location:index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- miligram css style link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

    <!-- custom css style link -->
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column column-50 column-offset-25">
                <header>
                <h2>Welcome to admin login panel</h2>
                </header>
                <?php if($error == true) {
                    echo "<blockquote>username and password doesn't match</blockquote>";
                }
                if($_SESSION['loggedin'] == false):
                ?>
                <form action="" method="POST" class="login">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $userName ?? '' ?>">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <input type="submit" name="submit" value="login">
                </form>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>