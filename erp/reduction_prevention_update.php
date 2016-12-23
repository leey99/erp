<?
$sub_menu = "1900700";
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
$upload_dir = 'files/reduction_file/';

//명부(지사)
$in_file_sql_1 = "";
$in_file_sql_2 = "";
$in_file_sql_3 = "";
$in_file_sql_4 = "";
//첨부서류 삭제 기능
if($in_file_del_1 == 1) {
	$filename = $upload_dir.$i_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($in_file_del_2 == 1) {
	$filename = $upload_dir.$i_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo ".파일(2)이 존재하지 않습니다.";
	}
}
if($in_file_del_3 == 1) {
	$filename = $upload_dir.$i_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($in_file_del_4 == 1) {
	$filename = $upload_dir.$i_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['in_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['in_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['in_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$in_file_sql_1 = " in_file_1 = '$upload_file_name', ";
} else {
	if($in_file_del_1 == 1) $in_file_sql_1 = " in_file_1 = '', ";
}
//첨부서류2
if($_FILES['in_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['in_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['in_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$in_file_sql_2 = " in_file_2 = '$upload_file_name', ";
} else {
	if($in_file_del_2 == 1) $in_file_sql_2 = " in_file_2 = '', ";
}
//첨부서류3
if($_FILES['in_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['in_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['in_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$in_file_sql_3 = " in_file_3 = '$upload_file_name', ";
} else {
	if($in_file_del_3 == 1) $in_file_sql_3 = " in_file_3 = '', ";
}
//첨부서류4
if($_FILES['in_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['in_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['in_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$in_file_sql_4 = " in_file_4 = '$upload_file_name', ";
} else {
	if($in_file_del_4 == 1) $in_file_sql_4 = " in_file_4 = '', ";
}
//명부(본사)
$out_file_sql_1 = "";
$out_file_sql_2 = "";
$out_file_sql_3 = "";
$out_file_sql_4 = "";
//첨부서류 삭제 기능
if($out_file_del_1 == 1) {
	$filename = $upload_dir.$o_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($out_file_del_2 == 1) {
	$filename = $upload_dir.$o_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($out_file_del_3 == 1) {
	$filename = $upload_dir.$o_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($out_file_del_4 == 1) {
	$filename = $upload_dir.$o_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['out_file_1']['tmp_name']) {
	$pic_name1 = $_FILES['out_file_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['out_file_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$out_file_sql_1 = " out_file_1 = '$upload_file_name', ";
} else {
	if($out_file_del_1 == 1) $out_file_sql_1 = " out_file_1 = '', ";
}
//첨부서류2
if($_FILES['out_file_2']['tmp_name']) {
	$pic_name2 = $_FILES['out_file_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['out_file_2']['tmp_name'], $upload_file);
} else {
	$pic_name2 = "";
}
if($pic_name2) {
	$out_file_sql_2 = " out_file_2 = '$upload_file_name', ";
} else {
	if($out_file_del_2 == 1) $out_file_sql_2 = " out_file_2 = '', ";
}
//첨부서류3
if($_FILES['out_file_3']['tmp_name']) {
	$pic_name3 = $_FILES['out_file_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['out_file_3']['tmp_name'], $upload_file);
} else {
	$pic_name3 = "";
}
if($pic_name3) {
	$out_file_sql_3 = " out_file_3 = '$upload_file_name', ";
} else {
	if($out_file_del_3 == 1) $out_file_sql_3 = " out_file_3 = '', ";
}
//첨부서류4
if($_FILES['out_file_4']['tmp_name']) {
	$pic_name4 = $_FILES['out_file_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['out_file_4']['tmp_name'], $upload_file);
} else {
	$pic_name4 = "";
}
if($pic_name4) {
	$out_file_sql_4 = " out_file_4 = '$upload_file_name', ";
} else {
	if($out_file_del_4 == 1) $out_file_sql_4 = " out_file_4 = '', ";
}
//자동 처리현황 검토 변경 151118 (검토 파일 업로드 필수, 처리현황 미선택, 의뢰일 경우)
if( ($reduction_process == "") && ($in_file_sql_1 || $out_file_sql_1) ) $reduction_process = 1;
//관리자, 본사
if( ($is_admin == "super" || $member['mb_level'] != 6) ) {
	//관리 권한 필드 정의
	$sql_common_opt2_master = "
							reduction_memo = '$reduction_memo',
							reduction_process = '$reduction_process',
	";
} else {
	$sql_common_opt2_master = "
							reduction_memo = '$reduction_memo',
							reduction_process = '$reduction_process',
	";
}
//사업장 정보 추가2 DB
$sql_common_opt2 = "
							$sql_common_opt2_master

							$in_file_sql_1
							$in_file_sql_2
							$in_file_sql_3
							$in_file_sql_4

							$out_file_sql_1
							$out_file_sql_2
							$out_file_sql_3
							$out_file_sql_4

							before_month = '$stx_before_month',
							after_month = '$stx_after_month',
							before_month2 = '$stx_before_month2',
							after_month2 = '$stx_after_month2',

							reduction_user = '$mb_name',
							reduction_editdt = '$now_time'
";
// 데이터2 유무
$sql2 = " select * from com_reduction where com_code='$id' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
//데이터2 존재 시 update, 미존재 시 insert
if($row2['com_code']) {
	$sql_opt2 = " update com_reduction set 
				$sql_common_opt2 
				where com_code = '$id' ";
} else {
	$sql_opt2 = " insert com_reduction set 
				$sql_common_opt2 
				, com_code = '$id' ";
}
sql_query($sql_opt2);
//완료 후 페이지 이동
alert("정상적으로 감정방지기간조회 정보가 수정 되었습니다.","reduction_prevention_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr);
?>