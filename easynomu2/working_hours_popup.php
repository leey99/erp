<?
$sub_menu = "200411";
include_once("./_common.php");
$sql = " select a.name, b.month, b.workhour_total as rp_sum, b.w_1, b.w_1_hday, b.w_2, b.w_2_hday, b.w_3, b.w_3_hday, money_for_tax from pibohum_base a, pibohum_base_pay_h b where a.com_code='".$code."' and a.sabun='".$id."' and (a.com_code = b.com_code and a.sabun = b.sabun) and ( b.year='".$year."' ) ";
$sql .= " order by b.month ";
//echo $sql;
$result = sql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<meta charset="euc-kr" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.5">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>근로시간/급여(<?=$year?>)</title>
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;">
<div style="margin:5px;">
성명 : <span id="staff_name"></span>
</div>
<div style="margin:5px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
		<tr>
<?
//정렬 기능
if($sod == "asc") $sod_sort = "desc";
else $sod_sort = "asc";
$sort_name = $PHP_SELF."?page=".$page."&sst=a.name&sod=".$sod_sort;
$sort_position = $PHP_SELF."?page=".$page."&sst=b.position&sod=".$sod_sort;
$sort_jumin_no = $PHP_SELF."?page=".$page."&sst=a.jumin_no&sod=".$sod_sort;
$sort_in_day = $PHP_SELF."?page=".$page."&sst=a.in_day&sod=".$sod_sort;
$sort_dept = $PHP_SELF."?page=".$page."&sst=b.dept_1&sod=".$sod_sort;
?>
			<td nowrap class="tdhead_center" rowspan="2" width="50">연</td>
			<td nowrap class="tdhead_center" rowspan="2" width="40">월</td>
			<td nowrap class="tdhead_center" colspan="2" width="">보건복지</td>
			<td nowrap class="tdhead_center" colspan="2" width="">경기도</td>
			<td nowrap class="tdhead_center" colspan="2" width="">화성시</td>
			<td nowrap class="tdhead_center" rowspan="2" width="">합계</td>
			<td nowrap class="tdhead_center" rowspan="2" width="">급여</td>
		</tr>
		<tr>
			<td nowrap class="tdhead_center" width="">평근</td>
			<td nowrap class="tdhead_center" width="">휴심</td>
			<td nowrap class="tdhead_center" width="">평근</td>
			<td nowrap class="tdhead_center" width="">휴심</td>
			<td nowrap class="tdhead_center" width="">평근</td>
			<td nowrap class="tdhead_center" width="">휴심</td>
		</tr>
<?
// 리스트 출력
for($i=0; $row=sql_fetch_array($result); $i++) {
	$name = $row['name'];
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td nowrap class="ltrow1_center" style="font-weight:bold;"><?=$year?></td>
			<td nowrap class="ltrow1_center" style="font-weight:bold;"><?=$row['month']?></td>
			<td nowrap class="ltrow1_center"><?=$row['w_1']?></td>
			<td nowrap class="ltrow1_center"><?=$row['w_1_hday']?></td>
			<td nowrap class="ltrow1_center"><?=$row['w_2']?></td>
			<td nowrap class="ltrow1_center"><?=$row['w_2_hday']?></td>
			<td nowrap class="ltrow1_center"><?=$row['w_3']?></td>
			<td nowrap class="ltrow1_center"><?=$row['w_3_hday']?></td>
			<td nowrap class="ltrow1_center"><?=number_format($row['rp_sum'])?></td>
			<td nowrap class="ltrow1_center"><?=number_format($row['money_for_tax'])?></td>
		</tr>
<?
}
?>
	</table>
</div>
<script type="text/javascript">
//<![CDATA[
function getId(id) {
	return document.getElementById(id);
}
function staff_name_func() {
	getId('staff_name').innerHTML = "<?=$name?>";
}
addLoadEvent(staff_name_func);
//]]>
</script>
</body>
</html>
