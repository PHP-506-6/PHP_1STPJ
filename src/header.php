<header>
    <h1><img src="../src/img/logo.png" /></h1>
    <p class="date">TODAY <?php echo date("Y-m-d") ?></p>
    <?php
        // basename : 경로 제외한 파일이름만 선택하는 함수
        $result_obj = modify02_print01(); // 목표 출력하는 함수
        if( basename($_SERVER["PHP_SELF"]) != "modify02.php" ) { ?>
        <div class="goal_text">
        <form method="">
            <textarea maxlength="37" class="goal" readonly>
 <?php echo $result_obj["obj_contents"] ?>
            </textarea>
        </form>
</div>

    <?php } ?>
        <?php include_once("./set_obj.php") ?>
</header>
