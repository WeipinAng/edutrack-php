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
        <link rel="stylesheet" href="../css/index-both.css" />

        <title>Teacher Dashboard | EduTrack</title>
    </head>
    <body>
        <div class="container">
            <?php include "../includes/header.php"; ?>

            <div class="dashboard">
                <?php include "../includes/teacher-sidebar.php"; ?>

                <main class="content">
                    <section class="hero">
                        <p class="hero__title">Overview</p>
                        <h1 class="heading-primary">Welcome, <?php echo ucfirst($_SESSION['user_full_name']) ?></h1>
                        <p class="hero__date"></p>

                        <div class="hero__info-box">
                            <div class="hero__course">
                                <h2 class="heading-secondary">Modules Entry</h2>
                                <a
                                    href="course_teacher.php"
                                    class="hero__detail-link"
                                    >View Details &rarr;</a
                                >
                                <i class="fa-solid fa-book hero__icon"></i>
                            </div>
                            <div class="hero__result">
                                <h2 class="heading-secondary">Result Entry</h2>
                                <a
                                    href="result_teacher.php"
                                    class="hero__detail-link"
                                    >View Details &rarr;</a
                                >
                                <i
                                    class="fa-solid fa-square-poll-vertical hero__icon"
                                ></i>
                            </div>
                            <div class="hero__attendance">
                                <h2 class="heading-secondary">Notices Entry</h2>
                                <a
                                    href="notice_teacher.php"
                                    class="hero__detail-link"
                                    >View Details &rarr;</a
                                >
                                <i
                                    class="fa-solid fa-note-sticky hero__icon"
                                ></i>
                            </div>
                        </div>

                        <div class="hero__profile">
                            <h2 class="heading-secondary">Profile</h2>
                            <a
                                href="profile_teacher.php"
                                class="hero__detail-link"
                                >View Details &rarr;</a
                            >
                            <i class="fa-solid fa-user hero__icon"></i>
                        </div>
                    </section>
                </main>
            </div>
        </div>

        <script src="../js/date.js"></script>
    </body>
</html>
