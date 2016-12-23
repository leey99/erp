<?
$sub_menu = "200500";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");
$now_time_file = date("Ymd_His");

$mb_id = $member['mb_id'];

//가족보험환급 첨부서류
$upload_dir = 'files/family_insurance/';
$family_file_sql_1 = "";
$family_file_sql_2 = "";
$family_file_sql_3 = "";
$family_file_sql_4 = "";
$family_file_sql_5 = "";
$family_file_sql_6 = "";
//첨부서류 삭제 기능
if($family_file_del_1 == 1) {
	$filename = $upload_dir.$p_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
if($family_file_del_2 == 1) {
	$filename = $upload_dir.$p_file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(2)이 존재하지 않습니다.";
	}
}
if($family_file_del_3 == 1) {
	$filename = $upload_dir.$p_file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(3)이 존재하지 않습니다.";
	}
}
if($family_file_del_4 == 1) {
	$filename = $upload_dir.$p_file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(4)이 존재하지 않습니다.";
	}
}
if($family_file_del_5 == 1) {
	$filename = $upload_dir.$p_file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(5)이 존재하지 않습니다.";
	}
}
if($family_file_del_6 == 1) {
	$filename = $upload_dir.$p_file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(6)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['family_file_1']['tmp_name']) {
	$family_file_name1 = $_FILES['family_file_1']['name'];
	$upload_file_name = $now_time_file."_".$family_file_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['family_file_1']['tmp_name'], $upload_file);
}
if($family_file_name1) {
	$family_file_sql_1 = " family_file_1 = '".addslashes($upload_file_name)."', ";
} else {
	if($family_file_del_1 == 1) $family_file_sql_1 = " family_file_1 = '', ";
}
//첨부서류2
if($_FILES['family_file_2']['tmp_name']) {
	$family_file_name2 = $_FILES['family_file_2']['name'];
	$upload_file_name = $now_time_file."_".$family_file_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['family_file_2']['tmp_name'], $upload_file);
}
if($family_file_name2) {
	$family_file_sql_2 = " family_file_2 = '".addslashes($upload_file_name)."', ";
} else {
	if($family_file_del_2 == 1) $family_file_sql_2 = " family_file_2 = '', ";
}
//첨부서류3
if($_FILES['family_file_3']['tmp_name']) {
	$family_file_name3 = $_FILES['family_file_3']['name'];
	$upload_file_name = $now_time_file."_".$family_file_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['family_file_3']['tmp_name'], $upload_file);
}
if($family_file_name3) {
	$family_file_sql_3 = " family_file_3 = '".addslashes($upload_file_name)."', ";
} else {
	if($family_file_del_3 == 1) $family_file_sql_3 = " family_file_3 = '', ";
}
//첨부서류4
if($_FILES['family_file_4']['tmp_name']) {
	$family_file_name4 = $_FILES['family_file_4']['name'];
	$upload_file_name = $now_time_file."_".$family_file_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['family_file_4']['tmp_name'], $upload_file);
}
if($family_file_name4) {
	$family_file_sql_4 = " family_file_4 = '".addslashes($upload_file_name)."', ";
} else {
	if($family_file_del_4 == 1) $family_file_sql_4 = " family_file_4 = '', ";
}
//첨부서류5
if($_FILES['family_file_5']['tmp_name']) {
	$pic_name5 = $_FILES['family_file_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['family_file_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$family_file_sql_5 = " family_file_5 = '".addslashes($upload_file_name)."', ";
} else {
	if($family_file_del_5 == 1) $family_file_sql_5 = " family_file_5 = '', ";
}
//첨부서류6
if($_FILES['family_file_6']['tmp_name']) {
	$pic_name6 = $_FILES['family_file_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['family_file_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$family_file_sql_6 = " family_file_6 = '".addslashes($upload_file_name)."', ";
} else {
	if($family_file_del_6 == 1) $family_file_sql_6 = " family_file_6 = '', ";
}

//컨설팅 의뢰서 고용창출 메모 저장
$sql_common2 = "
						$family_file_sql_1
						$family_file_sql_2
						$family_file_sql_3
						$family_file_sql_4
						$family_file_sql_5
						$family_file_sql_6

						memo1 = '$memo1',
						family_process = '$family_process'
";
$sql2 = " update com_list_gy_opt set 
			$sql_common2 
			where com_code = '$id' ";
sql_query($sql2);
alert("정상적으로 가족보험료 정보가 수정 되었습니다.","family_insurance_view.php?id=$id&w=$w&page=$page");
?>