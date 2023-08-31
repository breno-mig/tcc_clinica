<?php
//session_start();
if(session_status() == PHP_SESSION_NONE){
    echo"
        <script language='javascript' type='text/javascript'>
        window.location.href='login.php';
        </script>
    ";
}else{
    echo"
        <script language='javascript' type='text/javascript'>
        window.location.href='home.html';
        </script>
    ";
}

?>