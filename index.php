<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mdb.min.css">
    <title>Election</title>
</head>

<body>
    <div class="row mt-5">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="text-center">
                <h4 class="font-weight-bold text-success">National Democratic Congress</h4>
                <h5 class="font-weight-bold text-danger">Election Collation System</h5>
                <h5 class="font-weight-bold mt-3">SYSTEM LOGIN</h5>
            </div>
            <div class="card card-body mt-3">
                <form id="login" action="login.php" method="POST" autocomplete="off">
                    <div class="form-outline mb-3">
                        <input type="text" id="username" name="username" class="form-control" required />
                        <label class="form-label">Username</label>
                    </div>
                    <div class="form-outline">
                        <input type="password" id="password" name="password" class="form-control" required />
                        <label class="form-label">Password</label>
                    </div>
                    <input type="hidden" value="<?= $_SESSION['_token']; ?>" name="token" id="token">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-md btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/mdb.min.js"></script>

</html>