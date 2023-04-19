<?php
define("URL_MODYFY02", DOC_ROOT."first_pj/src/db_query/db_modify02.php"); // function 연결
define("URL_OBJ",DOC_ROOT."first_pj/src/set_obj.php");
include_once( URL_MODYFY02 );

?>

<header>
    <h1><img src="../src/img/logo.png" /></h1>
    <p class="date">TODAY <?php echo date("Y-m-d") ?>
        <a href="modify02.php"><i class="bi bi-pencil-square" style="color:#fff"></i></a>
    </p>
    <?php
        $flg_modify02 = basename($_SERVER["PHP_SELF"]) === "modify02.php" ?  true : false;
        // basename : 경로 제외한 파일이름만 선택하는 함수
        $result_obj = modify02_print01(); // 목표 출력하는 함수
        if( !$flg_modify02 ) { 
            include_once( URL_OBJ );
        }
        ?>
</div>
</header>

