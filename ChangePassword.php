
<?php
session_start();
include_once("connectDB.php");
if (isset($_SESSION['us'])) {
    $name = $_SESSION['us'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$name'");
} else {
    $name = $_SESSION["Admin"];
    $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE id='$name'");
}

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if (isset($_SESSION['us'])) {
        $pass = $row['Password'];
    } else {
        $pass = $row['admin_pwd'];
    }
}
if (isset($_GET['function']) && $_GET['function'] == 'changepass') {
    $oldPass = $_POST["oldpass"];
    $newPass = $_POST["newpassword"];
    $confirmPass = $_POST["confrimpassword"];

    if (md5($oldPass) != $pass) {
        echo "<script>alert('Old password is not correct')</script>";
        echo "<script> location.href='index.php?page=changepass'</script>";
        exit;
    } elseif ($newPass != $confirmPass) {
        echo "<script>alert('New password and confirm password do not match')</script>";
        echo "<script> location.href='index.php?page=changepass'</script>";
        exit;
    } else {
        $pwd = md5($confirmPass);
        if (isset($_SESSION['us'])) {
            mysqli_query($conn, "UPDATE users SET `Password` = '$pwd' WHERE username = '$name'");
        } else {
            mysqli_query($conn, "UPDATE `admin` SET `admin_pwd` = '$pwd' WHERE id = '$name'");
        }   
        echo "<script>alert('Change password success')</script>";
        echo "<script> location.href='index.php?page=user'</script>";
        exit;
    }
}
?>