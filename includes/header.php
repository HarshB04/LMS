<?php
// includes/header.php — Bootstrap 5 compatible
?>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="assets/img/logo.png" alt="Library Logo" height="40" />
        </a>
        <?php if (!empty($_SESSION['login'])): ?>
            <a href="logout.php" class="btn btn-danger btn-sm">LOG ME OUT</a>
        <?php elseif (!empty($_SESSION['alogin'])): ?>
            <a href="logout.php" class="btn btn-danger btn-sm">LOG ME OUT</a>
        <?php endif; ?>
    </div>
</nav>

<?php if (!empty($_SESSION['login'])): ?>
    <!-- Student Navigation -->
    <section class="menu-section">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light bg-light rounded mt-1">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#studentNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="studentNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="dashboard.php" class="nav-link fw-semibold">DASHBOARD</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountMenu" data-bs-toggle="dropdown">Account <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="issued-books.php" class="nav-link">Issued Books</a></li>
                        <li class="nav-item"><a href="request-a-book.php" class="nav-link">Request a Book</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

<?php elseif (!empty($_SESSION['alogin'])): ?>
    <!-- Admin Navigation -->
    <section class="menu-section">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light bg-light rounded mt-1">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="adminNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="dashboard.php" class="nav-link fw-semibold">DASHBOARD</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="booksMenu" data-bs-toggle="dropdown">Books <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add-book.php">Add Book</a></li>
                                <li><a class="dropdown-item" href="manage-books.php">Manage Books</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="catMenu" data-bs-toggle="dropdown">Categories <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add-category.php">Add Category</a></li>
                                <li><a class="dropdown-item" href="manage-categories.php">Manage Categories</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="issueMenu" data-bs-toggle="dropdown">Issue <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="issue-book.php">Issue Book</a></li>
                                <li><a class="dropdown-item" href="manage-issued-books.php">Manage Issued Books</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="reg-students.php" class="nav-link">Students</a></li>
                        <li class="nav-item"><a href="report.php" class="nav-link">Reports</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminAccMenu" data-bs-toggle="dropdown">Account <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

<?php else: ?>
    <!-- Guest Navigation -->
    <section class="menu-section">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light bg-light rounded mt-1">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#guestNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="guestNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="adminlogin.php" class="nav-link">Admin Login</a></li>
                        <li class="nav-item"><a href="signup.php" class="nav-link">User Signup</a></li>
                        <li class="nav-item"><a href="index.php" class="nav-link">User Login</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
<?php endif; ?>