<?
$sub_menu = "1900300";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");

//õ�����޸� ����
$client_receipt_fee = str_replace(',','',$_POST['client_receipt_fee']);
$requested_amount = str_replace(',','',$_POST['requested_amount']);
$main_receipt_fee = str_replace(',','',$_POST['main_receipt_fee']);
$allowance_pay = str_replace(',','',$_POST['allowance_pay']);

$sql_common = " w_date = '$now_time',
						com_code = '$id',
						w_user = '$user_id',
						application_kind = '$application_kind',
						person_charge = '$person_charge',

						client_receipt_fee = '$client_receipt_fee',
						allowance_rate = '$allowance_rate',
						allowance_rate_vat_extra = '$allowance_rate_vat_extra',
						grade_income_tax = '$grade_income_tax',

						statement_date = '$statement_date',
						requested_amount = '$requested_amount',
						tax_invoice = '$tax_invoice',
						main_receipt_date = '$main_receipt_date',
						main_receipt_fee = '$main_receipt_fee',
						allowance_pay = '$allowance_pay'
";
//�г� ���� ���� DB
$remainder_date = $statement_date;
$remainder_vat = $client_receipt_fee;
//�����Ա��� ��� �� �ܱ��Ա���, �ܱ� ��� 160912 / �����Ա��� ���� ������ �븮 ��û 161102
//if($main_receipt_date) $sql_common_surplus_master = " remainder_date = '$remainder_date', remainder_vat = '$remainder_vat', ";
if($main_receipt_date) {
	$sql_common_surplus_master = " remainder_date = '$main_receipt_date', remainder_vat = '$remainder_vat', ";
} else {
	$sql_common_surplus_master = " ";
}
$sql_common_surplus = " $sql_common_surplus_master
						requested_amount = '$requested_amount'
";
if($idx) {
	$sql = " update erp_application set $sql_common where idx='$idx' ";
	//�г� ������ ���� 161005
	$sql_surplus_chk = " select * from erp_application_surplus where mid='$mid' and sid='$orderno' ";
	$result_surplus_chk = sql_query($sql_surplus_chk);
	$total_surplus_chk = mysql_num_rows($result_surplus_chk);
	if($total_surplus_chk) 	$sql_surplus = " update erp_application_surplus set $sql_common_surplus where mid='$mid' and sid='$orderno' and requested_amount='$requested_amount' ";
	else $sql_surplus = " insert erp_application_surplus set $sql_common_surplus , mid='$mid' , sid='$orderno' ";
} else {
	$sql = " insert erp_application set $sql_common ";
	$sql_surplus = " insert erp_application_surplus set $sql_common_surplus , mid='$mid' , sid='$orderno' ";
}
//echo $sql_surplus;
//exit;
sql_query($sql);
sql_query($sql_surplus);
alert("���������� ��� �Ǿ����ϴ�.","iframe_electric_collection.php?id=".$id);
?>