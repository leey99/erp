<?
include_once("./_common.php");
/*
//POST��
foreach($_POST as $key => $value) { 
	$$key = $value; // register_globals option ���ϰ�(?) ����ϱ� ���� �κ� 
	if(!is_array($$key)) {
		echo $key." = ".$value."<br>"; 
	} else { 
		for($a=0; $a < sizeof($$key); $a++) 
		echo $key."[".$a."] = ".$value[$a]."<br>"; 
	} 
}
exit;
*/
//���ڹ߼� DB
include_once("../../dbconfig_smsmart.php");
$db2 = mysqli_connect($mysql_host,$mysql_user,$mysql_password);
mysqli_select_db($db2, $mysql_db);
mysqli_query($db2, " set names euckr ");
if(!$to_hp) {
	$msg ="����� ���Ź�ȣ�� ����� �Ѿ���� �ʾҽ��ϴ�. ���� �� �ٽ� �̿� �ٶ��ϴ�.";
	echo $msg;
	exit;
} else {
	$sql = " insert em_tran set tran_phone='$to_hp', tran_callback='$to_sms', tran_status='1', tran_date=sysdate(), tran_msg='$chk1', tran_type=4 ";
	//echo $sql;
	//exit;
	mysqli_query($db2, $sql);
	//$msg ="���������� ���ڹ߼� �Ǿ����ϴ�. <br />â�� �ݾ��ּ���.";
	//echo $msg;
	$msg ="���������� ���ڹ߼� �Ǿ����ϴ�.";
	echo "<script>alert(\"".$msg."\");self.opener=self;self.close();</script>";
	exit;
}
?>