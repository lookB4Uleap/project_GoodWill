<?php
    session_start();
    session_unset();
    session_destroy();
    // header("Location: /ResApp/pages/");
    header("Location: /pages/");
?>