<?
$sub_menu = "200100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

$mb_id = $member['mb_id'];

for($app_no=1;$app_no<=$app_count;$app_no++) {
	$k = $app_no;
	if($k == 1) $k = "";
	$idx = $_POST['idx'.$k];
	//õ�����޸� ����
	$application_fee_sum = str_replace(',','',$_POST['application_fee_sum'.$k]);
	$client_receipt_fee = str_replace(',','',$_POST['client_receipt_fee'.$k]);
	$requested_amount = str_replace(',','',$_POST['requested_amount'.$k]);
	$main_receipt_fee = str_replace(',','',$_POST['main_receipt_fee'.$k]);
	$main_income = str_replace(',','',$_POST['main_income'.$k]);
	//������ ����
	$application_kind = $_POST['application_kind'.$k];
	$application_review = $_POST['application_review'.$k];
	$application_recognize = $_POST['application_recognize'.$k];
	$application_send = $_POST['application_send'.$k];
	$application_send_no = $_POST['application_send_no'.$k];
	$application_accept = $_POST['application_accept'.$k];
	//��û�Ⱓ/�б� ����
	$application_date_chk = $_POST['application_date_chk'.$k];
	$application_date_start = $_POST['application_date_start'.$k];
	$application_date_end = $_POST['application_date_end'.$k];
	//��û�⵵
	$application_quarter_year = $_POST['application_quarter_year'.$k.'_1'].",".$_POST['application_quarter_year'.$k.'_2'].",".$_POST['application_quarter_year'.$k.'_3'];
	//��û�б�
	$application_quarter = $_POST['application_quarter'.$k.'_1_1'].",".$_POST['application_quarter'.$k.'_1_2'].",".$_POST['application_quarter'.$k.'_1_3'].",".$_POST['application_quarter'.$k.'_1_4']."_".$_POST['application_quarter'.$k.'_2_1'].",".$_POST['application_quarter'.$k.'_2_2'].",".$_POST['application_quarter'.$k.'_2_3'].",".$_POST['application_quarter'.$k.'_2_4']."_".$_POST['application_quarter'.$k.'_3_1'].",".$_POST['application_quarter'.$k.'_3_2'].",".$_POST['application_quarter'.$k.'_3_3'].",".$_POST['application_quarter'.$k.'_3_4'];
	//���ᱸ��
	$close_kind = $_POST['close_kind'.$k];
	//��������
	$close_date = $_POST['close_date'.$k];
	//����⵵
	$close_year = $_POST['close_year'.$k];
	//����б�
	$close_quarter = $_POST['close_quarter'.$k];
	//��û�ֱ�
	$application_cycle = $_POST['application_cycle'.$k];
	//���û����
	$reapplication_date = $_POST['reapplication_date'.$k];
	//�����Ϸ�
	$reapplication_done = $_POST['reapplication_done'.$k];
	//�����Ϸ� : ����
	$reapplication_del = $_POST['reapplication_del'.$k];
	//��ü�Ա���
	$client_receipt_date = $_POST['client_receipt_date'.$k];
	$statement_date = $_POST['statement_date'.$k];
	$tax_invoice = $_POST['tax_invoice'.$k];
	$main_receipt_date = $_POST['main_receipt_date'.$k];
	$receipt_place = $_POST['receipt_place'.$k];
	$person_charge = $_POST['person_charge'.$k];
	$app_memo = $_POST['app_memo'.$k];
	//�������� üũ 160608
	$certification_content = $_POST['certification_content'.$k];
	//�κ��Ա� 161004
	$part_receipt = $_POST['part_receipt'.$k];
	//���ݼ��ݰ�꼭, �����Ա���, ����, �ܱ�������, �ܱ�, �ΰ������� 150925
	$down_payment_tax = $_POST['down_payment_tax'.$k];
	$down_payment_date = $_POST['down_payment_date'.$k];
	$down_payment = str_replace(',','',$_POST['down_payment'.$k]);
	$remainder_date = $_POST['remainder_date'.$k];
	$remainder = str_replace(',','',$_POST['remainder'.$k]);
	$remainder_vat = str_replace(',','',$_POST['remainder_vat'.$k]);
	//������DB
	$sql_common_app = " 
						w_date = '$now_time',
						w_user = '$mb_id',

						application_kind = '$application_kind',
						application_review = '$application_review',
						application_recognize = '$application_recognize',
						application_send = '$application_send',
						application_send_no = '$application_send_no',
						application_accept = '$application_accept',
						application_date_chk = '$application_date_chk',
						application_date_start = '$application_date_start',
						application_date_end = '$application_date_end',
						application_quarter_year = '$application_quarter_year',
						application_quarter = '$application_quarter',
						application_fee_sum = '$application_fee_sum',

						close_kind = '$close_kind',
						close_date = '$close_date',
						close_year = '$close_year',
						close_quarter = '$close_quarter',
						application_cycle = '$application_cycle',

						reapplication_date = '$reapplication_date',
						reapplication_done = '$reapplication_done',

						$cancel_date_sql

						down_payment_tax = '$down_payment_tax',
						down_payment_date = '$down_payment_date',
						down_payment = '$down_payment',
						remainder_date = '$remainder_date',
						remainder = '$remainder',
						remainder_vat = '$remainder_vat',

						client_receipt_date = '$client_receipt_date',
						client_receipt_fee = '$client_receipt_fee',
						statement_date = '$statement_date',
						requested_amount = '$requested_amount',
						tax_invoice = '$tax_invoice',
						main_receipt_date = '$main_receipt_date',
						main_receipt_fee = '$main_receipt_fee',
						main_income = '$main_income',

						receipt_place = '$receipt_place',
						person_charge = '$person_charge',

						damdang_code_app = '$damdang_code',
						damdang_code_app2 = '$damdang_code2',

						certification_content = '$certification_content',
						part_receipt = '$part_receipt',

						app_memo = '$app_memo'
	";
	//������DB ������ ����
	$sql2 = " select * from erp_application where idx='$idx' ";
	$row2 = sql_fetch($sql2);
	$idx = $row2['idx'];
	$reapplication_done_org = $row2['reapplication_done'];

	//������� : �ݷ�2, ���3
	if($reapplication_done == 2 || $reapplication_done == 3) {
		$cancel_date = $now_date;
		//�����Ϸ� �ݷ�, ��� �� ������� ���� 161205
		if($reapplication_done_org != 2 && $reapplication_done_org != 3) {
			$cancel_date_sql = " cancel_date = '$cancel_date', ";
		} else {
			$cancel_date_sql = "";
		}
	} else {
		$cancel_date = "";
		$cancel_date_sql = " cancel_date = '$cancel_date', ";
	}

	if($idx) {
		if(!$reapplication_del) {
			$sql_app = " update erp_application set 
						$cancel_date_sql
						$sql_common_app 
						where idx = '$idx'
			";
		} else {
			$sql_app = " delete from erp_application
						where idx = '$idx'
			";
		}
	} else {
		$sql_app = " insert erp_application set 
					$cancel_date_sql
					$sql_common_app 
		";
	}
	//echo $sql_app."<br><br>";
	sql_query($sql_app);
}
alert("���������� ������ ������ ���� �Ǿ����ϴ�.","client_application_view.php?id=$id&w=$w&page=$page");
?>