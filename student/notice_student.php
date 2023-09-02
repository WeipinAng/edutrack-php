<?php include "../includes/db.php"; ?>
<?php include "../includes/student-session.php"; ?>
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
        <link rel="stylesheet" href="../css/notice-both.css" />

        <title>Student Notice | EduTrack</title>

        <script src="../js/search.js"></script>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/student-sidebar.php"; ?>

                <main class="content">
                    <section class="notices">
                        <div class="heading-search-box">
                            <h1 class="heading-primary">
                               All Notices
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
                                </tr>
                            </thead>

                            <tbody>
                                <?php

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
