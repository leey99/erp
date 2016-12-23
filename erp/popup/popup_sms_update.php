<?
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
exit;
*/
//문자발송 DB
include_once("../../dbconfig_smsmart.php");
$db2 = mysqli_connect($mysql_host,$mysql_user,$mysql_password);
mysqli_select_db($db2, $mysql_db);
mysqli_query($db2, " set names euckr ");
if(!$to_hp) {
	$msg ="사업장 수신번호가 제대로 넘어오지 않았습니다. 종료 후 다시 이용 바랍니다.";
	echo $msg;
	exit;
} else {
	$sql = " insert em_tran set tran_phone='$to_hp', tran_callback='$to_sms', tran_status='1', tran_date=sysdate(), tran_msg='$chk1', tran_type=4 ";
	//echo $sql;
	//exit;
	mysqli_query($db2, $sql);
	//$msg ="정상적으로 문자발송 되었습니다. <br />창을 닫아주세요.";
	//echo $msg;
	$msg ="정상적으로 문자발송 되었습니다.";
	echo "<script>alert(\"".$msg."\");self.opener=self;self.close();</script>";
	exit;
}
?>