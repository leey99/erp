<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
//전화번호
if($com_tel1) $com_tel = $com_tel1."-".$com_tel2."-".$com_tel3;
//출발일시
if($start_hour) $start_time = $start_hour.":".$start_min;
//도착일시
if($arrival_hour) $arrival_time = $arrival_hour.":".$arrival_min;

//사업자도장 경로
$upload_dir = 'files/seal/';
if($_FILES['filename']['tmp_name']) {
	$pic_name = $id.".jpg";
	$upload_file = $upload_dir . $pic_name;
	//echo $upload_file;
	//echo $_FILES['filename']['tmp_name'];
	//exit;
	if ( move_uploaded_file($_FILES['filename']['tmp_name'], $upload_file) ) {
		//echo "SUCCESS";
	} else {
		alert("정상적으로 파일 업로드가 되지 않았습니다.\n파일을 확인하신 후 다시 업로드하여 주십시오.","com_view.php?id=$id&code=$code&page=$page");
	}
} else {
	if(!is_file($upload_file)) $pic_name = "";
}
//사진 업로드 안할 때 설정값
if($pic_name) {
	$pic_name_sql = " pic = '$pic_name', ";
} else {
	$pic_name_sql = "";
}

$sql_common = " regdt = '$regdt',
						com_name = '$com_name',
						jumin_no = '$jumin_no',
						com_postno = '$adr_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						age = '$age',
						com_tel = '$com_tel',
						com_fax = '$com_fax',
						com_hp = '$com_hp',
						com_mail = '$com_mail',
						area = '$area',
						teldt = '$teldt',
						memo = '$memo',
						check_health = '$check',
						type = '$type',
						career = '$career',
						vehicle = '$vehicle',
						start_date = '$start',
						start_time = '$start_time',
						arrival = '$arrival',
						arrival_time = '$arrival_time',
						writer = '$writer',
						writer_tel = '$writer_tel',
						view_restrict = '$view_restrict'
";

//인력 추가정보 (현지 전용)
$sql_common2 = " check_ok = '$check_ok',
						safe = '$safe',
						attend = '$attend',
						attend_date = '$attend_date',
						reason = '$reason',
						retire = '$retire',
						etc = '$etc',
						editdt = '$now_time'
";

//추가 필드 데이터 유무
$sql1 = " select * from shipbuilding_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//수정
if ($w == 'u'){
	$sql = " update shipbuilding_gy set 
				$sql_common 
			  where com_code = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
	if($total1) {
		$sql2 = " update shipbuilding_gy_opt set 
					$sql_common2 
					where com_code = '$id' ";
	} else {
		$sql2 = " insert shipbuilding_gy_opt set 
					$sql_common2 
					, com_code = '$id' ";
	}
	sql_query($sql2);
	alert("정상적으로 인력 기본정보가 수정 되었습니다.","shipbuilding_view.php?id=$id&w=$w&page=$page");
//등록
}else{
	$sql_max = "select max(com_code) from shipbuilding_gy ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$id = $row_max[0]+1;
	if(strlen($id) == 4) $id = "0".$id;
	else if(strlen($id) == 3) $id = "00".$id;
	else if(strlen($id) == 2) $id = "000".$id;
	else if(strlen($id) == 1) $id = "0000".$id;
	//echo strlen($id);
	//echo $id;
	//exit;
	$sql = " insert shipbuilding_gy set 
					$sql_common 
					, com_code = '$id' ";
	sql_query($sql);
	if($total1) {
		$sql2 = " update shipbuilding_gy_opt set 
					$sql_common2 
					where com_code = '$id' ";
	} else {
		$sql2 = " insert shipbuilding_gy_opt set 
					$sql_common2 
					, com_code = '$id' ";
	}
	sql_query($sql2);
  //$id = mysql_insert_id();
	alert("정상적으로 인력 기본정보가 등록 되었습니다.","shipbuilding_list.php?page=$page");
}
//echo $sql;
//echo $sql2;
//exit;
//goto_url("./4insure_list.php");
?>