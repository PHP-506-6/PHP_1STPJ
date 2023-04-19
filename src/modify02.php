<?php
    define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/"); //root 설정
    define("URL_DB", DOC_ROOT."first_pj/src/common/db_common.php"); // db연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once( URL_DB );

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
    <form method="post" action="modify02.php">
        <div class="set_obj">
            <?php include_once( URL_OBJ ); ?>
            <div class="btn_area">
                <button class="save_btn btnBlueGreen btnFloat" type="submit">SAVE</button>
                <button  class="cancel_btn btnBlueGreen btnFloat" type="button" ><a href="list.php">CANCEL</a></button>
            </div>
        </div>
    </form>
</body>
</html>
<?php
    // Request Method 획득
    $http_method = $_SERVER["REQUEST_METHOD"];

    if( $http_method === "POST")
    {
        $arr_post = $_POST;
        modify02_excute01($arr_post);
        header( "Location: list.php" );
        exit();
    }


?>