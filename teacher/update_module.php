<?php include "../includes/db.php"; ?>
<?php include "../includes/teacher-session.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

if(isset($_GET['module_id'])) {
    $module_id = escape($_GET['module_id']);
}

$query = "SELECT * FROM modules WHERE module_id='$module_id'";
$module_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($module_query)) {
    $module_id = $row['module_id'];
    $module_programme = $row['module_programme'];
    $module_code = $row['module_code'];
    $module_name = $row['module_name'];
}

// CRUD 3: UPDATE EXISTING COURSES
if(isset($_POST['moduleoperation'])) {
    $module_programme = escape($_POST['module_programme']);
    $module_code = escape($_POST['module_code']);
    $module_name = escape($_POST['module_name']);

    if (!empty($module_programme) && !empty($module_code) && !empty($module_name)) {
        $query = "UPDATE modules SET module_programme='$module_programme', module_code='$module_code', module_name='$module_name' WHERE module_id='$module_id'";
        $update_module_query = mysqli_query($connection, $query);
        if ($update_module_query){
            echo "<script>alert('The module has been updated successfully.');window.location='course_teacher.php'</script>";
        } else {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    } else {
            echo '<script>alert("Field(s) cannot be empty.")</script>';
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

        <title>Teacher Update Module | EduTrack</title>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="modules">
                        <a href="javascript:history.back()" class="back-link">Go Back</a>
                        <h2 class="heading-secondary">Modules Update</h2>
                        <div class="module__form-box">
                            <form class="module-form" action="" method="post" autocomplete="off"> 
                                <div class="form-group">
                                    <div class="form-row form-row-1">
                                        <label for="module_programme" class="module__form-label">Pre-U Programmes</label>
                                        <select name="module_programme" id="module_programme" required>
                                            <option value="" selected disabled>Programme to add the module</option>
                                            <option value="Foundation in Arts" <?php if($module_programme == "Foundation in Arts") echo 'selected="selected"'; ?>>Foundation in Arts</option>
                                            <option value="Foundation in Business" <?php if($module_programme == "Foundation in Business") echo 'selected="selected"'; ?>>
                                                Foundation in Business
                                            </option>
                                            <option value="Foundation in Computing" <?php if($module_programme == "Foundation in Computing") echo 'selected="selected"'; ?>>
                                                Foundation in Computing
                                            </option>
                                            <option value="Foundation in Design" <?php if($module_programme == "Foundation in Design") echo 'selected="selected"'; ?>>
                                                Foundation in Design
                                            </option>
                                            <option value="Foundation in Engineering" <?php if($module_programme == "Foundation in Engineering") echo 'selected="selected"'; ?>>
                                                Foundation in Engineering
                                            </option>
                                            <option value="Foundation in Science" <?php if($module_programme == "Foundation in Science") echo 'selected="selected"'; ?>>
                                                Foundation in Science
                                            </option>
                                            <option value="Cambridge A Level" <?php if($module_programme == "Cambridge A Level") echo 'selected="selected"'; ?>>
                                                Cambridge A Level
                                            </option>
                                            <option value="SACE International" <?php if($module_programme == "SACE International") echo 'selected="selected"'; ?>>SACE International</option>
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
                                            value="<?php if (isset($module_code)) {echo $module_code; } ?>"
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
                                        value="<?php if (isset($module_name)) {echo $module_name; } ?>"
                                        oninput="capitalizeModuleName()"
                                        required
                                    />
                                </div>

                                <div class="form-row">
                                    <input
                                        type="submit"
                                        name="moduleoperation"
                                        class="module-btn"
                                        value="Update Module"
                                    />
                                </div>
                            </form>
                        </div>
                    </section>
                </main>
            </div>
        </div>

        <script src="../js/course-module.js"></script>
    </body>
</html>
