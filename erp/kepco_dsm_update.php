<?
$sub_menu = "1901100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//담당자 설정
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$mb_name = $member['mb_name'];

//첨부파일 경로
$upload_dir = 'files/kepco_dsm/';
$kepco_dsm_file_sql_1 = "";
$kepco_dsm_file_sql_2 = "";
$kepco_dsm_file_sql_3 = "";
$kepco_dsm_file_sql_4 = "";
//첨부서류 삭제 기능
if($kepco_dsm_file_hidden_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($kepco_dsm_file_hidden_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($kepco_dsm_file_hidden_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($kepco_dsm_file_hidden_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['kepco_dsm_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['kepco_dsm_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['kepco_dsm_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$kepco_dsm_file_sql_1 = " kepco_dsm_file_1 = '$upload_file_name', ";
} else {
	if($kepco_dsm_file_hidden_del_1 == 1) $kepco_dsm_file_sql_1 = " kepco_dsm_file_1 = '', ";
}
//첨부서류2
if($_FILES['kepco_dsm_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['kepco_dsm_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['kepco_dsm_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$kepco_dsm_file_sql_2 = " kepco_dsm_file_2 = '$upload_file_name', ";
} else {
	if($kepco_dsm_file_hidden_del_2 == 1) $kepco_dsm_file_sql_2 = " kepco_dsm_file_2 = '', ";
}
//첨부서류3
if($_FILES['kepco_dsm_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['kepco_dsm_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['kepco_dsm_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$kepco_dsm_file_sql_3 = " kepco_dsm_file_3 = '$upload_file_name', ";
} else {
	if($kepco_dsm_file_hidden_del_3 == 1) $kepco_dsm_file_sql_3 = " kepco_dsm_file_3 = '', ";
}
//첨부서류4
if($_FILES['kepco_dsm_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['kepco_dsm_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['kepco_dsm_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$kepco_dsm_file_sql_4 = " kepco_dsm_file_4 = '$upload_file_name', ";
} else {
	if($kepco_dsm_file_hidden_del_4 == 1) $kepco_dsm_file_sql_4 = " kepco_dsm_file_4 = '', ";
}

//본사 권한
if($member['mb_level'] > 6) {
	$sql_common_master = "
						kepco_dsm_process = '$kepco_dsm_process',
	";
} else {
	//지사, 사룬 처리현황 수정 가능 160928
	$sql_common_master = "
						kepco_dsm_process = '$kepco_dsm_process',
	";
}
//제외 필드 160928
/*
						kepco_dsm_down_payment = '$kepco_dsm_down_payment',
						kepco_dsm_down_payment_date = '$kepco_dsm_down_payment_date',
						kepco_dsm_remainder = '$kepco_dsm_remainder',
						kepco_dsm_fee = '$kepco_dsm_fee',
						kepco_dsm_rate1 = '$kepco_dsm_rate1',
						kepco_dsm_rate2 = '$kepco_dsm_rate2',
*/
//사업장 기본정보
$sql_common = "
						kepco_dsm_no = '$kepco_dsm_no',
						kepco_dsm_pw = '$kepco_dsm_pw',

						kepco_dsm_meter = '$kepco_dsm_meter',
						kepco_dsm_start = '$kepco_dsm_start',
						kepco_dsm_end = '$kepco_dsm_end',
						kepco_dsm_capacity = '$kepco_dsm_capacity',

						$sql_common_master

						kepco_dsm_memo = '$kepco_dsm_memo',

						$kepco_dsm_file_sql_1
						$kepco_dsm_file_sql_2
						$kepco_dsm_file_sql_3
						$kepco_dsm_file_sql_4

						kepco_dsm_user = '$mb_name',
						kepco_dsm_editdt = '$now_time'
";
$sql = " update com_list_gy_opt2 set $sql_common where com_code = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
//이력 DB 저장
$sql_kepco_dsm_history = " insert kepco_dsm_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', kepco_dsm_process = '$kepco_dsm_process', 
		kepco_dsm_no = '$kepco_dsm_no', kepco_dsm_down_payment = '$kepco_dsm_down_payment', kepco_dsm_down_payment_date = '$kepco_dsm_down_payment_date', 
		kepco_dsm_remainder = '$kepco_dsm_remainder', kepco_dsm_fee = '$kepco_dsm_fee', 
		kepco_dsm_memo = '$kepco_dsm_memo'
";
sql_query($sql_kepco_dsm_history);

alert("정상적으로 전력수요관리 정보가 수정 되었습니다.","kepco_dsm_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr."&".$stx_qstr);
?>