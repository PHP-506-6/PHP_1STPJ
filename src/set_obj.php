<?php
    // $result_obj = modify02_print01(); // 목표 출력하는 함수 header.php에 include되어있음

    // $$flg_modify02가 header에서 set_obj가 include되기전에 선언되어있기때문에 사용가능
    $str_readonly = $flg_modify02 ? "" : "readonly";
?>
<div class="goal_text">
        <input name="obj_contents" maxlength="19" class="goal" <?php echo $str_readonly ?> value="<?php echo $result_obj["obj_contents"] ?>" autocomplete="off" required ></input>
</div>