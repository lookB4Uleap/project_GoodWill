<?php
    // echo $_POST["name"]."<br />";
    // echo $_POST["email"]."<br />";
    // echo $_POST["phno"]."<br />";
    // echo $_POST["res_date"]."<br />";
    // echo $_POST["res_time"]."<br />";
    // echo $_POST["table_num"]."<br />";
    session_start();
    if (empty($_POST) || empty($_SESSION)) {
        header("Location: /pages/");
    }
    include "./data.php";
    $db = new DataDB("./data.db");
    $res = $db->createReservation($_SESSION['uid'], $_POST['res_date'], $_POST['res_time'], $_POST['table_num'], $_POST['name'], $_POST['email'], $_POST['phno']);
    if ($res == 1) {
        echo "<script>
                alert('Table Reserved!')
                window.location.replace('/pages/')
            </script>"; 
    }
    else {
        echo "<script>
                alert('Error while reservation!')
                window.location.replace('/pages/')
            </script>"; 
    }
?>