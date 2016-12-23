<?
$sub_menu = "1900700";
include_once("./_common.php");

//자동 처리현황 변경 : 검토 151118
$sql_reduction = " select * from com_reduction where idx='$idx' ";
$result_reduction = sql_query($sql_reduction);
$row_reduction = mysql_fetch_array($result_reduction);
$reduction_process = $row_reduction['reduction_process'];
if( $reduction_process == ""|| $reduction_process == 1 ) {
	$sql_common = " update com_reduction set reduction_process='6' where idx = '$idx' ";
	sql_query($sql_common);
}
//데이터베이스
$sql_common = " from com_list_gy a, com_reduction_opt b ";
$sql_search = " where a.com_code = b.com_code and b.mid='$idx' ";
//정렬
if (!$sst) {
    $sst = "b.idx";
    $sod = "asc";
}
$sql_order = " order by $sst $sod ";

$sql = " select * $sql_common $sql_search $sql_order ";
//echo $sql;
$result = sql_query($sql);
$row_com = sql_fetch($sql);

$cell = array("No","사업자등록번호","사업장명","구분","성명","주민등록번호","취득일자","상실일자","연령","직종/상실사유");

$now_date_file = date("Ymd");
$file_name = $row_com['com_name']."_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel;");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel; charset=euc-kr">
<style type="text/css">
table { font-size:10px; }
</style>
<table width='1200' border='1' cellspacing=1 cellpadding=3 bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
<?
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $i + 1;
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	$in_out = $row['in_out'];
	$name = $row['name'];
	$birth_org = $row['birth'];
	$birth = substr($birth_org,0,2).substr($birth_org,3,2).substr($birth_org,6,2)."-";
	$in_day = $row['in_day'];
	$out_day = $row['out_day'];
	$age = $row['age'];
	$quit_case = $row['quit_case'];
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$com_name_full?></td>
				<td align="center"><?=$in_out?></td>
				<td align="center"><?=$name?></td>
				<td align="center"><?=$birth?></td>
				<td align="center"><?=$in_day?></td>
				<td align="center"><?=$out_day?></td>
				<td align="center"><?=$age?></td>
				<td align="left"><?=$quit_case?></td>
			</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
</table>
<?
exit;
?>

