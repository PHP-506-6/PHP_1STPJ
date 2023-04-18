<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_FUNC",DOC_ROOT."first_pj/src/db_query/db_list01.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_FUNC);
    
    $arr = array();
    $arr_list = list01_print01($arr); //전체 데이터 출력
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
    <div class="container">
        <div class="line"></div>
        <div class="inner">
            <!-- 리스트 출력 -->
            <?php foreach ($arr_list as $val) { ?>
                <div class="box">
                    <div class="box-title">
                        <p><?php echo $val["list_title"]?></p>
                    </div>
                    <div class="box-content">
                        <ul>
                            <li><?php echo $val["list_contents"]?></li>
                            <?php if($val["ex_num"] != null || $val["ex_set"] != null) {?>
                                <li><?php echo $val["ex_num"]."*".$val["ex_set"]?></li>
                            <?php } ?>
                            <li><?php echo $val["ex_min"]?></li>
                        </ul>
                    </div>
                </div>
            <?php   } ?>
            <!--  <!-- //리스트 출력 -->
        </div>
        <div class="btn-group">
        <a href="" title="Button border blue/green" class="button btnFloat btnBlueGreen">Float</a>
        <a href="" title="Button border blue/green" class="button btnFloat btnBlueGreen">Float</a>
        </div>
    </div>
</body>
</html>