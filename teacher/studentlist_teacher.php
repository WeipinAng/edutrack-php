<?php include "../includes/db.php"; ?>
<?php include "../includes/teacher-session.php"; ?>
<?php include "../includes/functions.php"; ?>

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
        <link rel="stylesheet" href="../css/userlist-teacher.css" />

        <title>Student List | EduTrack</title>

        <script src="../js/search.js"></script>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="user-list">
                        <div class="heading-search-box">
                            <h1 class="heading-primary">
                                Students List
                            </h1>
                            <div class="search-box">
                                <input type="text" name="search" id="search-input" placeholder="Find students ..." autocomplete="off" spellcheck="false">
                                <div class="search-button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>

                        <table class="users__list" id="table">
                            <thead>
                                <tr>
                                    <th style="width: 3%;">No.</th>
                                    <th style="width: 8%;">Full Name</th>
                                    <th style="width: 6%;">NRIC</th>
                                    <th style="width: 3%;">Age</th>
                                    <th style="width: 4%;">Gender</th>
                                    <th style="width: 6%;">Mobile No</th>
                                    <th style="width: 6%;">Email</th>
                                    <th style="width: 15%;">Programme</th>
                                    <th style="width: 5%;">Intake</th>
                                    <th style="width: 6%;">Emergency Contact</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                // CRUD 2: READ ALL COURSES
                                $numbering = 1;

                                $query = "SELECT * FROM users WHERE user_role='student' ORDER BY user_full_name ASC";
                                $select_users_query = mysqli_query($connection, $query);

                                if (mysqli_num_rows($select_users_query) > 0) {
                                    while ($row = mysqli_fetch_assoc($select_users_query)) {
                                        $user_full_name = $row['user_full_name'];
                                        $user_nric = $row['user_nric'];
                                        $user_birthday = $row['user_birthday'];
                                        $user_age = $row['user_age'];
                                        $user_gender = $row['user_gender'];
                                        $user_mobile_no = $row['user_mobile_no'];
                                        $user_email = $row['user_email'];
                                        $user_address = $row['user_address'];
                                        $user_programme = $row['user_programme'];
                                        $user_intake = $row['user_intake'];
                                        $user_emergency_contact = $row['user_emergency_contact'];

                                ?>

                                <tr>
                                    <td data-cell="no."><?php echo $numbering++; ?></td>
                                    <td data-cell="full name"><?php echo $user_full_name; ?></td>
                                    <td data-cell="NRIC"><?php echo $user_nric; ?></td>
                                    <td data-cell="age"><?php echo $user_age; ?></td>
                                    <td data-cell="gender"><?php echo ucfirst($user_gender); ?></td>
                                    <td data-cell="mobile no"><?php echo $user_mobile_no; ?></td>
                                    <td data-cell="email"><?php echo $user_email; ?></td>
                                    <td data-cell="programme"><?php echo $user_programme; ?></td>
                                    <td data-cell="intake"><?php echo $user_intake; ?></td>
                                    <td data-cell="emergency contact"><?php echo $user_emergency_contact; ?></td>
                                </tr>

                                <?php
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='10'><p style='text-align: center;'>No records found</p></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                </main>
            </div>
        </div>
    </body>
</html>
