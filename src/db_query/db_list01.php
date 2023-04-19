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
            FROM do_list
            LIMIT :limit_num OFFSET :offset ";

    $arr_prepare = array(":limit_num" => $param_arr["limit_num"]
                          ,":offset" => $param_arr["offset"]
                        );

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
//함수명 : select_list_count()
//기능 : 게시판 정보글 행 갯수 카운트
//리턴값 : INT $result
//----------------------------------
function select_list_count(){
    $sql = " SELECT count(*) cnt
             FROM do_list ";

    $arr_prepare = array();
    
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
?>
