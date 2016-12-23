<?
$sub_menu = "200451";
include_once("./_common.php");
$sql = " select a.name, b.month, b.retirement_pension as rp_sum from pibohum_base a, pibohum_base_pay_h b where a.com_code='".$code."' and a.sabun='".$id."' and (a.com_code = b.com_code and a.sabun = b.sabun) and ( b.year='".$year."' ) ";
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
<title>퇴직연금(<?=$year?>)</title>
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
			<td nowrap class="tdhead_center" width="60">연</td>
			<td nowrap class="tdhead_center" width="45">월</td>
			<td nowrap class="tdhead_center" width="">퇴직연금</td>
		</tr>
<?
// 리스트 출력
for($i=0; $row=sql_fetch_array($result); $i++) {
	$name = $row['name'];
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td nowrap class="ltrow1_center" style="font-weight:bold;"><?=$year?></td>
			<td nowrap class="ltrow1_center" style="font-weight:bold;"><?=$row['month']?></td>
			<td nowrap class="ltrow1_center"><?=number_format($row['rp_sum'])?></td>
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
