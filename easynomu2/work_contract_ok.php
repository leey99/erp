<?
$sub_menu = "100200";
include_once("./_common.php");

//echo $g4[pibohum_base_opt];
//exit;
$g4[pibohum_base_opt] = "pibohum_base_opt";
$now_time = date("Y-m-d H:i:s");

$sql_common = " work_contract = '1' ";

//�߰� �ʵ� ������ ����
$sql1 = " select * from $g4[pibohum_base_opt] where com_code='$code' and sabun='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//echo $total1;
//exit;

//����
if($total1) {
	$sql = " update $g4[pibohum_base_opt] set 
				$sql_common 
			  where com_code='$code' and sabun='$id' ";
	//echo $sql;
	//exit;

//���
}else{
	$sql = " insert $g4[pibohum_base_opt] set 
			$sql_common ";
	//echo $sql;
	//exit;
}
sql_query($sql);
alert("���������� �ۼ��Ϸᰡ �Ǿ����ϴ�.","work_contract.php?id=$id&code=$code&page=$page");
?>