<?php ob_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

<?php

if(isset($_POST['register'])) {
    $user_full_name = escape($_POST['full_name']);
    $user_nric = escape($_POST['nric']);
    $user_password = escape($_POST['password']);
    $user_birthday = escape($_POST['date-of-birth']);
    $user_age = escape($_POST['age']);
    $user_gender = escape($_POST['gender']);
    $user_mobile_no = escape($_POST['mobile']);
    $user_email = escape($_POST['email']);
    $user_address = escape($_POST['address']);
    $user_role = escape($_POST['role']);
    $user_programme = isset($_POST['programme']) ? escape($_POST['programme']) : null;
    $user_intake = escape($_POST['intake']);
    $user_emergency_contact = escape($_POST['emergencycontact']);

    $query = "SELECT user_nric FROM users WHERE user_nric='$user_nric'";
    $check_existing_nric_query = mysqli_query($connection, $query);
    confirm_query($check_existing_nric_query);

    if (mysqli_num_rows($check_existing_nric_query) != 0) {
        echo "<script>alert('An account has already been registered with your NRIC.');window.location='signup.php'</script>";
    } else {
        if (!empty($user_full_name) && !empty($user_nric) && !empty($user_password) && !empty($user_birthday) && !empty($user_age) && !empty($user_gender) && !empty($user_mobile_no) && !empty($user_email) && !empty($user_address)  && !empty($user_role)) {
            $query = "INSERT INTO users (user_full_name, user_nric, user_password, user_birthday, user_age, user_gender, user_mobile_no, user_email, user_address, user_role, user_programme, user_intake, user_emergency_contact) VALUES ('$user_full_name', '$user_nric', '$user_password', '$user_birthday', '$user_age', '$user_gender', '$user_mobile_no', '$user_email', '$user_address', '$user_role', '$user_programme', '$user_intake', '$user_emergency_contact')";
    
            $register_user_query = mysqli_query($connection, $query);
            if ($register_user_query){
                echo "<script>alert('Your registration has been completed successfully.');window.location='login.php'</script>";
            } else {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        } else {
            echo '<script>alert("Field(s) cannot be empty.")</script>';
        }
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

        <link rel="stylesheet" href="css/signup.css" />

        <title>Sign Up | EduTrack</title>
    </head>
    <body>
        <div class="container">
            <div class="signup-form-box">
                <h1 class="heading-primary">
                    Student / Teacher Registration Form
                </h1>
                <p class="login-text">
                    Already have an account? &nbsp;
                    <a href="login.php" class="login-link"> Log In &rarr;</a>
                </p>

                <hr class="divider" />

                <h2 class="heading-secondary">Personal Infomation</h2>
                <form
                    class="form-detail"
                    action=""
                    method="post"
                    autocomplete="off"
                >
                    <div class="form-left">
                        <div class="form-row">
                            <input
                                type="text"
                                name="full_name"
                                class="full_name"
                                id="full_name"
                                placeholder="Full Name (as per IC)"
                                oninput="capitalizeFullName()"
                                autofocus
                                required
                            />
                        </div>

                        <div class="form-row">
                            <input
                                type="number"
                                name="nric"
                                class="nric"
                                id="nric"
                                placeholder='NRIC (without "-")'
                                minlength="12"
                                maxlength="12"
                                onblur="checkICLength(this)"
                                required
                            />
                        </div>

                        <div class="form-row">
                            <input
                                type="password"
                                name="password"
                                class="password"
                                id="password"
                                placeholder="Password"
                                required
                            />
                        </div>

                        <div class="form-group">
                            <div class="form-row form-row-3">
                                <input
                                    type="text"
                                    name="date-of-birth"
                                    class="date-of-birth"
                                    id="date-of-birth"
                                    placeholder="Date of Birth"
                                    onfocus="(this.type='date')"
                                    onblur="if(this.value==''){this.type='text'}"
                                    oninput="calcAge(this)"
                                    required
                                />
                            </div>

                            <div class="form-row form-row-4">
                                <input
                                    type="number"
                                    name="age"
                                    class="age"
                                    id="age"
                                    placeholder="Age"
                                    required
                                />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row form-row-5">
                                <select name="gender" required>
                                    <option value="" selected disabled>
                                        Gender
                                    </option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="select-btn">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </div>

                            <div class="form-row form-row-6">
                                <input
                                    type="number"
                                    name="mobile"
                                    class="mobile"
                                    id="mobile"
                                    placeholder="Mobile No"
                                    required
                                />
                            </div>
                        </div>

                        <div class="form-row">
                            <input
                                type="email"
                                name="email"
                                class="email"
                                id="email"
                                placeholder="Email"
                                required
                            />
                        </div>

                        <div class="form-row">
                            <input
                                type="text"
                                name="address"
                                class="address"
                                id="address"
                                placeholder="Address"
                                required
                            />
                        </div>
                    </div>

                    <div class="form-right">
                        <div class="form-row">
                            <select name="role" id="role" required>
                                <option value="" selected disabled>Role</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                            <span class="select-btn">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </div>

                        <div class="form-row student-only">
                            <span>* Only applicable for student</span>
                            <select name="programme" id="programme">
                                <option value="" selected disabled>
                                    Pre-U Programmes
                                </option>
                                <option value="Foundation in Arts">Foundation in Arts</option>
                                <option value="Foundation in Business">
                                    Foundation in Business
                                </option>
                                <option value="Foundation in Computing">
                                    Foundation in Computing
                                </option>
                                <option value="Foundation in Design">
                                    Foundation in Design
                                </option>
                                <option value="Foundation in Engineering">
                                    Foundation in Engineering
                                </option>
                                <option value="Foundation in Science">
                                    Foundation in Science
                                </option>
                                <option value="Cambridge A Level">
                                    Cambridge A Level
                                </option>
                                <option value="SACE International">SACE International</option>
                            </select>
                            <span class="select-btn">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </div>

                        <div class="form-row student-only">
                            <span>* Only applicable for student</span>
                            <input
                                type="text"
                                name="intake"
                                class="intake"
                                id="intake"
                                placeholder="Intake / Semester"
                                onfocus="(this.type='month')"
                                onblur="if(this.value==''){this.type='text'}"
                            />
                        </div>

                        <div class="form-row student-only">
                            <span>* Only applicable for student</span>
                            <input
                                type="number"
                                name="emergencycontact"
                                class="emergencycontact"
                                id="emergencycontact"
                                placeholder="Emergency Contact"
                            />
                        </div>

                        <div class="form-row-last">
                            <input
                                type="submit"
                                name="register"
                                class="signup-btn"
                                value="Sign Up"
                            />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="js/signup.js"></script>
    </body>
</html>
