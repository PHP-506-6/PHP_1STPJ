<?php
// include_once("../common/db_common.php");         // 디버그용 
// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수명 : insert_list_info
// 기능 : 새로운 리스트 생성
// 파라미터 : ARRAY &$param_array
// 리턴값 : INT $result_cnt / STRING ERRMSG
// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
function insert_list_info( &$param_array )
{
    $sql = " INSERT INTO do_list
    ( list_title
    ,list_contents
    ,ex_set
    ,ex_num
    ,ex_hour
    ,ex_min
    ,write_date )
    VALUES
    (
        :list_title
        ,:list_contents
        ,:ex_set
        ,:ex_num
        ,:ex_hour
        ,:ex_min
        ,NOW()
    ); ";

    $arr_prepare = 
                array(
                    ":list_title" => $param_array["list_title"]
                    ,":list_contents" => $param_array["list_contents"]
                    ,":ex_set"=>$param_array["ex_set"]
                    ,":ex_num"=>$param_array["ex_num"]
                    ,"ex_hour"=>$param_array["ex_hour"]
                    ,"ex_min"=>$param_array["ex_min"]
                );

    $conn = null;
    try 
    {
        db_conn( $conn );       // PDO object 셋
        $conn->beginTransaction(); // Transaction시작  commit이나 rollback만나면 종료
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare ); 
        $result_cnt = $stmt->rowCount();    //insert 성공하면 1 실패하면 0
        $conn->commit();
    }
    catch (Exception $e) 
    {
        $conn->rollback();
        return $e->getMessage();
    }
    finally
    {
        $conn = null;//     데이터베이스 종료
    }

    return $result_cnt; 
}




?>

