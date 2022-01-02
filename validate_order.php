<?php
    session_start();
    // echo $_POST['item_id']." ".$_POST['item_quant']." ".$_POST['name']." ".$_POST['email']." ".$_POST['phno']." ".$_POST['addr'];
    // echo (!empty($_SESSION) && !empty($_POST));
    if (!empty($_SESSION) && !empty($_POST)) {
        // echo "YES";
        $uid = $_SESSION['uid'];
        include "./data.php";
        $db = new DataDB("./data.db");
        
        $res = $db->orderItem($uid, $_POST['item_id'], $_POST['item_quant'], date("Y-m-d H:i:s"), $_POST['name'], $_POST['email'], $_POST['phno'], $_POST['addr']);
        if ($res == 1) {
            echo "<script>
                alert('Order Placed!')
                window.location.replace('/pages/')
            </script>"; 
        }
        else {
            echo "<script>
                alert('Error in placing order!')
                window.location.replace('/pages/')
            </script>";
        }
        // header("Location: /pages/");
    }
    else {
        header("Location: /pages/");
    }
?>