<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_DB_DELETE01",DOC_ROOT."first_pj/src/db_query/db_delete01.php"); //function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once( URL_DB );
    include_once( URL_DB_DELETE01 );

?>