<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_FUNC",DOC_ROOT."first_pj/src/db_query/db_insert01.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_FUNC);
    
    $result_list = select_obj_list();
    $http_method = $_SERVER["REQUEST_METHOD"]; 

    if ($http_method ==="POST")                                          // POST일때 
    {
        $arr_post = $_POST;
        $result_cnt = insert_list_info( $arr_post );        // DB에 list정보 추가
        
        header( "Location:list.php" );                      // list페이지  redirect
        exit();
    }

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <header>
        <h1><img src="../src/img/logo.png" /></h1>
        <p class="date">TODAY <?php echo date("Y-m-d") ?></p>
        <div class="goal_text">
            <form>
            <?php echo $result_list["obj_contents"]?>
            </form>
        </div>
    </header>

    <form method="post" action="insert01.php">
        <label for="list_title">제목</label>
        <input type="text" name="list_title" required>

        <label for="list_contents">내용</label>
        <input type="text" name="list_contents" required>

        <label for="ex_set">세트</label>
        <input type="text" name="ex_set" >
        <!-- CSS세트 뒤에 after로 SET 적기 -->
        
        <label for="ex_num">횟수</label>
        <input type="text" name="ex_num" >
        <!-- css세트 뒤에 after로 '회' 적기 -->
        
        <div>시간</div>
        <input type="text" name="ex_hour" >
        <label for="ex_hour">시간</label>
        <input type="text" name="ex_min">
        <label for="ex_min">분</label>

        <button type="submit">작성</button>
        <button><a href="list.php">취소</a></button>
    </form>

</body>
</html>