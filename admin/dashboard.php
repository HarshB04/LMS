<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if (empty($_SESSION['alogin'])) {
  header('Location: index.php');
  exit();
}

// Dashboard stats using COUNT(*)
$stats = [];
foreach (
  [
    'listdbooks'   => "SELECT COUNT(id) FROM tblbooks",
    'issuedbooks'  => "SELECT COUNT(id) FROM tblissuedbookdetails",
    'returnedbooks' => "SELECT COUNT(id) FROM tblissuedbookdetails WHERE ReturnStatus=1",
    'regstds'      => "SELECT COUNT(id) FROM tblstudents",
    'listdathrs'   => "SELECT COUNT(id) FROM tblauthors",
    'listdcats'    => "SELECT COUNT(id) FROM tblcategory",
  ] as $key => $sql
) {
  $stats[$key] = $dbh->query($sql)->fetchColumn();
}
$fineRow = $dbh->query("SELECT fine FROM tblfine LIMIT 1")->fetch(PDO::FETCH_OBJ);
$fine = $fineRow ? $fineRow->fine : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Online Library Management System | Admin Dashboard</title>
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
          <h4 class="header-line">Admin Dashboard</h4>
        </div>
      </div>

      <!-- Row 1: Books & Issues -->
      <div class="row g-3 mb-3">
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-success text-center mb-0 py-4">
            <i class="fa fa-book fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= $stats['listdbooks'] ?></h3>
            <span>Books Listed</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-info text-center mb-0 py-4">
            <i class="fa fa-bars fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= $stats['issuedbooks'] ?></h3>
            <span>Times Book Issued</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-warning text-center mb-0 py-4">
            <i class="fa fa-rotate fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= $stats['returnedbooks'] ?></h3>
            <span>Times Books Returned</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-danger text-center mb-0 py-4">
            <i class="fa fa-users fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= $stats['regstds'] ?></h3>
            <span>Registered Users</span>
          </div>
        </div>
      </div>

      <!-- Row 2: Authors, Categories, Fine -->
      <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-success text-center mb-0 py-4">
            <i class="fa fa-user fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= $stats['listdathrs'] ?></h3>
            <span>Publications Listed</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-info text-center mb-0 py-4">
            <i class="fa fa-folder-open fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= $stats['listdcats'] ?></h3>
            <span>Listed Categories</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="alert alert-info text-center mb-0 py-4">
            <i class="fa fa-indian-rupee-sign fa-4x mb-2"></i>
            <h3 class="fw-bold"><?= htmlentities($fine) ?></h3>
            <span>Current Fine/Day (Rs)</span>
          </div>
        </div>
      </div>

      <!-- Bootstrap 5 Carousel -->
      <div class="row mb-4">
        <div class="col-md-10 offset-md-1">
          <div id="libraryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#libraryCarousel" data-bs-slide-to="0" class="active"></button>
              <button type="button" data-bs-target="#libraryCarousel" data-bs-slide-to="1"></button>
              <button type="button" data-bs-target="#libraryCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner rounded">
              <div class="carousel-item active">
                <img src="assets/img/1.jpg" class="d-block w-100" alt="Library 1" />
              </div>
              <div class="carousel-item">
                <img src="assets/img/2.jpg" class="d-block w-100" alt="Library 2" />
              </div>
              <div class="carousel-item">
                <img src="assets/img/3.jpg" class="d-block w-100" alt="Library 3" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#libraryCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#libraryCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
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