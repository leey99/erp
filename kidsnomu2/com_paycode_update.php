<?
$sub_menu = "100300";
include_once("./_common.php");

$g4[com_paycode_list] = "com_paycode_list";
$now_time = date("Y-m-d H:i:s");

$sql_common = "
						item = '$item',
						name = '$pay_name',
						memo = '$memo',
						calculate = '$calculate',
						tax_limit = '$tax_limit',
						multiple = '$multiple',

						auto = '$auto',
						gy_yn = '$gy_yn',
						retirement = '$retirement',
						income = '$income' ";

//����
if ($w == 'u'){
	$sql = " update $g4[com_paycode_list] set 
				$sql_common 
			  where com_code = '$com_code' and code = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
	alert("���������� �޿� �����ڵ尡 ���� �Ǿ����ϴ�.","com_paycode_list.php?item=$item");

//���
}else{
	$sql = " insert $g4[com_paycode_list] set 
					$sql_common
					,com_code = '$com_code'
				";
	//echo $sql;
	//exit;
	sql_query($sql);
	alert("���������� �޿� �����ڵ尡 �߰� �Ǿ����ϴ�.","com_paycode_list.php?item=$item");
}

//goto_url("./4insure_list.php");
?>