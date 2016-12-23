<?
$sub_menu = "100200";
include_once("./_common.php");

$g4[com_code_list] = "com_code_list";
$now_time = date("Y-m-d H:i:s");

//$use_yn = "Y";
$sql_where = " com_code = '$com_code' and item = '$item' ";
$sql_delete = "delete from $g4[com_code_list] where $sql_where ";
sql_query($sql_delete);

$sql_reset = " select * from $g4[com_code_list] where com_code = '00001' and item = '$item' ";
$result_reset = sql_query($sql_reset);
for($i=0; $row_reset=sql_fetch_array($result_reset); $i++) {
	//echo "$row_reset[name]";
	$sql_common = " com_code = '$com_code',
									code = '$row_reset[code]',
									item = '$row_reset[item]',
									name = '$row_reset[name]',
									rate = '$row_reset[rate]',
									memo = '$row_reset[memo]',
									use_yn = '$row_reset[use_yn]',
									rank = '$row_reset[rank]',
									amount = '$row_reset[amount]'
								";
	$sql_insert = " insert $g4[com_code_list] set $sql_common ";
	//echo $sql_insert."<br>";
	sql_query($sql_insert);
}
//alert("정상적으로 코드가 수정 되었습니다.","com_code_list.php?item=$item&page=$page");
$url = "com_code_list.php?item=$item&page=$page";
?>
<script language="javascript">
location.href = "<?=$url?>";
</script>