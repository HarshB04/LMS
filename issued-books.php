<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if (empty($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}
$sid = $_SESSION['stdid'];
$sql = "SELECT tblbooks.BookName, tblbooks.ISBNNumber,
               tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate,
               tblissuedbookdetails.fine
        FROM tblissuedbookdetails
        JOIN tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentID
        JOIN tblbooks ON tblbooks.id = tblissuedbookdetails.BookId
        WHERE tblstudents.StudentId = :sid
        ORDER BY tblissuedbookdetails.id DESC";
$query = $dbh->prepare($sql);
$query->bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online Library Management System | My Issued Books</title>
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
                    <h4 class="header-line">My Issued Books</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header fw-bold">Issued Books</div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover mb-0" id="dataTables-example">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>ISBN</th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                            <th>Fine (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($results): $cnt = 1;
                                            foreach ($results as $result): ?>
                                                <tr>
                                                    <td><?= $cnt++ ?></td>
                                                    <td><?= htmlspecialchars($result->BookName) ?></td>
                                                    <td><?= htmlspecialchars($result->ISBNNumber) ?></td>
                                                    <td><?= htmlspecialchars($result->IssuesDate) ?></td>
                                                    <td>
                                                        <?php if (empty($result->ReturnDate)): ?>
                                                            <span class="badge bg-danger">Not Returned Yet</span>
                                                        <?php else: ?>
                                                            <?= htmlspecialchars($result->ReturnDate) ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($result->fine ?? '—') ?></td>
                                                </tr>
                                            <?php endforeach;
                                        else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No issued books found.</td>
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