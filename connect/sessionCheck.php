<?php
    if(!isset($_SESSION['memberID'])){//! : memberID가 없으면(글을 쓰려는데 아이디가 없는 경우 로그인창으로 연결 )
        Header("Location:../login/login.php");
    }
?>