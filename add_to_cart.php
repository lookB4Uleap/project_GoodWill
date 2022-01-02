<?php
    session_start();
    if (empty($_SESSION) && empty($_POST)) {
        header("Location: /pages/login.php");
    }
    $uid = $_SESSION['uid'];
    include "./user_data.php";

    $db = new UserDataDB("./user_data.db");
    $res = $db->insertIntoCart($uid, $_POST['item_id'], $_POST['item_quant']);
    if ($res == 1) {
        echo "<script>
            alert('Added To Cart!')
            window.location.replace('/pages/')
        </script>";
    }
    else {
        echo "<script>
            alert('Failed To Add To Cart!')
            window.location.replace('/pages/')
        </script>";
    }
?>