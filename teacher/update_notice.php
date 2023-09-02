<?php include "../includes/db.php"; ?>
<?php include "../includes/teacher-session.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

if(isset($_GET['notice_id'])) {
    $notice_id = escape($_GET['notice_id']);
}

$query = "SELECT * FROM notices WHERE notice_id='$notice_id'";
$notice_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($notice_query)) {
    $notice_id = $row['notice_id'];
    $notice_date = $row['notice_date'];
    $notice_title = $row['notice_title'];
    $notice_content = $row['notice_content'];
}

// CRUD 3: UPDATE EXISTING NOTICES
if(isset($_POST['noticeoperation'])) {
    $notice_date = escape($_POST['notice_date']);
    $notice_title = escape($_POST['notice_title']);
    $notice_content = escape($_POST['notice_content']);

    if (!empty($notice_date) && !empty($notice_title) && !empty($notice_content)) {
        $query = "UPDATE notices SET notice_date='$notice_date', notice_title='$notice_title', notice_content='$notice_content' WHERE notice_id='$notice_id'";
        $update_notice_query = mysqli_query($connection, $query);
        if ($update_notice_query){
            echo "<script>alert('The notice has been updated successfully.');window.location='notice_teacher.php'</script>";
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
        <link rel="stylesheet" href="../css/notice-both.css" />

        <title>Teacher Update Notice | EduTrack</title>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="notices">
                        <a href="javascript:history.back()" class="back-link">Go Back</a>
                        <h2 class="heading-secondary">Notices Update</h2>
                        <div class="notice__form-box">
                            <form class="notice-form" action="" method="post" autocomplete="off"> 
                                <div class="form-group">
                                    <div class="form-row form-row-1">
                                        <label for="notice_date" class="notice__form-label">Posted Date</label>
                                        <input
                                            type="date"
                                            name="notice_date"
                                            class="notice_date"
                                            id="notice_date"
                                            value="<?php echo date('Y-m-d');?>"
                                            readonly
                                            required
                                        />
                                    </div>

                                    <div class="form-row form-row-2">
                                        <label for="notice_title" class="notice__form-label">Notice Title</label>
                                        <input
                                            type="text"
                                            name="notice_title"
                                            class="notice_title"
                                            id="notice_title"
                                            value="<?php if (isset($notice_title)) {echo $notice_title; } ?>"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="notice_content" class="notice__form-label">Notice Content</label>
                                    <textarea
                                        rows="8"
                                        name="notice_content"
                                        class="notice_content"
                                        id="notice_content"
                                        required
                                    /><?php if (isset($notice_content)) {echo $notice_content; } ?></textarea>
                                </div>

                                <div class="form-row">
                                    <input
                                        type="submit"
                                        name="noticeoperation"
                                        class="notice-btn"
                                        value="Update Notice"
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
