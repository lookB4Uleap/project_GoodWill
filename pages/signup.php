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
        .Form-Container {
            display: flex;
            align_items: center;
            justify_content: center;
            height: auto;
            max-height: none;
        }
    </style>
    <title>Sign Up</title>
</head>
<body style="display: flex; justify-content: center; align-items: center;">
    
        <header class="Login-Header">CREATE AN ACCOUNT</header>
        <form action="signup.php" method="post" class="Form-Container">
            <!-- <section><div>SIGN IN TO ORDER FOOD</div></section> -->
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="name" placeholder="Enter full name" name="name" required>
                <label for="name">Name</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" required>
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="phno" placeholder="Enter phone no" name="phno" required>
                <label for="phno">Phone Number</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                    <textarea type="text" class="form-control" id="addr" name="addr" maxlength="150" col="30" rows="10"></textarea>
                    <label for="addr">Address</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="login-id" placeholder="Enter login id" name="login-id" required>
                <label for="login-id">Login ID</label>
            </div>
              
            <div class="form-floating mt-3 mb-3">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass" required>
                <label for="pwd">Password</label>
            </div>

            <div class="Button-Group btn-group">
                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="create an account">SIGN UP</button>
                <button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Have an account? Sign In Now!!" 
                    onclick="window.location.replace('/pages/login.php')"
                >SIGN IN</button>
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
        include "../user_data.php";
        $db = new DataDB("../data.db");
        $user_db = new UserDataDB("../user_data.db");
        // echo json_encode($_POST);
        if (!empty($_POST)) {
        $created = $db->registerUser($_POST['name'], $_POST['email'], $_POST['phno'], $_POST['login-id'], $_POST['pass'], $_POST['addr']);
        
        // create user cart on account creation
        // $user_db->createUserCart($user);       
        $user = $db->validateUser($_POST['login-id'], $_POST['pass']);
        session_start();
        $_SESSION['uid'] = $user;
        $user_db->createUserCart($user);
        header("Location: /ResApp/pages/");
        header("Location: /pages/");
        }
            
    ?>
</body>

</html>