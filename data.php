<?php
   class DataDB extends SQLite3 {
        private $ret;

        function __construct($path_to_db) {
            $this->open($path_to_db);
            $this->exec("PRAGMA journal_mode = WAL");
        }
      
    //   function queryCall() {
    //      $ret = $this->query("SELECT * FROM table1");
    //      while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    //         echo "<p>A = ". $row['A'] . "</p>";
    //         echo "<p>B = ". $row['B'] ."</p>";
    //      }
    //      if(!$ret) {
    //         echo $this->lastErrorMsg();
    //      } else {
    //         echo "<p>Operation done successfully</p>";
    //      }
    //   }

        function validateUser($login_id, $pass) {
            $ret = $this->query("SELECT uid FROM  users WHERE login_id = "."'".$login_id."'"."  AND  pass = "."'".$pass."'");
            $uid = 0;
            if (!$ret)
                return -1;
            else {
                $row = $ret->fetchArray(SQLITE3_ASSOC);
                return $row['uid'];
            }
            // return -1;
        }

        function registerUser($user_nm, $user_email, $user_phno, $login_id, $pass, $addr) {
            $ret = $this->exec("INSERT INTO users(user_nm, user_email, user_phno, login_id, pass, addr) VALUES ('".$user_nm."','".$user_email."',".$user_phno.",'".$login_id."','".$pass."','".$addr."')");
            if (!$ret)
            	return $this->lastErrorMsg();
            else
            	return 1;
        }

        function getUserFromId($uid) {
            $ret = $this->query("SELECT * FROM users WHERE uid=".$uid);
            if (!$ret)
                return -1;
            else {
                $row = $ret->fetchArray(SQLITE3_ASSOC);
                return $row;
            }
        }

        function displayMenu() {
            $ret = $this->query("SELECT * FROM menu");
            // $menu = array()
            // while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            //     $menu[]
            // }
            return $ret;
        }

        function getUniqueItemCategory() {
            $ret = $this->query("SELECT DISTINCT category FROM menu");
            $data = array();
            while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                array_push($data, $row);
            }
            // return json_encode($data);
            // foreach($data as $cat) {
            //     echo $cat['category']." ";
            // }
            return $data;
        }

        function getMenuItemsByCategory($category) {
            $ret = $this->query("SELECT * FROM menu WHERE category = '".$category."'");
            return $ret;
        }

        function getMenuItem($item_id) {
            $ret = $this->query("SELECT * FROM menu WHERE id = ".$item_id);
            return $ret;
        }

        function orderItem($uid, $item_id, $item_quant, $order_date_time, $name, $email, $phno, $addr) {
            $res = $this->getMenuItem($item_id);
            $row = $res->fetchArray(SQLITE3_ASSOC); 
            $item_nm = $row['item_nm'];
            $item_price = $row['item_price'];
            // echo "<p>".$item_nm."  ".$item_price."</p>";
            $ret = $this->exec("INSERT INTO orders(uid, item_id, item_nm, item_price, item_quant, order_date_time, name, email, phno, addr) VALUES ({$uid},{$item_id},'{$item_nm}',{$item_price},{$item_quant},'{$order_date_time}', '{$name}', '{$email}','{$phno}','{$addr}')");
            // $row = $ret->fetchArray(SQLITE3_ASSOC);
            // echo "<p>".$row['order_id']."</p>";
            if (!$ret)
            	return $this->lastErrorMsg();
            else
            	return 1;
        }

        function getUserOrders($uid) {
            $ret = $this->query("SELECT * FROM orders WHERE uid = {$uid}");
            return $ret;
        }

        function mapOrderToUser($uid) {
            $ret = $this->exec("INSERT INTO map_order(uid) VALUES (".$uid.")");
            if (!$ret)
            	return $this->lastErrorMsg();
            else
            	return 1;
        }

        function __destruct() {
            $this->close();
        }
    }
   
    // $db = new DataDB("./data.db");
    // if(!$db) {
    //     echo "<p>Cannot open database</p>";
    // } else {
    //     echo "<p>Opened database successfully</p>";
    // }

    // $row = $db->getUserFromId(9000);
    // echo $row['uid'];

    // $db->registerUser("Admin3", "admin3@admin.co", 1234568790, "admin3", "12345", "PLace of admin3");
    // if (!$db->validateUser("admin2", "admin2"))
    //     echo "INVALID";
    // else
    //     echo "VALID";
    // echo $db->orderItem(9000, 10001, 1, date("Y-m-d H:i:s"), "Admin", "admin@admin.co", "1234567890", "Address of Admin");
    // echo "<p>".date("Y-m-d H:i:s")."</p>";
    // echo $db->mapOrderToUser(9000);

    // $ret = $db->getMenuItem(10001);
    // while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    //     echo $row['id']."<br />";
    // }

    // $db->getUniqueItemCategory();
    // while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    //     echo $row['category']."<br />";
    // }

    // $ret = $db->getMenuItemsByCategory("Biriyani");
    
    // $ret = $db->getUserOrders(9000);
    // while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    //     echo $row['item_nm']."<br />";
    // }

   // $ret = $db->query("SELECT * FROM table1");
   // while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
   //    echo "<p>A = ". $row['A'] . "</p>";
   //    echo "<p>B = ". $row['B'] ."</p>";
   // }
   // if(!$ret) {
   //    echo $db->lastErrorMsg();
   // } else {
   //    echo "<p>Operation done successfully</p>";
   // }
   // $db->close();
?>

