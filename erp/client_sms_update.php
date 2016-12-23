<?
$sub_menu = "100500";
include_once("./_common.php");
//문자발송 DB
include_once("../dbconfig_smsmart.php");
$db2 = mysqli_connect($mysql_host,$mysql_user,$mysql_password);
mysqli_select_db($db2, $mysql_db);
mysqli_query($db2, " set names euckr ");
//echo $to_hp;
//줄바꿈 부호 기준으로 배열 생성
$chk_data_array = explode("\r\n", $to_hp);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	//echo $id."<br>";
	//exit;
	if(!$id) {
		$msg ="사업장 대표자HP 값이 제대로 넘어오지 않았습니다.";
		echo $msg;
		exit;
	} else {
		$sql = " insert em_tran set tran_phone='$id', tran_callback='$to_sms', tran_status='1', tran_date=sysdate(), tran_msg='$chk1', tran_type=4 ";
		//echo $sql;
		//exit;
		mysqli_query($db2, $sql);
	}
}
//exit;
alert("정상적으로 문자 발송 되었습니다.","client_sms_list.php?page=".$page."&amp;".$url_qstr);
?>
