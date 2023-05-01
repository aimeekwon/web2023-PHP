
<?php 
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>

    <?php include "../include/head.php" ?>
</head>
<body class="gray">
    <?php include "../include/skip.php" ?>
    <!-- //skip -->
    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main" class="container">
        <div class="intro__inner center bmStyle">
            <picture class="intro__images small">
                <source srcset="../assets/img/join01.png, assets/img/join01@2x.png 2x, assets/img/join01@3x.png 3x" />
                <img src="../assets/img/join01.png" alt="회원가입 이미지">
            </picture>
            <h2>게시글 작성하기</h2>
            <p class="intro__text">
                웹디자이너, 웹퍼블리셔
            </p>
        </div>
    <!-- //intro__inner -->
        
    
        <div class="board__inner">
            <div class="board__write">

                <form action="boardModifySave.php" name="#" method="post">
                    <fieldset>
                        <legend class="blind">게시글 수정하기</legend>
<?php
    $boardID = $_GET['boardID'];
    
    $sql = "SELECT boardID, boardTitle, boardContents FROM board WHERE boardID = {$boardID}";
    // echo $boardID;
    // echo "------";
    $result = $connect -> query($sql);

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<div style='display:none'><label for='boardID'>번호</label><input type='text' id='boardID' name='boardID' class='inputStyle' value='".$info['boardID']."'></div>";
        echo "<div><label for='boardTitle'>제목</label><input type='text' id='boardTitle' name='boardTitle' class='inputStyle' value='".$info['boardTitle']."'></div>";
        echo "<div><label for='boardContents'>내용</label><textarea name='boardContents' id='boardContents' rows='20' class='inputStyle'>".$info['boardContents']."</textarea></div>";
        echo "<div class='mt50' ><label for='boardID'>비밀번호</label><input type='password' id='boardPass' name='boardPass' class='inputStyle'  autocomplete='off' required placeholder='글을 수정하려면 로그인 비밀번호를 입력 하셔야 합니다'></div>";
    
    }
?>

                        <!-- <div>
                            <label for="">제목</label>
                            <input type="text" id="boardTitle" name="boardTitle" class="inputStyle">
                        </div>                
                        
                        <div>
                            <label for="boardContents">내용</label>
                            <textarea name="boardContents" id="boardContents" rows="20" class="inputStyle"></textarea>
                        </div> -->

                        <button type="submit" class="btnStyle3">저장하기</button>
                    </fieldset>
                </form>
            </div>

        </div>   
    </main>
    <!-- //main -->
    <?php include "../include/footer.php" ?>
    <!-- //header -->
</body>
</html>