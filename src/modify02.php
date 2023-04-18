<?php
    define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/"); //root 설정
    define("URL_DB", DOC_ROOT."first_pj/src/common/db_common.php"); // db연결
    define("URL_FUNC", DOC_ROOT."first_pj/src/db_query/db_modify02.php"); // function 연결

    include_once( URL_DB );
    include_once( URL_FUNC );
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <title>목표설정</title>
</head>
<body>
    <header>
        <h1><img src="../src/img/logo.png" /></h1>
        <p class="date">TODAY <?php echo date("Y-m-d") ?></p>
    </header>
    <div id="contents">
        <form>
            <input type="text" value="">
        </form>
    </div>
</body>
</html>