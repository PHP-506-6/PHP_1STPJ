<?php

// include_once("../common/db_common.php"); // 디버그용

// ------------------------------------------------
// 함수명	: modify02_print01
// 기능		: 목표 정보 출력 (select)
// 파라미터	: 없음
// 리턴값	: Array     $result
// -------------------------------------------------
function modify02_print01()
{
    $sql =
    " SELECT "
    ." obj_contents "
    ." FROM "
    ." obj_list "
    ;
    $arr_prepare = array();

    $conn = null;
    try {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e ) {
        return $e->getMessage();
    } 
    finally {
        $conn = null;
    }

    return $result[0];
}

// ------------------------------------------------
// 함수명	: modify02_excute01
// 기능		: 목표 정보 수정 (update)
// 파라미터	: Array              &$param_arr
// 리턴값	: INT/STRING		$result_cnt/ERRMSG
// -------------------------------------------------
function modify02_excute01( &$param_arr )
{
    $sql =
        " UPDATE "
        ." obj_list "
        ." SET "
        ." obj_contents = :obj_contents "
        ;
    $arr_prepare =
        array(
            ":obj_contents" => $param_arr["obj_contents"]
        );

    $conn = null;
    try {
        db_conn( $conn );
        $conn->beginTransaction(); // Transaction 시작
        $stmt = $conn->prepare( $sql );
        $result = $stmt->execute( $arr_prepare );
        $conn->commit();
    }
    catch ( Exception $e )
    {
        $conn->rollback();
        return $e->getMessage();
    }
    finally{
        $conn = null;
    }

    return $result;
}

?>