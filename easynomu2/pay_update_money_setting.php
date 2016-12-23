<?
$sub_menu = "100300";
include_once("./_common.php");

$code = "20022";
//$where = " where com_code = '$code' ";
$where = " where 1=1 ";

//기존 데이터 유무
$sql = "select * from pibohum_base_pay 
					$where ";
//echo $sql_opt1;
//exit;
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {

	$sql_common = " 
							money_setting = '$row[money_total]'
							";

	$sql = "update pibohum_base_pay set 
				$sql_common 
				where com_code = '$row[com_code]' and sabun = '$row[sabun]' and year = '$row[year]' and month = '$row[month]' ";
	echo $sql;
	//exit;
	sql_query($sql);
}
?>