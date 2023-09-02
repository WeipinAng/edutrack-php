<?php include "../includes/db.php"; ?>
<?php include "../includes/teacher-session.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

// CRUD 1: CREATE NEW COURSES
if(isset($_POST['moduleoperation'])) {
    $module_programme = escape($_POST['module_programme']);
    $module_code = escape($_POST['module_code']);
    $module_name = escape($_POST['module_name']);

    $query = "SELECT * FROM modules WHERE module_code='$module_code' OR module_name='$module_name'";
    $check_existing_module_query = mysqli_query($connection, $query);
    confirm_query($check_existing_module_query);

    if (mysqli_num_rows($check_existing_module_query) != 0) {
        echo "<script>alert('The module code or module name has already been registered previously.');window.location='course_teacher.php'</script>";
    } else {
        if (!empty($module_programme) && !empty($module_code) && !empty($module_name)) {
            $query = "INSERT INTO modules (module_programme, module_code, module_name) VALUES ('$module_programme', '$module_code', '$module_name')";
    
            $add_module_query = mysqli_query($connection, $query);
            if ($add_module_query){
                echo "<script>alert('The module has been added successfully.');window.location='course_teacher.php'</script>";
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

        <style> <?php include "../css/header.css"; ?> </style>
        <link rel="stylesheet" href="../css/course-teacher.css" />

        <title>Teacher Course | EduTrack</title>

        <script src="../js/search.js"></script>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="modules">
                        <h2 class="heading-secondary">Modules Add</h2>
                        <div class="module__form-box">
                            <form class="module-form" action="" method="post" autocomplete="off"> 
                                <div class="form-group">
                                    <div class="form-row form-row-1">
                                        <label for="module_programme" class="module__form-label">Pre-U Programmes</label>
                                        <select name="module_programme" id="module_programme" required>
                                            <option value="" selected disabled>Programme to add the module</option>
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
                                    </div>

                                    <div class="form-row form-row-2">
                                        <label for="module_code" class="module__form-label">Module Code (3 letters followed by 5 digits, Example: ABC12345)</label>
                                        <input
                                            type="text"
                                            name="module_code"
                                            class="module_code"
                                            id="module_code"
                                            maxlength="8"
                                            oninput="this.value = this.value.toUpperCase();"
                                            onblur="validateModuleCode()"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="module_name" class="module__form-label">Module Name</label>
                                    <input
                                        type="text"
                                        name="module_name"
                                        class="module_name"
                                        id="module_name"
                                        oninput="capitalizeModuleName()"
                                        required
                                    />
                                </div>

                                <div class="form-row">
                                    <input
                                        type="submit"
                                        name="moduleoperation"
                                        class="module-btn"
                                        value="Add Module"
                                    />
                                </div>
                            </form>
                        </div>

                        <div class="heading-search-box">
                            <h1 class="heading-primary">
                                Existing Modules
                            </h1>
                            <div class="search-box">
                                <input type="text" name="search" id="search-input" placeholder="Find courses ..." autocomplete="off" spellcheck="false">
                                <div class="search-button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>

                        <table class="modules__table" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Module Code</th>
                                    <th>Module Name</th>
                                    <th>Programme</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                // CRUD 2: READ ALL COURSES
                                $numbering = 1;

                                $query = "SELECT * FROM modules ORDER BY module_name ASC";
                                $select_modules_query = mysqli_query($connection, $query);

                                if (mysqli_num_rows($select_modules_query) > 0) {
                                    while ($row = mysqli_fetch_assoc($select_modules_query)) {
                                        $module_id = $row['module_id'];
                                        $module_programme = $row['module_programme'];
                                        $module_code = $row['module_code'];
                                        $module_name = $row['module_name'];

                                ?>

                                <tr>
                                    <td data-cell="no."><?php echo $numbering++; ?></td>
                                    <td data-cell="module code"><?php echo $module_code; ?></td>
                                    <td data-cell="module name"><?php echo $module_name; ?></td>
                                    <td data-cell="module programme"><?php echo $module_programme; ?></td>
                                    <td data-cell="module operation">
                                        <a href="update_module.php?module_id=<?php echo $module_id; ?>" class="modules__operation update-operation"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="course_teacher.php?module_id=<?php echo $module_id; ?>" class="modules__operation delete-operation" onclick="return confirm('Are you sure you want to delete this module?')"><i class='fa-solid fa-trash'></i></a>
                                    </td>
                                </tr>

                                <?php
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='5'><p style='text-align: center;'>No records found</p></td>";
                                    echo "</tr>";
                                }
                                ?>

                                <?php

                                // CRUD 4: DELETE EXISTING COURSES
                                if(isset($_GET['module_id'])) {
                                    if (isset($_SESSION['user_role'])) {
                                        if ($_SESSION['user_role'] == 'teacher') {
                                            $module_id = escape($_GET['module_id']);
                            
                                            $query = "DELETE FROM modules WHERE module_id='$module_id'";
                                            $delete_module_query = mysqli_query($connection, $query);
                            
                                            header('Location: course_teacher.php');
                                        }
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </section>
                </main>
            </div>
        </div>

        <script src="../js/course-module.js"></script>
    </body>
</html>
