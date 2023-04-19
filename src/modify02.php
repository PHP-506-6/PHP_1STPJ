<?php
    define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/"); //root 설정
    define("URL_DB", DOC_ROOT."first_pj/src/common/db_common.php"); // db연결
    define("URL_FUNC", DOC_ROOT."first_pj/src/db_query/db_modify02.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결

    include_once( URL_DB );
    include_once( URL_FUNC );

    // test
    // $result_obj = modify02_print01();
    // var_dump($result_obj["obj_contents"]);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/modify02.css">
    <title>목표설정</title>
</head>
<body>
    <?php include_once( URL_HEADER ) ?>
    <div class="set_obj">
        <?php include_once( "./set_obj.php" ) ?>
    </div>
</body>
</html>