<?
$sub_menu = "200100";
include_once("./_common.php");
/*
//POST용
foreach($_POST as $key => $value) { 
	$$key = $value; // register_globals option 편하게(?) 사용하기 위한 부분 
	if(!is_array($$key)) {
		echo $key." = ".$value."<br>"; 
	} else { 
		for($a=0; $a < sizeof($$key); $a++) 
		echo $key."[".$a."] = ".$value[$a]."<br>"; 
	} 
}
//exit;
*/
$now_time = date("Y-m-d H:i:s");
$user_id = $member['mb_id'];
//사업장 정보
$sql_a4 = " select * from com_list_gy where com_code = '$com_code' ";
$row_a4 = sql_fetch($sql_a4);
$comp_name = $row_a4['com_name'];
$comp_adr = $row_a4['com_juso']." ".$row_a4['com_juso2'];
$comp_bznb = $row_a4['t_insureno'];
$comp_tel  = $row_a4['com_tel'];
$comp_email  = $row_a4['com_mail'];
$comp_fax  = $row_a4['com_fax'];
//나열 변수 배열 처리 콤바 구분
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
//보수변경 카운트
$modify_count = 0;
for( $i=0 ; $i < $check_cnt ; $i++) {
	if($chk_data_array[$i]) $id = $chk_data_array[$i];
	$sql_staff = "select * from pibohum_base where com_code='$com_code' and sabun='$id' ";
	$row_staff = sql_fetch($sql_staff);
	//sql_query("delete from a4_modify where id = '$id' ");
	//echo $i$_POST['modify_reason_'.$id];
	//exit;
	if($_POST['modify_reason_'.$id] == "보수인상" || $_POST['modify_reason_'.$id] == "보수인하") {
		$modify_count++;
		$modify_salary = $_POST['money_month_'.$id];
		$modify_insurance = $_POST['isgy_'.$id].",".$_POST['issj_'.$id].",".$_POST['iskm_'.$id].",".$_POST['isgg_'.$id];
		$modify_reason = $_POST['modify_reason_'.$id];
		$modify_date = $_POST['modify_date_'.$id];
		$modify_note = "";
		if($modify_count == 1) {
			$sql = " insert a4_modify set comp_name='$comp_name', comp_adr='$comp_adr', comp_bznb='$comp_bznb', comp_tel='$comp_tel', comp_email='$comp_email', comp_fax = '$comp_fax', modify_name = '$row_staff[name]', modify_ssnb = '$row_staff[jumin_no]', modify_salary = '$modify_salary', modify_date = '$modify_date', modify_insurance = '$modify_insurance', modify_reason = '$modify_reason', modify_note = '$modify_note', user_id = '$user_id', wr_datetime = '$now_time' ";
			//echo $sql;
			//exit;
			sql_query($sql);
			$mid = mysql_insert_id();
		} else {
			$sql2 = " insert a4_modify_opt set modify_name='$row_staff[name]', modify_ssnb='$row_staff[jumin_no]', modify_salary='$modify_salary', modify_date = '$modify_date', modify_insurance = '$modify_insurance', modify_reason = '$modify_reason', modify_note = '$modify_note', mid = '$mid' ";
			sql_query($sql2);
		}
	}
}
alert("정상적으로 변경신고가 등록 되었습니다.","4insure_list.php");
?>
