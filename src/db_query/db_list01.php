<?php
    // include_once("../common/db_common.php"); // 디버그용
//----------------------------------
//함수명 : list01_print01()
//기능 : 모든 리스트 출력
//파라미터 : Array $param_arr
//리턴값 : INT $result
//----------------------------------
function list01_print01(&$param_arr){
    $sql=" SELECT *
            FROM do_list
            WHERE write_date >= :write_date
            ORDER BY com_flg,list_no
            LIMIT :limit_num OFFSET :offset ";

    $arr_prepare = array(":limit_num" => $param_arr["limit_num"]
                          ,":offset" => $param_arr["offset"]
                          ,":write_date" => $param_arr["write_date"]
                        );

    $conn = null;

    try{
        db_conn($conn);
        $stmt = $conn->prepare($sql);
        $stmt->execute($arr_prepare);
        $result = $stmt->fetchAll();
    }catch(Exception $e){
        return $e->getMessage();
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
    $sql = " SELECT count(*) cnt, write_date
             FROM do_list 
             WHERE write_date >= date(now()) ";

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

//----------------------------------
//함수명 : delete_auto_data()
//기능 : 오늘 날짜 이전 데이터 삭제
//파라미터 : Array $param_arr
//리턴값 : INT $result_cnt
//----------------------------------
function delete_auto_data(&$param_arr){
    $sql = " DELETE FROM
             do_list
             WHERE write_date < :write_date ";
    
    $arr_prepare = array("write_date" => $param_arr["write_date"]);

    $conn = null;

    try{
        db_conn($conn);
        $conn->beginTransaction();
        $stmt = $conn->prepare($sql);
        $stmt->execute($arr_prepare);
        $result_cnt = $stmt->rowCount(); // update한 행갯수 카운트
        $conn->commit();
    }catch(Exception $e){
        $conn->rollback();
        return $e->getMessage();
    }finally{
        $conn = null;
    }
    return $result_cnt;
}

?>
