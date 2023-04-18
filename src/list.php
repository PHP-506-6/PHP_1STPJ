<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_FUNC",DOC_ROOT."first_pj/src/db_query/db_list01.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_FUNC);
    
    $arr = array();
    $arr_list = list01_print01($arr);
    var_dump($arr_list);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <?php include_once(URL_HEADER)?>
</body>
</html>