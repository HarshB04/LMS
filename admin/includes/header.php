<?php // admin/includes/header.php — Bootstrap 5 
?>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <img src="assets/img/logo.png" alt="Library Logo" height="40" />
        </a>
        <a href="logout.php" class="btn btn-danger btn-sm ms-auto">LOG ME OUT</a>
    </div>
</nav>

<section class="menu-section">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mt-1">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminTopNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminTopNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="dashboard.php" class="nav-link fw-semibold">DASHBOARD</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="catDrop" data-bs-toggle="dropdown">Categories</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add-category.php">Add Category</a></li>
                            <li><a class="dropdown-item" href="manage-categories.php">Manage Categories</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pubDrop" data-bs-toggle="dropdown">Publications</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add-publications.php">Add Publications</a></li>
                            <li><a class="dropdown-item" href="manage-publications.php">Manage Publications</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="bookDrop" data-bs-toggle="dropdown">Books</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="add-book.php">Add Book</a></li>
                            <li><a class="dropdown-item" href="manage-books.php">Manage Books</a></li>
                            <li><a class="dropdown-item" href="set-fine.php">Update Fine</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="issueDrop" data-bs-toggle="dropdown">Issue Books</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="issue-book.php">Issue New Book</a></li>
                            <li><a class="dropdown-item" href="manage-issued-books.php">Manage Issued Books</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a href="manage-requested-books.php" class="nav-link">Requested Books</a></li>
                    <li class="nav-item"><a href="report.php" class="nav-link">Report</a></li>
                    <li class="nav-item"><a href="reg-students.php" class="nav-link">Students</a></li>
                    <li class="nav-item"><a href="change-password.php" class="nav-link">Change Password</a></li>
                </ul>
            </div>
        </nav>
    </div>
</section>
