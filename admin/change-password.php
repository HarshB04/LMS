<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_SESSION['alogin'])) {
  header('Location: index.php');
  exit();
}

$msg = '';
$error = '';
if (isset($_POST['change'])) {
  $username = $_SESSION['alogin'];
  $sql = "SELECT Password FROM admin WHERE UserName=:username";
  $query = $dbh->prepare($sql);
  $query->bindParam(':username', $username, PDO::PARAM_STR);
  $query->execute();
  $row = $query->fetch(PDO::FETCH_OBJ);

  if ($row && password_verify($_POST['password'], $row->Password)) {
    if ($_POST['newpassword'] !== $_POST['confirmpassword']) {
      $error = "New password and confirm password do not match.";
    } else {
      $newpassword = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
      $con = "UPDATE admin SET Password=:newpassword WHERE UserName=:username";
      $chngpwd = $dbh->prepare($con);
      $chngpwd->bindParam(':username', $username, PDO::PARAM_STR);
      $chngpwd->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd->execute();
      $msg = "Your password has been successfully changed.";
    }
  } else {
    $error = "Your current password is incorrect.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Online Library Management System | Admin Change Password</title>
  <!-- Bootstrap 5 CSS -->
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
          <h4 class="header-line">Admin Change Password</h4>
        </div>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php elseif ($msg): ?>
        <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>

      <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-12">
          <div class="card border-info">
            <div class="card-header bg-info text-white fw-bold">Change Password</div>
            <div class="card-body">
              <form id="chngpwd" method="post">
                <div class="mb-3">
                  <label class="form-label">Current Password</label>
                  <input class="form-control" type="password" name="password" autocomplete="off" required />
                </div>
                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input class="form-control" type="password" name="newpassword" id="newpassword" autocomplete="off" required minlength="6" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirm New Password</label>
                  <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required />
                </div>
                <button type="submit" name="change" class="btn btn-info text-white">Change Password</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
    document.getElementById('chngpwd').addEventListener('submit', function(e) {
      if (document.getElementById('newpassword').value !== document.getElementById('confirmpassword').value) {
        e.preventDefault();
        alert('New password and confirm password do not match!');
      }
    });
  </script>
</body>

</html>