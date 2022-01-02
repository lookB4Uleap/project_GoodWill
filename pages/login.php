<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        body {
            background-image: url("https://loremflickr.com/1080/1080/food");
            background-size: cover;
        }
    </style>
    <title>Login</title>
</head>
<body style="display: flex; justify-content: center; align-items: center;">
    
        <header class="Login-Header">LOGIN</header>
        <form action="login.php" method="post" class="Form-Container">
            <!-- <section><div>SIGN IN TO ORDER FOOD</div></section> -->
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="login-id" placeholder="Enter login id" name="login-id" required>
                <label for="login-id">Login ID</label>
            </div>
              
            <div class="form-floating mt-3 mb-3">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass" required>
                <label for="pwd">Password</label>
            </div>

            <div class="Button-Group btn-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dont have an account? Sign up!!"
                    onclick="window.location.replace('/pages/signup.php')"
                >SIGN UP</button>
                <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sign in to order food!!">SIGN IN</button>
            </div>
            <script>
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                  return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            </script>
        </form>
    <?php 
        include "../data.php";
        $db = new DataDB("../data.db");
        if ($_POST['login-id'] && $_POST['pass']) {

        $user = $db->validateUser($_POST['login-id'], $_POST['pass']);
        if (!$user)
            echo "<script>alert('Login ID and/or Password is invalid. Please try again.')</script>";
        else {
            session_start();
            $_SESSION['uid'] = $user;
            // header("Location: /ResApp/pages/");
            header("Location: /pages/");
        }
        }
            
    ?>
</body>

</html>