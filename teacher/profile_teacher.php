<?php include "../includes/db.php"; ?>
<?php include "../includes/teacher-session.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

// Display user profile to be updated
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id='$user_id'";
    $user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($user_profile_query)) {
        $user_id = $row['user_id'];
        $user_full_name = $row['user_full_name'];
        $user_nric = $row['user_nric'];
        $user_password = $row['user_password'];
        $user_birthday = $row['user_birthday'];
        $user_age = $row['user_age'];
        $user_gender = $row['user_gender'];
        $user_mobile_no = $row['user_mobile_no'];
        $user_email = $row['user_email'];
        $user_address = $row['user_address'];
        $user_role = $row['user_role'];
        $user_programme = $row['user_programme'];
        $user_intake = $row['user_intake'];
        $user_emergency_contact = $row['user_emergency_contact'];
    }
}

?>

<?php

// Update user profile
if (isset($_POST['updateprofile'])) {
    $user_full_name = escape($_POST['full_name']);
    $user_nric = escape($_POST['nric']);
    $user_password = escape($_POST['password']);
    $user_birthday = escape($_POST['date-of-birth']);
    $user_age = escape($_POST['age']);
    $user_gender = escape($_POST['gender']);
    $user_mobile_no = escape($_POST['mobile']);
    $user_email = escape($_POST['email']);
    $user_address = escape($_POST['address']);

    $query = "UPDATE users SET ";
    $query .= "user_full_name = '$user_full_name', ";

    if (!empty($user_password)) {
        $query .= "user_password = '$user_password', ";
    }

    $query .= "user_birthday = '$user_birthday', ";
    $query .= "user_age = '$user_age', ";
    $query .= "user_gender = '$user_gender', ";
    $query .= "user_mobile_no = '$user_mobile_no', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_address = '$user_address' ";
    $query .= "WHERE user_id = $user_id";

    $update_profile_query = mysqli_query($connection, $query);
    if ($update_profile_query){
        echo "<script>alert('Your profile has been updated successfully.');window.location='profile_teacher.php'</script>";
    } else {
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800;900&display=swap"
            rel="stylesheet"
        />

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <style> <?php include "../css/header.css"; ?> </style>
        <link rel="stylesheet" href="../css/profile-both.css" />

        <title>Teacher Profile | EduTrack</title>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="profile">
                        <p class="profile__title">Role: <?php echo $_SESSION['user_role']; ?></p>
                        <h1 class="heading-primary">Your Profile</h1>

                        <h2 class="heading-secondary">Personal Information</h2>
                        <div class="profile__form-box">
                            <form class="update-profile-form" action="" method="post" autocomplete="off">  
                                <div class="form-row">
                                    <label for="full_name" class="profile__form-label">Full Name (as per IC)</label>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="full_name"
                                        id="full_name"
                                        value="<?php if (isset($user_full_name)) {echo $user_full_name; } ?>"
                                        oninput="capitalizeFullName()"
                                        required
                                    />
                                </div>

                                <div class="form-row">
                                    <label for="nric" class="profile__form-label">NRIC (without "-")</label>
                                    <input
                                        type="number"
                                        name="nric"
                                        class="nric"
                                        id="nric"
                                        value="<?php if (isset($user_nric)) {echo $user_nric; } ?>"
                                        onblur="checkICLength(this)"
                                        readonly
                                    />
                                </div>

                                <div class="form-row">
                                    <label for="password" class="profile__form-label">Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        class="password"
                                        id="password"
                                        placeholder="Leave it blank if no change is needed"
                                    />
                                </div>

                                <div class="form-group">
                                    <div class="form-row form-row-3">
                                        <label for="date-of-birth" class="profile__form-label">Date of Birth (DD/MM/YYYY)</label>
                                        <input
                                            type="date"
                                            name="date-of-birth"
                                            class="date-of-birth"
                                            id="date-of-birth"
                                            value="<?php if (isset($user_birthday)) {echo $user_birthday; } ?>"
                                            oninput="calcAge(this)"
                                            required
                                        />
                                    </div>

                                    <div class="form-row form-row-4">
                                        <label for="age" class="profile__form-label">Age</label>
                                        <input
                                            type="number"
                                            name="age"
                                            class="age"
                                            id="age"
                                            value="<?php if (isset($user_age)) {echo $user_age; } ?>"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row form-row-5">
                                        <label for="gender" class="profile__form-label">Gender</label>
                                        <select name="gender" id="gender" required>
                                            <option value="" selected disabled>
                                                Gender
                                            </option>
                                            <option value="male" <?php if($user_gender == "male") echo 'selected="selected"'; ?>>Male</option>
                                            <option value="female" <?php if($user_gender == "female") echo 'selected="selected"'; ?>>Female</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-row form-row-6">
                                        <label for="mobile" class="profile__form-label">Mobile No</label>
                                        <input
                                            type="number"
                                            name="mobile"
                                            class="mobile"
                                            id="mobile"
                                            value="<?php if (isset($user_mobile_no)) {echo $user_mobile_no; } ?>"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="email" class="profile__form-label">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="email"
                                        id="email"
                                        value="<?php if (isset($user_email)) {echo $user_email; } ?>"
                                        required
                                    />
                                </div>

                                <div class="form-row">
                                    <label for="address" class="profile__form-label">Address</label>
                                    <input
                                        type="text"
                                        name="address"
                                        class="address"
                                        id="address"
                                        value="<?php if (isset($user_address)) {echo $user_address; } ?>"
                                        required
                                    />
                                </div>

                                <div class="form-row">
                                    <input
                                        type="submit"
                                        name="updateprofile"
                                        class="updateprofile-btn"
                                        value="Update Profile"
                                    />
                                </div>
                            </form>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </body>
</html>
