<?php
    // include_once("../common/db_common.php"); // 디버그용
//----------------------------------
//함수명 : list01_print01()
//기능 : 모든 리스트 출력
//파라미터 : Array $param_arr
//리턴값 : INT $result
//----------------------------------
function list01_print01(&$param_arr){
    $sql=" SELECT list_title
            ,list_contents
            ,ex_set
            ,ex_num
            ,ex_hour
            ,ex_min
         FROM do_list ";

    $arr_prepare = array();

    $conn = null;

    try{
        db_conn($conn);
        $stmt = $conn->prepare($sql);
        $stmt->execute($arr_prepare);
        $result = $stmt->fetchAll();
    }catch(Exception $e){
        return false;
    }finally{
        $conn = null;
    }                
    return $result;
}
//----------------------------------
//함수명 : list01_redirect02()
//기능 : 해당 제목에 대한 내용 출력
//파라미터 : Array $param_arr
//리턴값 : INT $result
//----------------------------------

 
?>
