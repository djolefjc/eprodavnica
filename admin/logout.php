<?php

session_start();

session_destroy();


echo "<script>window.open('login.php?out=You have successfully logged out!','_self') </script>";

?>
