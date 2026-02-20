<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if (empty($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

// Load available books
$sql = "SELECT tblbooks.BookName, tblbooks.Copies, tblbooks.IssuedCopies,
               tblcategory.CategoryName, tblauthors.AuthorName,
               tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.id as bookid
        FROM tblbooks
        JOIN tblcategory ON tblcategory.id = tblbooks.CatId
        JOIN tblauthors  ON tblauthors.id  = tblbooks.AuthorId";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online Library Management System | Request a Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container mt-4">
            <div class="row mb-3">
                <div class="col-12">
                    <h4 class="header-line">Request a Book</h4>
                </div>
            </div>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']);
                                                $_SESSION['error'] = ''; ?></div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['msg'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['msg']);
                                                    $_SESSION['msg'] = ''; ?></div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['delmsg'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['delmsg']);
                                                    $_SESSION['delmsg'] = ''; ?></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header fw-bold">Available Books</div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover mb-0" id="dataTables-example">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>ISBN</th>
                                            <th>Price (Rs)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cnt = 1;
                                        $found = false;
                                        foreach ($results as $result):
                                            if ($result->Copies > $result->IssuedCopies):
                                                $found = true;
                                        ?>
                                                <tr>
                                                    <td><?= $cnt++ ?></td>
                                                    <td><?= htmlspecialchars($result->BookName) ?></td>
                                                    <td><?= htmlspecialchars($result->CategoryName) ?></td>
                                                    <td><?= htmlspecialchars($result->AuthorName) ?></td>
                                                    <td><?= htmlspecialchars($result->ISBNNumber) ?></td>
                                                    <td><?= htmlspecialchars($result->BookPrice) ?></td>
                                                    <td>
                                                        <a href="temp.php?ISBNNumber=<?= urlencode($result->ISBNNumber) ?>&BookName=<?= urlencode($result->BookName) ?>&AuthorName=<?= urlencode($result->AuthorName) ?>&CategoryName=<?= urlencode($result->CategoryName) ?>&BookPrice=<?= urlencode($result->BookPrice) ?>&StudName=<?= urlencode($_SESSION['username']) ?>&StudentID=<?= urlencode($_SESSION['stdid']) ?>" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-hand-pointer"></i> Request
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endif;
                                        endforeach;
                                        if (!$found): ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No available books found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>