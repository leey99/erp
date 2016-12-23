<?
$sub_menu = "100301";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$g4[com_paycode_list] = "com_paycode_list";
$now_time = date("Y-m-d H:i:s");

//$use_yn = "Y";
$sql_where = " com_code = '$com_code' and item = '$item' ";
$sql_delete = "delete from $g4[com_paycode_list] where $sql_where ";
sql_query($sql_delete);

$sql_reset = " select * from $g4[com_paycode_list] where com_code = '00002' and item = '$item' ";
$result_reset = sql_query($sql_reset);
for($i=0; $row_reset=sql_fetch_array($result_reset); $i++) {
	//echo "$row_reset[name]";
	$sql_common = " com_code = '$com_code',
									code = '$row_reset[code]',
									item = '$row_reset[item]',
									name = '$row_reset[name]',
									auto = '$row_reset[auto]',
									calculate = '$row_reset[calculate]',
									tax_limit = '$row_reset[tax_limit]',
									gy_yn = '$row_reset[gy_yn]',
									retirement = '$row_reset[retirement]',
									multiple = '$row_reset[multiple]',
									income = '$row_reset[income]',
									tax_exemption = '$row_reset[tax_exemption]',
									memo = '$row_reset[memo]'
								";
	$sql_insert = " insert $g4[com_paycode_list] set $sql_common ";
	//echo $sql_insert."<br>";
	sql_query($sql_insert);
}
alert("정상적으로 코드가 초기화 되었습니다.","com_paycode_list.php?item=$item&page=$page");
?>