<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_DB_COMMON_QUERY",DOC_ROOT."first_pj/src/db_query/db_common_query.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_DB_COMMON_QUERY);
    //ex)2023년04월21일 00시00분00초 날짜비교용 db리소스를 최대한 안쓸려고
    $write_date = date('Ymd').'000000'; // 오늘 날짜값 설정 YYYYmmdd000000  

    // ------------------ 페이징--------------------- 
    $arr_get = $_GET;
    //페이지 넘버 가져옴
    if(array_key_exists("page_num",$arr_get)){
        $page_num = $arr_get["page_num"];
    }else{
        $page_num = 1; //page_num가 없으면 1로 셋팅
    }

    //한 페이지당 보여줄 행 갯수
    $limit_num = 3;
    // 한 블럭당 보여줄 페이지 수
    $page_block = 3;

    //모든행 갯수 카운트
    $sel_data_cnt = array("write_date" => $write_date);
    $list_cnt = select_list_count($sel_data_cnt);

    // 페이지 최대 갯수 , 올림 
    // ex)10/3 = 3.3333.. = 4 ,3페이지
    $max_page_num = ceil($list_cnt[0]["cnt"] / $limit_num);

    //1~6, 7~13 페이지당 데이터 보여줄 갯수 
    // (현 페이지 넘버 X 보여줄 행 갯수)-보여줄 행 갯수  ex)(2*3)-3=3
    $offset = ($page_num * $limit_num)- $limit_num;

    //현재 페이지 블럭수 , 현재 몇 번째 블록에 위치한지 (현 페이지 넘버 / 한 블럭당 페이지 수)
    //ex) 2 / 3 = 0.6... = 1, 4/3 =1.33.. = 2 
    $now_block = ceil($page_num / $page_block);

    //블럭당 시작 페이지 번호 , (현재 블럭 - 1)*한 블럭당 페이지 수 + 1
    //ex) 1,2,3 페이지 일 때 -> (1-1)*3 + 1 = 1
    //4,5,6 페이지 일 때 -> (2-1)*3 + 1 = 4
    $s_block_num = ($now_block-1)*$page_block + 1;

    //데이터가 0일 때 경우를 만들어줘야함 그 때는 시작 페이지가 1
    //데이터가 없을 경우 1로
    if($s_block_num<=0){ 
        $s_block_num=1;
    }

    //블럭당 마지막 페이지 번호
    //현재 블럭 번호 * 한 블럭당 페이지 수
    $e_block_num = $now_block * $page_block;

    //블럭당 마지막 페이지 num가 총 페이지 num보다 크면 실행
    // 마지막 번호는 전체 페이지 수를 넘기면 안된다.
    // 만약 블럭당 마지막 페이지 번호 > 전체페이지 라면, 마지막 페이지 번호는 전체 페이지 번호랑 같다
    if($e_block_num >= $max_page_num){ 
        $e_block_num = $max_page_num;
    }
    // ------------------ end 페이징--------------------- 
    

    $arr = array("limit_num" => $limit_num
                    ,"offset" => $offset
                    ,"write_date" => $write_date
                );

    $arr_list = list01_print01($arr); //전체 데이터 출력
    
    $arr_cnt = select_flg_count(); //완료된 데이터 갯수 체크
    $com_cnt = $arr_cnt[0]["cnt"]; 
    $total_com_cnt = $list_cnt [0]["cnt"]; //총 데이터 갯수

    //리스트페이지 열 때 이전날짜 데이터 자동 삭제
    $arr_auto_del = array("write_date"=>$write_date);
    delete_auto_data($arr_auto_del);

    
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awake</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
</head>
<body>
    <div id="wrap">
    <?php include_once(URL_HEADER)?>
    <div class="container container_l">
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
        <?php for($i=$s_block_num;$i<=$e_block_num; $i++){ ?>
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
            <div class="inner">
                <!-- 완료량 체크 진행바 -->
                <div class="com-flg">
                    <h2>오늘의 운동 완료량</h2>
                    <?php echo $com_cnt ?> / <?php echo $total_com_cnt ?>
                    <progress id="progress" value="<?php echo $com_cnt ?>" min="0" max="<?php echo $total_com_cnt ?>"></progress>
                </div>
                <!-- 리스트 출력 -->
                <?php foreach ($arr_list as $val) { ?>
                    <a class="box-click" href="modify01.php?list_no=<?php echo $val["list_no"]?>">
                        <div class="box <?php if($val["com_flg"] === '1'){ echo 'active';}?>">
                            <div class="sec-box">
                                <div class="box-title">
                                    <!-- 글자수 제한 / 초과시 ..으로 출력 -->
                                    <p class="box-title-main">
                                        <?php if(mb_strlen($val["list_title"]) > 6){ ?>
                                                <?php echo mb_substr($val["list_title"],0,6).".." ?>
                                            <?php }else{ ?>
                                                <?php echo $val["list_title"]?>
                                            <?php }?>
                                    </p>
                                    <p class="box-title-sub list-cont">
                                        <?php if(mb_strlen($val["list_contents"]) > 9){ ?>
                                                <?php echo mb_substr($val["list_contents"],0,9).".." ?>
                                            <?php }else{ ?>
                                                <?php echo $val["list_contents"]?>
                                            <?php }?>
                                        </p>
                                </div>
                                <div class="box-content">
                                <!-- 횟수,세트 출력 조건 -->
                                    <!-- 횟수가 값이 있을 때 -->
                                    <?php if($val["ex_num"] !== null && empty($val["ex_num"]) !== true){ ?>
                                        <div>
                                            <span class="material-symbols-outlined">settings_accessibility</span>
                                            <p>
                                            <?php echo $val["ex_num"]."회"?>
                                            <!-- 횟수에 값 있고 세트에 값이 있을때 -->
                                            <?php if($val["ex_set"] !== null && empty($val["ex_set"]) !== true) { ?>
                                                <?php echo " X ".$val["ex_set"]."SET"?>
                                            <?php }?>
                                            </p>
                                        </div>
                                        <!-- 세트가 값이 있을 때 -->
                                        <?php }elseif($val["ex_set"] !== null && empty($val["ex_set"]) !== true){ ?>
                                            <div>
                                            <span class="material-symbols-outlined">settings_accessibility</span>
                                                <p>
                                                    <!-- 횟수에 값 있고 세트에 값이 있을때 -->
                                                <?php if($val["ex_num"] != null && empty($val["ex_num"]) !== true) { ?>
                                                    <?php echo $val["ex_num"]."회 X "?>
                                                <?php }?>
                                                    <?php echo $val["ex_set"]."SET"?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                </div>
                                <div class="box-hour">
                                <!-- 시간, 분 출력 조건 -->
                                    <!-- 시간이 값이 있을 때 -->
                                    <?php if($val["ex_hour"] !== null && empty($val["ex_hour"]) !== true){ ?>
                                        <span class="material-symbols-outlined">av_timer</span>
                                        <div>
                                            <?php echo $val["ex_hour"]."시간"?>
                                            <!-- 시간에 값 있고 분에 값이 있을때 -->
                                            <?php if($val["ex_min"] !== null && empty($val["ex_min"]) !== true) { ?>
                                                <?php echo $val["ex_min"]."분"?>
                                            <?php }?>
                                        </div>
                                    <!-- 분이 값이 있을 때 -->
                                    <?php }elseif($val["ex_min"] !== null && empty($val["ex_min"]) !== true){ ?>
                                        <div>
                                        <span class="material-symbols-outlined">av_timer</span>
                                            <p>
                                                <!-- 시간에 값 있고 분에 값이 있을때 -->
                                            <?php if($val["ex_hour"] != null && empty($val["ex_hour"]) !== true) { ?>
                                                <?php echo $val["ex_hour"]."시간"?>
                                            <?php }?>
                                                <?php echo $val["ex_min"]."분"?>
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php   } ?>
                <!--   //리스트 출력 -->
            </div><!-- end inner -->
            <div class="btn_group">
                    <a href="insert01.php" class="btn">INSERT</a>
                </div>
        </div> <!--end container -->
        
    </div>
</body>
</html>