<?php include "../includes/db.php"; ?>
<?php include "../includes/teacher-session.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

// Update all students' marks at once
if (isset($_POST['save_marks'])) {
  $marks = $_POST['marks'];
  $module_code = escape($_POST['module_code']);

  // Query the modules table to get the module ID
  $module_query = "SELECT module_id FROM modules WHERE module_code='$module_code'";
  $select_module_query = mysqli_query($connection, $module_query);
  if (!$select_module_query) {
    die('Query Error: ' . mysqli_error($connection));
  }
  $module_row = mysqli_fetch_assoc($select_module_query);
  $module_id = $module_row['module_id'];

  foreach ($marks as $user_id => $result_score) {
    // Check if the user already has a result for this module
    $result_query = "SELECT * FROM results WHERE user_id='$user_id' AND module_id='$module_id'";
    $select_result_query = mysqli_query($connection, $result_query);
    
    if (mysqli_num_rows($select_result_query) > 0) {
      // User already has a result, update it
      $update_query = "UPDATE results SET result_score='$result_score' WHERE user_id='$user_id' AND module_id='$module_id'";

      if (!empty($result_score)) {
        $update_status_query = "UPDATE results SET result_status='Completed' WHERE user_id='$user_id' AND module_id='$module_id'";
      } else {
        $update_status_query = "UPDATE results SET result_status='In Progress' WHERE user_id='$user_id' AND module_id='$module_id'";
      }
      mysqli_query($connection, $update_query);
      mysqli_query($connection, $update_status_query);
    } else {
      // User does not have a result, insert a new record
      $insert_query = "INSERT INTO results (user_id, module_id, result_score, result_status) VALUES ('$user_id', '$module_id', '$result_score', ";

      if (!empty($result_score)) {
        $insert_query .= "'Completed')";
      } else {
        $insert_query .= "'In Progress')";
      }
      mysqli_query($connection, $insert_query);
    }
  }
  
  // Redirect or show success message
  echo "<script>alert('All marks have been saved successfully.');window.location='result_teacher.php?module_code=$module_code&moduleoperation=Search'</script>";
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
        <link rel="stylesheet" href="../css/result-teacher.css" />

        <title>Teacher Result | EduTrack</title>

        <script src="../js/search.js"></script>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="results">
                        <h2 class="heading-secondary">Results Entry</h2>
                        <div class="module__form-box">
                            <form class="module-form" action="" method="get" autocomplete="off"> 
                                <div class="form-row">
                                    <label for="module_code" class="module__form-label">Modules Code and Name</label>
                                    <select name="module_code" id="module_code" required>
                                        <option value="" selected disabled>Select module to enter marks</option>
                                        <?php

                                        $query = "SELECT * FROM modules";
                                        $select_modules_query = mysqli_query($connection, $query);
                                        confirm_query($select_modules_query);

                                        while ($row = mysqli_fetch_assoc($select_modules_query)) {
                                            $module_code = $row['module_code'];
                                            $module_name = $row['module_name'];

                                            echo "<option value='$module_code'>$module_code &nbsp; | &nbsp; $module_name</option>";
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="form-row">
                                    <input
                                        type="submit"
                                        name="moduleoperation"
                                        class="module-btn"
                                        value="Search"
                                    />
                                </div>
                            </form>
                        </div>

                        <?php

                        $numbering = 1;

                        if (isset($_GET['moduleoperation'])) {
                            // Retrieve the module code from the form
                            $module_code = escape($_GET['module_code']);

                            // Query the modules table to get the module ID, name and programme
                            $module_query = "SELECT * FROM modules WHERE module_code='$module_code'";
                            $select_modules_query = mysqli_query($connection, $module_query);
                            $module_row = mysqli_fetch_assoc($select_modules_query);
                            $module_id = $module_row['module_id'];
                            $module_name = $module_row['module_name'];
                            $module_programme = $module_row['module_programme'];

                            // Query to retrieve the list of students enrolled in the selected module
                            $user_query = "SELECT * FROM users WHERE user_programme = '$module_programme'";
                            $select_users_query = mysqli_query($connection, $user_query);
                                    
                        ?>

                        <div class="heading-search-box">
                            <h1 class="heading-primary">
                                <?php echo "$module_code | $module_name"; ?>
                            </h1>
                            <div class="search-box">
                                <input type="text" name="search" id="search-input" placeholder="Find ..." autocomplete="off" spellcheck="false">
                                <div class="search-button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>

                        <form action="" class="mark-entry" method="post" autocomplete="off">
                            <table class="marks_entry" id="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Student Name</th>
                                        <th>Marks</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    if (mysqli_num_rows($select_users_query) != 0) {
                                        while ($row = mysqli_fetch_assoc($select_users_query)) {
                                            $user_id = $row['user_id'];
                                            $user_full_name = $row['user_full_name'];

                                            // Query to retrieve the result score for the current student and module
                                            $result_query = "SELECT * FROM results WHERE user_id='$user_id' AND module_id = '$module_id'";
                                            $select_result_query = mysqli_query($connection, $result_query);
                                            $result_row = mysqli_fetch_assoc($select_result_query);

                                    ?>
                                    
                                    <tr>
                                        <td data-cell="no."><?php echo $numbering++; ?></td>
                                        <td data-cell="student name"><?php echo $user_full_name; ?></td>
                                        <td data-cell="module score"><input type='number' name='marks[<?php echo $user_id; ?>]' min='0' max='100' value='<?php echo isset($result_row) ? $result_row['result_score'] : ''; ?>' /></td>
                                        </td>
                                    </tr>

                                    <?php
                                            }
                                        } else {
                                            echo "<tr>";
                                            echo "<td colspan='3'><p style='text-align: center;'>No records found</p></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <?php
                            if (isset($select_users_query) && mysqli_num_rows($select_users_query) != 0) {
                            ?>
                                <input type="hidden" name="module_code" value="<?php echo $module_code; ?>">
                                <input type="submit" name="save_marks" class="module-btn" value="Save Marks" />
                            <?php
                            }
                            ?>
                        </form>
                    </section>
                </main>
            </div>
        </div>
    </body>
</html>
