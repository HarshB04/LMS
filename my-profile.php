<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (empty($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}
$msg = '';
$error = '';
if (isset($_POST['update'])) {
    $sid      = $_SESSION['stdid'];
    $fname    = trim($_POST['fullanme']);
    $mobileno = trim($_POST['mobileno']);
    $sql = "UPDATE tblstudents SET FullName=:fname, MobileNumber=:mobileno WHERE StudentId=:sid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid',      $sid,      PDO::PARAM_STR);
    $query->bindParam(':fname',    $fname,    PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query->execute();
    $msg = "Your profile has been updated successfully.";
}
$sid = $_SESSION['stdid'];
$sql = "SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status FROM tblstudents WHERE StudentId=:sid";
$q = $dbh->prepare($sql);
$q->bindParam(':sid', $sid, PDO::PARAM_STR);
$q->execute();
$result = $q->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online Library Management System | My Profile</title>
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
                    <h4 class="header-line">My Profile</h4>
                </div>
            </div>
            <?php if ($msg): ?><div class="alert alert-success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white fw-bold">My Profile</div>
                        <div class="card-body">
                            <?php if ($result): ?>
                                <form method="post">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Student ID</label>
                                        <p class="form-control-plaintext"><?= htmlspecialchars($result->StudentId) ?></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Registration Date</label>
                                        <p class="form-control-plaintext"><?= htmlspecialchars($result->RegDate) ?></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Profile Status</label>
                                        <p class="form-control-plaintext">
                                            <?php if ($result->Status == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Blocked</span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input class="form-control" type="text" name="fullanme" value="<?= htmlspecialchars($result->FullName) ?>" required autocomplete="off" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mobile Number</label>
                                        <input class="form-control" type="text" name="mobileno" maxlength="10" value="<?= htmlspecialchars($result->MobileNumber) ?>" required autocomplete="off" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input class="form-control" type="email" value="<?= htmlspecialchars($result->EmailId) ?>" readonly />
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                                </form>
                            <?php else: ?>
                                <p class="text-danger">Profile not found.</p>
                            <?php endif; ?>
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