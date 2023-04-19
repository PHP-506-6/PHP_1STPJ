<?php
    $result_obj = modify02_print01(); // 목표 출력하는 함수
?>
<div class="goal_text">
        <form method="">
            <textarea maxlength="37" class="goal">
 <?php echo $result_obj["obj_contents"] ?>
            </textarea>
        </form>
</div>