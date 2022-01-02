<?php
    class UserDataDB extends SQLite3 {
        function __construct($path_to_user_data_db) {
            $this->open($path_to_user_data_db);
            // $this->exec("PRAGMA journal_mode = WAL");
        }

        function createUserCart($uid) {
            $ret = $this->exec("CREATE TABLE Cart_".$uid." (item_id INTEGER, item_quant INTEGER)");
            if (!ret)
                return $this->lastErrorMsg();
            else
                return 1;       
        }
        
        function insertIntoCart($uid, $item_id, $item_quant) {
            $ret = $this->exec("INSERT INTO Cart_".$uid." VALUES ({$item_id}, {$item_quant})");
            if (!$ret)
                return $this->lastErrorMsg();
            else
                return 1;
        }

        function getCart($uid) {
            $ret = $this->query("SELECT * FROM Cart_".$uid);
            return $ret;
        }

        function deleteCartHistory($uid) {
            $ret = $this->exec("DELETE FROM Cart_".$uid);
            if (!ret)
                return $this->lastErrorMsg();
            else
                return 1;
        }

        function __destruct() {
            $this->close();
        }
    }

    // $db = new UserDataDB("./user_data.db");
    // if(!$db) {
    //     echo "<p>Cannot open database</p>";
    // } else {
    //     echo "<p>Opened database successfully</p>";
    // }

    // echo $db->createUserCart(9001);
?>