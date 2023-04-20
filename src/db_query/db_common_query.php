<?php
// include_once("../common/db_common.php");         // 디버그용 
//----------------------------------
// 함수명   : list01_print01
// 기능     : 모든 리스트 출력
// 파라미터 : Array $param_arr
// 리턴값   : INT $result
// 이력		: 0418 오재훈
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
// 함수명   : select_list_count
// 기능     : 게시판 정보글 행 갯수 카운트
// 파라미터 : X
// 리턴값   : INT $result
// 이력		: 0418 오재훈
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
// 함수명   : delete_auto_data
// 기능     : 오늘 날짜 이전 데이터 삭제
// 파라미터 : Array $param_arr
// 리턴값   : INT $result_cnt
// 이력		: 0418 오재훈
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
//----------------------------------
// 함수명   : select_flg_count
// 기능     : 완료한 데이터행 갯수 체크
// 파라미터 : X
// 리턴값   : INT $result
// 이력		: 0420 오재훈
//----------------------------------
function select_flg_count(){
    $sql = " SELECT count(com_flg) cnt
             FROM do_list 
             WHERE com_flg = '1' ";

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



// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수명   : insert_list_info
// 기능     : 새로운 리스트 생성
// 파라미터 : ARRAY &$param_array
// 리턴값   : INT $result_cnt / STRING ERRMSG
// 이력		: 0418  김미현
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

//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수명   : update_list
// 기능     : 특정 리스트 수정
// 파라미터 : Array &$param_arr
// 리턴값   : INT/STRING   $result_cnt/ERRMSG 
// 이력	    : 0419  김미현
//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
function update_list( &$param_arr )
{
    $sql = " UPDATE do_list
    SET list_title = :list_title
        ,list_contents = :list_contents
        ,ex_set = :ex_set
        ,ex_num = :ex_num
        ,ex_hour = :ex_hour
        ,ex_min = :ex_min
        ,com_flg = :com_flg
        ,update_date = NOW()
    WHERE list_no = :list_no; ";
    
    
    $arr_prepare = 
            array(
            ":list_title" => $param_arr["list_title"]
            ,":list_contents" => $param_arr["list_contents"]
            ,":ex_set" => $param_arr["ex_set"]
            ,":ex_num" => $param_arr["ex_num"]
            ,":ex_hour" => $param_arr["ex_hour"]
            ,":ex_min" => $param_arr["ex_min"]
            ,":com_flg" => $param_arr["com_flg"]
            ,":list_no" => $param_arr["list_no"]
            );

    $conn = null;
    try 
    {
        db_conn( $conn );       // PDO object 셋
        $conn->beginTransaction(); // Transaction시작  commit이나 rollback만나면 종료
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result_cnt = $stmt->rowCount();
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
    return $result_cnt;     //행의 개수 리턴 
}



//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수     : select_list_info_no
// 기능     : 특정 리스트 정보 출력
// 파라미터 : INT &$param_no
// 리턴값   : ARRAY $result[0]
// 이력	    : 0419  김미현
//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ

function select_list_info_no( &$param_no )
{
    $sql = " SELECT list_title ,list_contents ,ex_set ,ex_num ,ex_hour, ex_min, com_flg ,list_no
            FROM do_list
            WHERE list_no = :list_no; ";

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
    catch (Exception $e) 
    {
        return $e->getMessage();
    }
    finally
    {
        $conn = null;//     데이터베이스 종료
    }
    return $result[0];
}







?>