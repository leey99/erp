<?
$sub_menu = "200110";
include_once("./_common.php");

$sql_common = " from a4_4insure ";

$sql_search = " where com_code='$code' and ( join_code='$id' or join_code_2='$id' or join_code_3='$id' or join_code_4='$id' or join_code_5='$id' or quit_code='$id' or quit_code_2='$id' or quit_code_3='$id' or quit_code_4='$id' or quit_code_5='$id' ) ";

if (!$sst) {
    $sst = "id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];
//$result = sql_query($sql);
//$total_count = mysql_num_rows($result);
//echo $total_count;

$rows = 1000;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$kind_text = "사회보험";

$sub_title = $kind_text." 신고이력";
$g4['title'] = $sub_title." : 사원관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 5;
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
	<table width="440" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="100" rowspan="">보험구분</td>
			<td class="tdhead_center" width="78" rowspan="">취득일</td>
			<td class="tdhead_center" width="78" rowspan="">상실일</td>
			<td class="tdhead_center" width="" rowspan="">등록일시</td>
		</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//부모 ID
	$mid = $row['id'];
	//보험구분
	$insure_kind = "";
	if($row['join_code'] == $id) {
		if($row['isgy']) $insure_kind .= "고용.";
		if($row['issj']) $insure_kind .= "산재.";
		if($row['iskm']) $insure_kind .= "연금.";
		if($row['isgg']) $insure_kind .= "건강";
	}
	if($row['join_code_2'] == $id) {
		if($row['isgy_2']) $insure_kind .= "고용.";
		if($row['issj_2']) $insure_kind .= "산재.";
		if($row['iskm_2']) $insure_kind .= "연금.";
		if($row['isgg_2']) $insure_kind .= "건강";
	}
	if($row['join_code_3'] == $id) {
		if($row['isgy_3']) $insure_kind .= "고용.";
		if($row['issj_3']) $insure_kind .= "산재.";
		if($row['iskm_3']) $insure_kind .= "연금.";
		if($row['isgg_3']) $insure_kind .= "건강";
	}
	if($row['join_code_4'] == $id) {
		if($row['isgy_4']) $insure_kind .= "고용.";
		if($row['issj_4']) $insure_kind .= "산재.";
		if($row['iskm_4']) $insure_kind .= "연금.";
		if($row['isgg_4']) $insure_kind .= "건강";
	}
	if($row['join_code_5'] == $id) {
		if($row['isgy_5']) $insure_kind .= "고용.";
		if($row['issj_5']) $insure_kind .= "산재.";
		if($row['iskm_5']) $insure_kind .= "연금.";
		if($row['isgg_5']) $insure_kind .= "건강";
	}
	if($row['quit_code'] == $id) {
		if($row['quit_isgy']) $insure_kind .= "고용.";
		if($row['quit_issj']) $insure_kind .= "산재.";
		if($row['quit_iskm']) $insure_kind .= "연금.";
		if($row['quit_isgg']) $insure_kind .= "건강";
	}
	if($row['quit_quit_code_2'] == $id) {
		if($row['quit_isgy_2']) $insure_kind .= "고용.";
		if($row['quit_issj_2']) $insure_kind .= "산재.";
		if($row['quit_iskm_2']) $insure_kind .= "연금.";
		if($row['quit_isgg_2']) $insure_kind .= "건강";
	}
	if($row['quit_quit_code_3'] == $id) {
		if($row['quit_isgy_3']) $insure_kind .= "고용.";
		if($row['quit_issj_3']) $insure_kind .= "산재.";
		if($row['quit_iskm_3']) $insure_kind .= "연금.";
		if($row['quit_isgg_3']) $insure_kind .= "건강";
	}
	if($row['quit_quit_code_4'] == $id) {
		if($row['quit_isgy_4']) $insure_kind .= "고용.";
		if($row['quit_issj_4']) $insure_kind .= "산재.";
		if($row['quit_iskm_4']) $insure_kind .= "연금.";
		if($row['quit_isgg_4']) $insure_kind .= "건강";
	}
	if($row['quit_quit_code_5'] == $id) {
		if($row['quit_isgy_5']) $insure_kind .= "고용.";
		if($row['quit_issj_5']) $insure_kind .= "산재.";
		if($row['quit_iskm_5']) $insure_kind .= "연금.";
		if($row['quit_isgg_5']) $insure_kind .= "건강";
	}
	if(!$insure_kind) $insure_kind = "-";
	//취득일
	$join_date = "";
	if($row['join_code'] == $id && $row['join_date'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_2'] == $id && $row['join_date_2'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_3'] == $id && $row['join_date_3'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_4'] == $id && $row['join_date_4'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if($row['join_code_5'] == $id && $row['join_date_5'] != "0000-00-00 00:00:00") {
		$join_date = substr($row['join_date'],0,10);
	}
	if(!$join_date) $join_date = "-";
	//상실일
	$quit_date = "";
	if($row['quit_code'] == $id && $row['quit_date'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_2'] == $id && $row['quit_date_2'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_3'] == $id && $row['quit_date_3'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_4'] == $id && $row['quit_date_4'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if($row['quit_code_5'] == $id && $row['quit_date_5'] != "0000-00-00 00:00:00") {
		$quit_date = substr($row['quit_date'],0,10);
	}
	if(!$quit_date) $quit_date = "-";
	//등록일시
	$reg_time = $row['wr_datetime'];
	if(!$reg_time) $reg_time = "-";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" style=""><?=$insure_kind?></td>
			<td class="ltrow1_center_h22" style=""><?=$join_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$quit_date?></td>
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
