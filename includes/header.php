<header class="header">
    <div class="header__title-box">
        <img
            src="../img/dashboard-logo.png"
            alt="EduTrack Logo"
            class="header__logo"
        />
        <span class="header__title">EduTrack</span>
    </div>

    <div class="hoverable-dropdown">
        <div class="user-nav__user">
            <img
                src="../img/profile-pic.jpg"
                alt="User photo"
                class="user-nav__user-photo"
            />
            <span class="user-nav__user-name"><?php echo ucfirst($_SESSION['user_full_name']); ?></span>
        </div>

        <div class="user-nav__float-menu">
            <a href="../logout.php" class="user-nav__link"
                >Log out &nbsp;
                <i
                    class="fa-solid fa-right-to-bracket user-nav__icon"
                ></i
            ></a>

            <a href="<?php echo $_SESSION['user_role'] == 'teacher' ? 'profile_teacher.php' : 'profile_student.php'; ?>" class="user-nav__link"
                >View Profile</a
            >
        </div>
    </div>
</header>