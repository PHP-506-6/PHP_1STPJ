<?php 
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

?>