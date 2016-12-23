<?
$sub_menu = "1901000";
include_once("./_common.php");

$sql_common = " from si4n_nhis_pay ";

$sql_a4 = " select * from com_list_gy where com_code = '$id' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $id;
$com_name = $row_a4['com_name'];

$colspan = 11;

//급여대장
$sql_search = " where com_code='$com_code' ";
$sql_order = " order by sabun+0 asc ";
$from_record = 0;
//$rows = 7;

//급여대장 근로자수
$sql = " select count(*) as cnt
          $sql_common
          $sql_search $sql_search2 ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
//echo $total_count;
$rows = $total_count;
$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$file_name = "절감결과1_".$com_name.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:x="urn:schemas-microsoft-com:office:excel">
<style type="text/css">
<!--
/*excel cell annexation line feed*/
<?=iconv("EUC-KR", "UTF-8", "/*엑셀 셀병합 줄바꿈*/\n")?>
br{mso-data-placement:same-cell;}
-->
</style>
<table border="1" cellspacing="1" cellpadding="3">
	<tr>
		<td align="left" colspan="7"><?=iconv("EUC-KR", "UTF-8", "4대보험절감결과")?> : <?=iconv("EUC-KR", "UTF-8", $com_name)?></td>
	</tr>
	<tr>
		<td bgcolor="#65CBFF" align="center" rowspan="2" width="40"><?=iconv("EUC-KR", "UTF-8", "연번")?></td>
		<td bgcolor="#65CBFF" align="center" colspan="3"><?=iconv("EUC-KR", "UTF-8", "급여정보")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2" width="100"><?=iconv("EUC-KR", "UTF-8", "변경전<br />4대보험합계")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2" width="100"><?=iconv("EUC-KR", "UTF-8", "변경후<br />4대보험합계")?></td>
		<td bgcolor="#65CBFF" align="center" rowspan="2" width="100"><?=iconv("EUC-KR", "UTF-8", "절감금액")?></td>
	</tr>
	<tr>
		<td bgcolor="#65CBFF" align="center" width="100"><?=iconv("EUC-KR", "UTF-8", "(변경전)")?></td>
		<td bgcolor="#65CBFF" align="center" width="100"><?=iconv("EUC-KR", "UTF-8", "(절감액)")?></td>
		<td bgcolor="#65CBFF" align="center" width="100"><?=iconv("EUC-KR", "UTF-8", "(변경후)")?></td>
	</tr>

<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$money_for_tax_sum = $money_for_tax_sum + $row['money_for_tax'];
	$tax_exemption_sum = $tax_exemption_sum + $row['tax_exemption'];
	$money2_for_tax_sum = $money2_for_tax_sum + $row['money2_for_tax'];
	$yun_sum = $yun_sum + $row['yun'];
	$health_sum = $health_sum + $row['health'];
	$yoyang_sum = $yoyang_sum + $row['yoyang'];
	$goyong_sum = $goyong_sum + $row['goyong'];
	$c_yun_sum = $c_yun_sum + $row['c_yun'];
	$c_health_sum = $c_health_sum + $row['c_health'];
	$c_yoyang_sum = $c_yoyang_sum + $row['c_yoyang'];
	$c_goyong_sum = $c_goyong_sum + $row['c_goyong'];
	$c_sanjae_sum = $c_sanjae_sum + $row['c_sanjae'];
	$money_gongje_sum = $money_gongje_sum + $row['money_gongje'];
	$yun2_sum = $yun2_sum + $row['yun2'];
	$health2_sum = $health2_sum + $row['health2'];
	$yoyang2_sum = $yoyang2_sum + $row['yoyang2'];
	$goyong2_sum = $goyong2_sum + $row['goyong2'];
	$c_yun2_sum = $c_yun2_sum + $row['c_yun2'];
	$c_health2_sum = $c_health2_sum + $row['c_health2'];
	$c_yoyang2_sum = $c_yoyang2_sum + $row['c_yoyang2'];
	$c_goyong2_sum = $c_goyong2_sum + $row['c_goyong2'];
	$c_sanjae2_sum = $c_sanjae2_sum + $row['c_sanjae2'];
	$money2_gongje_sum = $money2_gongje_sum + $row['money2_gongje'];

	$money_result_sum = $money_result_sum + $row['money_result'];
?>
	<tr>
		<td align="center"><?=$row['sabun']?></td>
		<td align="center"><?=number_format($row['money_for_tax'])?></td>
		<td align="center"><?=number_format($row['tax_exemption'])?></td>
		<td align="center"><?=number_format($row['money2_for_tax'])?></td>
		<td align="center"><?=number_format($row['money_gongje'])?></td>
		<td align="center"><?=number_format($row['money2_gongje'])?></td>
		<td align="center"><?=number_format($row['money_result'])?></td>
	</tr>
<?
}
?>
	<tr>
		<td bgcolor="#e2e2e2" align="center"><?=iconv("EUC-KR", "UTF-8", "합계")?></td>
		<td bgcolor="#e2e2e2" align="center"><?=number_format($money_for_tax_sum)?></td>
		<td bgcolor="#e2e2e2" align="center"><?=number_format($tax_exemption_sum)?></td>
		<td bgcolor="#e2e2e2" align="center"><?=number_format($money2_for_tax_sum)?></td>
		<td bgcolor="#e2e2e2" align="center"><?=number_format($money_gongje_sum)?></td>
		<td bgcolor="#e2e2e2" align="center"><?=number_format($money2_gongje_sum)?></td>
		<td bgcolor="#e2e2e2" align="center"><?=number_format($money_result_sum)?></td>
	</tr>
</table>			
</body>
</html>
