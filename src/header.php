<?php
define("URL_OBJ",DOC_ROOT."first_pj/src/set_obj.php"); // 목표 설정 연결
?>

<header>
    <h1><a href="list.php"><img src="../src/img/logo.png" /></a></h1>
    <p class="date">TODAY <?php echo date("Y-m-d") ?>
        <a href="modify02.php"><i class="bi bi-pencil-square"></i></a>
    </p>
    <?php
        // $_SERVER["PHP_SELF"] : 헤더, 경로 및 스크립트 위치 등 서버 및 실행 환경 정보를 배열 형태로 가져올 수 있는 서버함수에서 도메인, 파라미터값을 제외한 현재 페이지 주소를 가져옴 ex)'/first_pj/src/list.php'
        // basename : 경로 제외한 파일이름만 선택하는 함수 => ex) 'list.php'
        
        // 파일 이름 확인 플래그 생성 ($flg_modify02)
        $flg_modify02 = basename($_SERVER["PHP_SELF"]) === "modify02.php" ?  true : false;
        $result_obj = modify02_print01(); // 목표 출력하는 함수
        if( !$flg_modify02 ) { 
            include_once( URL_OBJ );
        }
        ?>
</header>

