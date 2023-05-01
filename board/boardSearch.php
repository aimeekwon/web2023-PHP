<?php
include "../connect/connect.php";
include "../connect/session.php";

if(isset($_GET['page'])){
    $page =(int) $_GET['page'];
}else {
    $page = '1';
}


$searchKeyword = $_GET['searchKeyword'];
$searchOption = $_GET['searchOption'];

$searchKeyword = $connect-> real_escape_string(trim($searchKeyword));
$searchOption = $connect-> real_escape_string(trim($searchOption));

//검색에 맞는게시판 불러오기
$sql = "SELECT  b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) ";
// //제목에서 내가 쓴 키워드 찾기
// $sql = "SELECT  b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardTitle LIKE '%{$searchKeyword}' ORDER BY boardID DESC";
// //내용에서 내가 쓴 키워드 찾기
// $sql = "SELECT  b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardContents LIKE '%{$searchKeyword}' ORDER BY boardID DESC";
// //이름에서 내가 쓴 키워드 찾기
// $sql = "SELECT  b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE m.youName LIKE '%{$searchKeyword}' ORDER BY boardID DESC";

switch ($searchOption) {
    case "title":
        $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
        break;
    case "content":
        $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
        break;
    case "name":
        $sql .= "WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
        break;
}



$result = $connect->query($sql);

$totalCount = $result->num_rows;
// echo $totalCount;
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
        <div class="intro__inner center">
            <picture class="intro__images small">
                <source srcset="../assets/img/join01.png, ../assets/img/join01@2x.png 2x, ../assets/img/join01@3x.png 3x" />
                <img src="assets/img/join01.png" alt="회원가입 이미지">
            </picture>
            <h2>결과 게시판</h2>
            <p class="intro__text">
                웹디자이너, 웹퍼블리셔, 프론트엔드의 게시판 입니다 <br>
                총 <em><?=$totalCount?></em>건의 게시물이 검색되었습니다.
                
            </p>
        </div>
        <!-- //intro inner -->

        <div class="board__inner">
            <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 5%">
                        <col>
                        <col style="width: 10%">
                        <col style="width: 15%">
                        <col style="width: 7%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>등록자</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>

<?php 
//한 페이지에서 보여지는 최대 게시글 지정하기
    $viewNum = 10;
    $viewLimit = ($viewNum * $page ) - $viewNum;

    $sql .= "LIMIT {$viewLimit}, {$viewNum}" ;
    $result = $connect -> query($sql);

    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=0; $i<$count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "<tr>";
                echo "<td>".$info['boardID']."</td>";
                echo "<td><a href='boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</td>";
                echo "<td>".$info['youName']."</td>";
                echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                echo "<td>".$info['boardView']."</td>";
                echo "</tr>";
            }
    }else {
        echo"<tr><td colspan='5'>게시글이 없습니다</td></tr>";
    }
}
?>
                        <!-- <tr>
                            <td>1</td>
                            <td><a href="boardView.html"> 게시판 제</a>목</td>
                            <td>aimee</td>
                            <td>2023-04-24</td>
                            <td>100</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="board__pages">
                <ul>
                <!--     
                    <li><a href="#">처음으로</a></li>
                    <li><a href="#">이전</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">다음</a></li>
                    <li><a href="#">마지막으로</a></li>
                 -->

<?php
    //총페이지갯수
    $boardTotalCount =ceil($totalCount/$viewNum);
    // 1 2 3 4 5 6 7 8 9 10
    $pageView =4;
    $startPage =$page - $pageView;
    $endPage =$page + $pageView;

    //처음 페이지 초기화
     if($startPage < 1) $startPage = 1;
     if($endPage >= $boardTotalCount)  $endPage = $boardTotalCount;
    //처음으로/이전
    if($boardTotalCount > 1 && $page <= $boardTotalCount){
        if($page != 1){
            $prevPage = $page-1;
            echo "<li><a href='boardSearch.php?page=1&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>처음으로</a><li>";
            echo "<li><a href='boardSearch.php?page={$prevPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>이전</a><li>";
        }
    }
    //페이지
    for($i=$startPage; $i<=$endPage; $i++){
        $active ="";
        if($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='boardSearch.php?page={$i}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>{$i}</a></li>";
    }
    //마지막으로/다음
    if($page != $boardTotalCount && $page <= $boardTotalCount){//
        $nextPage = $page+1;
        echo "<li><a href='boardSearch.php?page={$nextPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>다음</a><li>";
        echo "<li><a href='boardSearch.php?page={$boardTotalCount}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>마지막으로</a><li>";
    }
?>
                </ul>
            </div>
        </div>
        <!-- board__inner -->
    </main>
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>

</html>