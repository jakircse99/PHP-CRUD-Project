
<nav>
    <?php if(hasPrivilege()): ?>
    <a href="index.php?task=info"><button>All Students</button></a>
    <a href="index.php?task=add"><button class="greenbtn">Add Student</button></a>
    <?php endif; ?>
    <?php if(isAdmin()): ?>
    <a href="index.php?task=seed"><button class="yellowbtn">Data seeding</button></a>
    <?php endif; ?>

    <?php if(isset($_SESSION['loggedin']) == false): ?>
        <a href="admin.php" class="float-right"><strong>Login</strong></a>
    <?php else: ?>
        <a href="admin.php?logout=true" class='float-right'><strong>Logout (<?php echo $_SESSION['role'] ?>)</strong></a>
    <?php endif; ?>
</nav>