<?php
    header("Location: https://nightmsc.com");
    exit(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin Panel</title>

    <?php include 'elements/head.php'; ?>

</head>
<body>
<?php include 'elements/ajax.php'; ?>
    <?php loadAdminPanel(); ?>
</body>
</html>