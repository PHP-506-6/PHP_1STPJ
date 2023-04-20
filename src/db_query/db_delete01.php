<?php
// include_once("../common/db_common.php"); // 디버그용 

// ------------------------------------------------
// 함수명	: delete01_print01
// 기능		: 특정 리스트 정보 출력 (select)
// 파라미터	: INT &$param_no
// 리턴값	: Array  $result
// -------------------------------------------------
function delete01_print01( &$param_no )
{
    $sql =
        " SELECT "
        ." list_title "
        ." ,list_contents "
        ." ,ex_set "
        ." ,ex_num "
        ." ,ex_hour "
        ." ,ex_min "
        ." ,com_flg "
        ." ,list_no "
        ." FROM "
        ." do_list "
        ." WHERE "
        ." list_no = :list_no "
        ;
    $arr_prepare = 
        array(
            ":list_no" => $param_no
        );

    $conn = null;
    try
    {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result = $stmt->fetchALL();
    }
    catch ( Exception $e )
    {
        return $e->getMessage();
    }
    finally
    {
        $conn = null;
    }
    return $result[0];
}

// test
// $test = 3;
// print_r( delete01_print01( $test) );

// ------------------------------------------------
// 함수명	: delete01_execute01
// 기능		: 특정 리스트 정보 삭제 (delete)
// 파라미터	: INT   &$param_no
// 리턴값	: iNT   $result_cnt
// -------------------------------------------------

function delete01_execute01( $param_no )
{
    $sql =
    " DELETE FROM do_list "
    ." WHERE "
    ." list_no = :list_no "
    ;

    $arr_prepare =
        array(
            ":list_no" => $param_no["list_no"]
        );
    
    $conn = null;
    try
    {
        db_conn( $conn );
        $conn->beginTransaction(); // Transaction 시작
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result_cnt = $stmt->rowCount();
        $conn->commit();
    }
    catch ( Exception $e )
    {
        $conn->rollback();
        return $e->getMessage();
    }
    finally
    {
        $conn = null;
    }
    return $result_cnt;
}

// test
// $arr_test =
//     array( "list_no" => 3 );
// $test_result = delete01_execute01($arr_test);

// var_dump($test_result);
?>