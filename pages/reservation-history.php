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
            console.log($("#hidden").val())

            // $("#addr").value = 
        })
    </script>
    <title>Reservation History</title>
</head>
<body>
    <?php 
        include "../data.php";
        $uid = $_SESSION['uid'];

        if (empty($_SESSION)) {
            // header("Location: /ResApp/pages/");
            header("Location: /pages/");
        } 

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
              <a class="navbar-brand" href="javascript:void(0)">Logo</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                  </li>
                </ul>
                <a class="Drop-Down d-flex dropdown-toggle" href="#" style="text-decoration: none; color: #f1f1f1;" data-bs-toggle="dropdown">
                    <!-- <img src="logo.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill">  -->
                    <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="background-color: #f1f1f1;">
                  <li><a class="dropdown-item" href="#">Link 1</a></li>
                  <li><a class="dropdown-item" href="#">Link 2</a></li>
                  <li><a class="dropdown-item" href="#">Link 3</a></li>
                </ul>
              </div>
            </div>
          </nav>
    </header>

    <main class="Confirm-Order">
        <div class="Order-Section">
            <h1 >ORDER HISTORY</h1>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Reservation Date</th>
                    <th>Reservation Time</th>
                    <th>Table Number</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $res = $db->getUserReservations($uid);
                        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                    ?>

                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phno'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php echo $row['time'] ?></td>
                        <td><?php echo $row['table_num'] ?></td>
                    </tr>

                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="Footer">AS &copy 2020-<div id="year"></div></footer>
</body>
</html>