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

// Dashboard stats
$q1 = $dbh->prepare("SELECT COUNT(id) AS total FROM tblissuedbookdetails WHERE StudentID=:sid");
$q1->bindParam(':sid', $sid, PDO::PARAM_STR);
$q1->execute();
$issuedbooks = $q1->fetchColumn();

$q2 = $dbh->prepare("SELECT COUNT(id) AS total FROM tblissuedbookdetails WHERE StudentID=:sid AND ReturnStatus=0");
$q2->bindParam(':sid', $sid, PDO::PARAM_STR);
$q2->execute();
$returnedbooks = $q2->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Online Library Management System | Dashboard</title>
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
          <h4 class="header-line">User Dashboard</h4>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-info text-center mb-0 py-4">
            <i class="fa fa-bars fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= htmlentities($issuedbooks) ?></h3>
            <span>Books Issued</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-warning text-center mb-0 py-4">
            <i class="fa fa-rotate fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= htmlentities($returnedbooks) ?></h3>
            <span>Not Returned Yet</span>
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