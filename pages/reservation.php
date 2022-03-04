<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script>
        $(document).ready(() => {
            // console.log($("#hidden").val())
            $("#year").text((new Date()).getFullYear())
            // $("#addr").value = 
        })
    </script>
    <title>Table Reservation</title>
</head>
<body>
    <?php 
        include "../data.php";
        $uid = $_SESSION['uid'];

        // if (empty($_SESSION) || empty($_POST)) {
        //     // header("Location: /ResApp/pages/");
        //     header("Location: /pages/");
        // } 

        $db = new DataDB("../data.db");
        $user_details = $db->getUserFromId($uid);
        // if ($_POST['item_id'])
        // echo "VALID";
        // else 
        // echo "INVALID";
        // echo $_POST['item_quant']; 
    ?>
    <header class="Header">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="/pages/">GoodWill</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="/pages/">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/pages/reservation.php">Table Reservation</a>
                  </li>
                </ul>
                <?php if (!empty($_SESSION)) { ?>
                <a class="Drop-Down d-flex dropdown-toggle" href="#" style="text-decoration: none; color: #f1f1f1;" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="background-color: #f1f1f1;">
                  <li><a class="dropdown-item" href="/pages/cart.php">Cart</a></li>
                  <li><a class="dropdown-item" href="/pages/order-history.php">Order History</a></li>
                  <li><a class="dropdown-item" href="/pages/reservation-history.php">Reservations History</a></li>
                  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
                <?php } ?>
                <?php if (empty($_SESSION)) { ?>
                <div class="d-flex nav-item">
                    <button type="button" class="btn btn-primary rounded-pill" style="width:130px; height:35px" id="login-button">Login</button>
                </div>
                <?php } ?>
              </div>
            </div>
          </nav>
    </header>

    <main class="Confirm-Order">
        
        <div class="Order-Section">
            <h1 >BOOK A TABLE</h1>
            <form action="/make_reservation.php" method="post" id="book-table">
                
                <div class="form-floating mt-3 mb-3" >
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $user_details['user_nm'] ?>">
                    <label for="name">Name</label>
                </div>
                
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $user_details['user_email'] ?>">
                    <label for="email">Email</label>
                </div>

                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="phno" placeholder="Phone Number" name="phno" value="<?php echo $user_details['user_phno'] ?>">
                    <label for="phno">Phone Number</label>
                </div>
                <!-- <button type="submit" class="btn btn-primary rounded-pill" style="width:130px">Place Order</button> -->
            </form>
            <form action="/pages/reservation.php" method="post" class="Reservation-Form">
                <!-- <div class="mb-3 mt-3">
                    <label for="date" class="form-label">Date :</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="mb-3 mt-3">
                    <label for="time" class="form-label">Time :</label>
                    <input type="time" class="form-control" id="time" name="time">
                </div> -->
                <div>
                <label for="date" class="form-label">Date :</label>
                <input type="date"  id="date" name="date" required value="<?php echo $_POST['date'] ?>">
                </div>
                <div>
                <label for="time" class="form-label">Time :</label>
                <input type="time"  id="time" name="time" required value="<?php echo $_POST['time'] ?>">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill" style="width:130px">View Tables</button>
            </form>
            
            <?php
                // if (date('Y-m-d', strtotime($_POST['date'])) <= date('Y-m-d'))
                if (!empty($_POST)) {
            ?>
                <h3>Available Tables</h3>
                <div class="Table-Available">
                    <input type="date" value="<?php echo $_POST['date'] ?>" form="book-table" id="res_date" name="res_date" style="display: none;">
                    <input type="time" value="<?php echo $_POST['time'] ?>" form="book-table" id="res_time" name="res_time" style="display: none;">
                    <?php
                    // Check whether the date and time has already passed or not
                    // echo $_POST['date'];
                    // echo date("H:i", strtotime($_POST['time']));
                    $tables = $db->displayTables($_POST['date'], date("H:i", strtotime($_POST['time'])));
                    for ($i = 0; $i < 20; $i++) {
                        if ($tables[$i] && !empty($_SESSION)) {
                            ?>
                            <button type="submit" class="btn btn-success" name="table_num" form="book-table" value="<?php echo ($i+1) ?>"><?php echo ($i+1) ?></button>
                            <?php
                        }
                        if ($tables[$i] && empty($_SESSION)) {
                            ?>
                            <button type="submit" class="btn btn-success" form="book-table" value="<?php echo ($i+1) ?>" disabled><?php echo ($i+1) ?></button>
                            <?php
                        }
                    }
                    ?>
                </div>
            <?php
                }
            ?>
        </div>
    </main>

    <footer class="Footer">AS &copy 2020-<div id="year"></div></footer>
</body>
</html>