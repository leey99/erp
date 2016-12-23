<?
$sub_menu = "200110";
include_once("./_common.php");

$kind_day = " ( in_day != '' or out_day != '' ) ";
$group_by = " group by in_day, out_day ";

$sql_common = " from pibohum_bak ";
//$sql_search = " where com_code='$code' and sabun='$sabun' and $kind_day ";
$sql_search = " where com_code='$code' and sabun='$sabun' and $kind_day ";

if (!$sst) {
    $sst = "id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
				 $group_by
         $sql_order ";

//echo $sql;
//$row = sql_fetch($sql);
//$total_count = $row[cnt];
$result = sql_query($sql);
$total_count = mysql_num_rows($result);
//echo $total_count;

$rows = 1000;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$kind_text = "입퇴사";

$sub_title = $kind_text." 이력";
$g4['title'] = $sub_title." : 사원관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
				  $group_by
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 4;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:10px;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.memo.value == "")
	{
		alert("내용을 입력하세요.");
		frm.memo.focus();
		return;
	}
	frm.action = "job_education_memo_update.php";
	frm.submit();
	return;
}
</script>
<div style="padding:0 0 5px 0;">
	<table width="400" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="90" rowspan="">입사일</td>
			<td class="tdhead_center" width="90" rowspan="">퇴사일</td>
			<td class="tdhead_center" width="" rowspan="">등록일시</td>
		</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$mid = $row['id'];
	//입/퇴사일
	if($row['in_day']) $in_day = $row['in_day'];
	else $in_day = "-";
	if($row['out_day']) $out_day = $row['out_day'];
	else $out_day = "-";
	//등록일시
	//사원정보 백업 opt2 DB
	$sql_bak_opt2 = " select wr_date from pibohum_bak_opt2 where mid='$mid' ";
	$row_bak_opt2 = sql_fetch($sql_bak_opt2);
	$reg_time = $row_bak_opt2['wr_date'];
	if(!$reg_time) $reg_time = "-";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" style=""><?=$in_day?></td>
			<td class="ltrow1_center_h22" style=""><?=$out_day?></td>
			<td class="ltrow1_center_h22" style=""><?=$reg_time?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">이력이 없습니다.</td></tr>";
?>
	</table>
</div>
</body>
</html>
