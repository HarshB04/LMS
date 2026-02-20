<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

$msg = '';
$error = '';
if (isset($_POST['change'])) {
  // Captcha verification
  if (empty($_POST['vercode']) || $_POST['vercode'] != $_SESSION['vercode']) {
    $error = "Incorrect verification code. Please try again.";
  } elseif ($_POST['newpassword'] !== $_POST['confirmpassword']) {
    $error = "New password and confirm password do not match.";
  } else {
    $email    = trim($_POST['email']);
    $mobile   = trim($_POST['mobile']);
    $newpassword = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);

    $sql = "SELECT EmailId FROM tblstudents WHERE EmailId=:email AND MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email',  $email,  PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
      $con = "UPDATE tblstudents SET Password=:newpassword WHERE EmailId=:email AND MobileNumber=:mobile";
      $chngpwd = $dbh->prepare($con);
      $chngpwd->bindParam(':email',       $email,       PDO::PARAM_STR);
      $chngpwd->bindParam(':mobile',      $mobile,      PDO::PARAM_STR);
      $chngpwd->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd->execute();
      $msg = "Your password has been successfully changed. <a href='index.php'>Login now</a>";
      unset($_SESSION['vercode']);
    } else {
      $error = "Email address or mobile number is invalid.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Online Library Management System | Password Recovery</title>
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
          <h4 class="header-line">User Password Recovery</h4>
        </div>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php elseif ($msg): ?>
        <div class="alert alert-success"><?= $msg ?></div>
      <?php endif; ?>

      <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-12">
          <div class="card border-info">
            <div class="card-header bg-info text-white fw-bold">Password Recovery</div>
            <div class="card-body">
              <form id="chngpwd" name="chngpwd" method="post">
                <div class="mb-3">
                  <label class="form-label">Registered Email</label>
                  <input class="form-control" type="email" name="email" required autocomplete="off" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Registered Mobile Number</label>
                  <input class="form-control" type="text" name="mobile" required autocomplete="off" />
                </div>
                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input class="form-control" type="password" name="newpassword" id="newpassword" required autocomplete="off" minlength="6" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" required autocomplete="off" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Verification Code</label>
                  <div class="d-flex align-items-center gap-2">
                    <input type="text" class="form-control" name="vercode" maxlength="5" autocomplete="off" required style="max-width:130px;" />
                    <img src="captcha.php" alt="CAPTCHA" class="rounded" />
                  </div>
                </div>
                <button type="submit" name="change" class="btn btn-info text-white">Change Password</button>
                &nbsp;<a href="index.php" class="btn btn-outline-secondary btn-sm">Back to Login</a>
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