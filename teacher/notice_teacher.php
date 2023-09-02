<?php include "../includes/db.php"; ?>
<?php include "../includes/teacher-session.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

// CRUD 1: CREATE NEW NOTICES
if(isset($_POST['noticeoperation'])) {
    $notice_date = escape($_POST['notice_date']);
    $notice_title = escape($_POST['notice_title']);
    $notice_content = escape($_POST['notice_content']);

    if (!empty($notice_date) && !empty($notice_title) && !empty($notice_content)) {
        $query = "INSERT INTO notices (notice_date, notice_title, notice_content) VALUES ('$notice_date', '$notice_title', '$notice_content')";

        $add_notice_query = mysqli_query($connection, $query);
        if ($add_notice_query){
            echo "<script>alert('The notice has been added successfully.');window.location='notice_teacher.php'</script>";
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

        <title>Teacher Notice | EduTrack</title>

        <script src="../js/search.js"></script>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="notices">
                        <h2 class="heading-secondary">Notice Details</h2>
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
                                    /></textarea>
                                </div>

                                <div class="form-row">
                                    <input
                                        type="submit"
                                        name="noticeoperation"
                                        class="notice-btn"
                                        value="Add Notice"
                                    />
                                </div>
                            </form>
                        </div>

                        <div class="heading-search-box">
                            <h1 class="heading-primary">
                                Existing Notices
                            </h1>
                            <div class="search-box">
                                <input type="text" name="search" id="search-input" placeholder="Find notices ..." autocomplete="off" spellcheck="false">
                                <div class="search-button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>

                        <table class="notices__table" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                // CRUD 2: READ ALL NOTICES
                                $numbering = 1;

                                $query = "SELECT * FROM notices ORDER BY notice_date DESC";
                                $select_notices_query = mysqli_query($connection, $query);

                                if (mysqli_num_rows($select_notices_query) > 0) {
                                    while ($row = mysqli_fetch_assoc($select_notices_query)) {
                                        $notice_id = $row['notice_id'];
                                        $notice_date = $row['notice_date'];
                                        $notice_title = $row['notice_title'];
                                        $notice_content = $row['notice_content'];

                                ?>

                                <tr>
                                    <td data-cell="no."><?php echo $numbering++; ?></td>
                                    <td data-cell="notice date"><?php echo $notice_date; ?></td>
                                    <td data-cell="notice title"><?php echo $notice_title; ?></td>
                                    <td data-cell="notice content"><?php echo $notice_content; ?></td>
                                    <td data-cell="notice operation">
                                        <a href="update_notice.php?notice_id=<?php echo $notice_id; ?>" class="notices__operation update-operation"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="notice_teacher.php?notice_id=<?php echo $notice_id; ?>" class="notices__operation delete-operation" onclick="return confirm('Are you sure you want to delete this notice?')"><i class='fa-solid fa-trash'></i></a>
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

                                // CRUD 4: DELETE EXISTING NOTICES
                                if(isset($_GET['notice_id'])) {
                                    if (isset($_SESSION['user_role'])) {
                                        if ($_SESSION['user_role'] == 'teacher') {
                                            $notice_id = escape($_GET['notice_id']);
                            
                                            $query = "DELETE FROM notices WHERE notice_id='$notice_id'";
                                            $delete_notice_query = mysqli_query($connection, $query);
                            
                                            header('Location: notice_teacher.php');
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
    </body>
</html>
