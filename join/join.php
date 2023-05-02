<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 페이지</title>

    <?php include "../include/head.php" ?>
</head>

<body class="gray">
    <?php include "../include/skip.php" ?>
    <!-- //skip -->
    <?php include "../include/header.php" ?>
    <!-- //header -->
    <main id="main" class="container">
        <div class="login__inner">

            <h2>로그인</h2>
            <p>로그인을 하시면 게시글 및 댓글 작성이 가능합니다<br>회원가입을 하시면 로그인이 가능합니다.<br>admin@admin.com/1234<< /p>
                    <div class="login__form btStyle bmStyle">
                        <form action="loginSave.php" name="loginSave" method="post">
                            <fieldset>
                                <legend class="blind">
                                    로그인영역
                                </legend>
                                <div>
                                    <label for="youEmail" class="blind required">이메일</label>
                                    <input type="email" id="youEmail" name="youEmail" class="inputStyle" placeholder="이메일을 적어주세요!" required>
                                </div>
                                <div>
                                    <label for="youPass" class="blind required">비밀번호</label>
                                    <input type="password" id="youPass" name="youPass" class="inputStyle" placeholder="비밀번호를 적어주세요!" required>
                                </div>
                                <button type="submit" class="btnStyle2 mt20">로그인</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="login__footer">
                        <ul class="listStyle2">
                            <li>회원가입을 하지 않았다면 회원가입을 해주세요 <a href="join.html">회원가입</a></li>
                            <li>아이디가 기억나지 않는다면 <a href="">아이디찾기</a></li>
                            <li>비밀번호가 기억나지 않는다면 <a href="">비밀번호찾기</a></li>
                        </ul>
                    </div>
        </div>
    </main>
    <!-- //main -->
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>

</html>