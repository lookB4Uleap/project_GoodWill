<?php
    session_start();
    // echo $_POST['item_id']." ".$_POST['item_quant']." ".$_POST['name']." ".$_POST['email']." ".$_POST['phno']." ".$_POST['addr'];
    // echo (!empty($_SESSION) && !empty($_POST));
    if (!empty($_SESSION) && !empty($_POST)) {
        // echo "YES";
        $uid = $_SESSION['uid'];
        include "./data.php";
        $db = new DataDB("./data.db");
        
        for ($i=0; $i<$_POST['item_count'];$i++) {
            $res = $db->orderItem($uid, $_POST['item_id_'.$i], $_POST['item_quant_'.$i], date("Y-m-d H:i:s"), $_POST['name'], $_POST['email'], $_POST['phno'], $_POST['addr']);
        }
        
        if ($res == 1) {
            include "./user_data.php";
            $user_db = new UserDataDB("./user_data.db");
            $deleted = $user_db->deleteCartHistory($uid);
            
            if ($deleted == 1)
            echo "<script>
                alert('Orders Placed!')
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