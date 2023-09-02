<?php ob_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
    $user_nric = escape($_POST['username']);
    $user_password = escape($_POST['password']);

    $query = "SELECT * FROM users WHERE user_nric='$user_nric'";
    $login_query = mysqli_query($connection, $query);
    confirm_query($login_query);

    while ($row = mysqli_fetch_assoc($login_query)) {
        $db_user_id = $row['user_id'];
        $db_user_full_name = $row['user_full_name'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }

    if (mysqli_num_rows($login_query) == 0 || $db_user_password != $user_password) {
        echo "<script>alert('NRIC or password is incorrect.');window.location='login.php'</script>";
    } else {
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['user_full_name'] = $db_user_full_name;
        $_SESSION['user_role'] = $db_user_role;

        if ($db_user_role == "student") {
            header("Location: student");
        } else {
            header("Location: teacher");
        }
    }
}

?>