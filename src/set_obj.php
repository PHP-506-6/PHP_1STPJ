<?php
    // $result_obj = modify02_print01(); // 목표 출력하는 함수 header.php에 include되어있음

    $str_readonly = $flg_modify02 ? "" : "readonly";
?>
<div class="goal_text">
        <textarea name="obj_contents" maxlength="37" class="goal" <?php echo $str_readonly ?>><?php echo $result_obj["obj_contents"] ?></textarea>
</div>