<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
//��ȭ��ȣ
if($com_tel1) $com_tel = $com_tel1."-".$com_tel2."-".$com_tel3;
//����Ͻ�
if($start_hour) $start_time = $start_hour.":".$start_min;
//�����Ͻ�
if($arrival_hour) $arrival_time = $arrival_hour.":".$arrival_min;

//����ڵ��� ���
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
		alert("���������� ���� ���ε尡 ���� �ʾҽ��ϴ�.\n������ Ȯ���Ͻ� �� �ٽ� ���ε��Ͽ� �ֽʽÿ�.","com_view.php?id=$id&code=$code&page=$page");
	}
} else {
	if(!is_file($upload_file)) $pic_name = "";
}
//���� ���ε� ���� �� ������
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

//�η� �߰����� (���� ����)
$sql_common2 = " check_ok = '$check_ok',
						safe = '$safe',
						attend = '$attend',
						attend_date = '$attend_date',
						reason = '$reason',
						retire = '$retire',
						etc = '$etc',
						editdt = '$now_time'
";

//�߰� �ʵ� ������ ����
$sql1 = " select * from shipbuilding_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//����
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
	alert("���������� �η� �⺻������ ���� �Ǿ����ϴ�.","shipbuilding_view.php?id=$id&w=$w&page=$page");
//���
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
	alert("���������� �η� �⺻������ ��� �Ǿ����ϴ�.","shipbuilding_list.php?page=$page");
}
//echo $sql;
//echo $sql2;
//exit;
//goto_url("./4insure_list.php");
?>