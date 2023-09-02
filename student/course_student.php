<?php include "../includes/db.php"; ?>
<?php include "../includes/student-session.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

// Display users' courses based on programme enrolled
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id='$user_id'";
    $user_id_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($user_id_query)) {
        $user_id = $row['user_id'];
        $user_programme = $row['user_programme'];
        $user_intake = $row['user_intake'];
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
        <link rel="stylesheet" href="../css/course_result-student.css" />

        <title>Student Course | EduTrack</title>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/student-sidebar.php"; ?>

                <main class="content">
                    <section class="course">
                        <p class="course-intake">Intake: <?php echo $user_intake; ?></p>
                        <h1 class="heading-primary">
                            Programme Enrolled: <?php echo $user_programme; ?>
                        </h1>
                        <h2 class="heading-secondary">Modules Taken:</h2>

                        <table class="courseresult__table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Module Code</th>
                                    <th>Module Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $numbering = 1;

                                $query = "SELECT * FROM modules WHERE module_programme='$user_programme' ORDER BY module_name ASC";
                                $user_modules_query = mysqli_query($connection, $query);

                                if (mysqli_num_rows($user_modules_query) > 0) {
                                    while ($row = mysqli_fetch_assoc($user_modules_query)) {
                                        $module_id = $row['module_id'];
                                        $module_code = $row['module_code'];
                                        $module_name = $row['module_name'];

                                        $query = "SELECT * FROM results WHERE user_id='$user_id' AND module_id='$module_id'";
                                        $module_status_query = mysqli_query($connection, $query);
                                        $module_status_row = mysqli_fetch_assoc($module_status_query);
                                        if ($module_status_row) {
                                            $result_status = $module_status_row['result_status'];
                                        } else {
                                            $result_status = "In Progress";
                                        }

                                ?>

                                <tr>
                                    <td data-cell="no."><?php echo $numbering++; ?></td>
                                    <td data-cell="module code"><?php echo $module_code; ?></td>
                                    <td data-cell="module name"><?php echo $module_name; ?></td>
                                    <td data-cell="status"><?php echo $result_status; ?></td>
                                </tr>

                                <?php
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='4'><p style='text-align: center;'>No records found</p></td>";
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
