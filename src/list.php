<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_DB_LIST01",DOC_ROOT."first_pj/src/db_query/db_list01.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_DB_LIST01);

    $arr_get = $_GET;
    //최초 페이지 열때 페이지 넘버
    if(array_key_exists("page_num",$arr_get)){
        $page_num = $arr_get["page_num"];
    }else{
        $page_num = 1; //key가 없으면 1로 셋팅
    }
    //한 페이지당 n개행만 보여줌
    $limit_num = 6; 
    //행 갯수 카운트
    $list_cnt = select_list_count();
    // 반올림,int로 형변환
    $max_page_num = ceil((int)$list_cnt[0]["cnt"] / $limit_num);
    // 전체 페이지 수
    $total_page = ceil($max_page_num / $limit_num);
    //보여줄 페이지 수
    $page_block = 3;
    $offset = ($page_num * $limit_num)- $limit_num;
    //현재 페이지 블럭수
    $now_page = ceil($page_num / $page_block);
    //시작 페이지 
    $s_page_num = ($now_page-1) * $page_block+1;
    //데이터가 없을 경우 1로
    if($s_page_num<=0){ 
        $s_page_num=1;
    }
    //마지막 페이지
    $e_page_num = $now_page * $page_block;

    if($e_page_num > $total_page){ 
        $e_page_num = $total_page;
    }

    $arr = array("limit_num" => $limit_num
                    ,"offset" => $offset
                );

    $arr_list = list01_print01($arr); //전체 데이터 출력
    
    
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <?php include_once(URL_HEADER)?>
    <div class="container">
        <div class="paging">
             <!-- 이전 -->
             <?php if($page_num <=1){ ?>
                <a href="list.php?page_num=1"></a>
            <?php }else{ ?>
                <a class="btn-prev" href="list.php?page_num=<?php echo $page_num-1 ?>">
                    <span class="material-symbols-outlined">arrow_back_ios </span>
                </a>
            <?php } ?>
            <!-- //이전 -->
        <?php for($i=$s_page_num;$i<=$max_page_num; $i++){ ?>
                <a class="middle-page-num" href="list.php?page_num=<?php echo $i?>"><?php echo $i?></a>
        <?php  }?>
         <!-- 다음 -->
         <?php if($page_num >=$max_page_num){ ?>
                <!-- 마지막 페이지일시 Next 버튼 삭제-->
            <?php }else{ ?>
                    <a class="btn-next" href="list.php?page_num=<?php echo $page_num+1?>">
                        <span class="material-symbols-outlined">arrow_forward_ios</span>
                    </a>
            <?php } ?>
             <!-- //다음 -->
        </div>
        <form method="get" action="list.php">
            <div class="inner">
                <!-- 리스트 출력 -->
                <?php foreach ($arr_list as $val) { ?>
                    <div class="box">
                        <div class="box-title">
                            <a href="modify01.php?list_no=<?php echo $val["list_no"]?>" class="a-title"><p><?php echo $val["list_title"]?></p></a>
                        </div>
                        <div class="box-content">
                            <ul>
                                <li><?php echo $val["list_contents"]?></li>
                                <?php if($val["ex_num"] != null || $val["ex_set"] != null) {?>
                                    <li><?php echo $val["ex_num"]."*".$val["ex_set"]?></li>
                                <?php } ?>
                                <li><?php echo $val["ex_min"]?></li>
                            </ul>
                        </div>
                    </div>
                <?php   } ?>
                <div class="btn-group">
                    <a href="" class="button btnFloat1 btnRed">ALL DEL</a>
                    <a href="insert01.php" class="button btnFloat2 btnRed">INSERT</a>
                </div>
                <!--  <!-- //리스트 출력 -->
            </div>
        </form>
    </div> <!--end container -->
</body>
</html>