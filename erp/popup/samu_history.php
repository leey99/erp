<?
$sub_menu = "400100";
include_once("../_common.php");
include_once("../../dbconfig_erp.php");
$sql_common = " from samu_history ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where com_code='$id' ";

if (!$sst) {
    $sst = "idx";
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

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "사무위탁 이력";
$g4[title] = $sub_title." : 사무위탁 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 8;
$row=mysql_fetch_array($result);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
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
	<table width="560" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="10" rowspan="">No</td>
			<td class="tdhead_center" width="90" rowspan="">등록일시</td>
			<td class="tdhead_center" rowspan="">등록자ID</td>
			<td class="tdhead_center" width="120" rowspan="">위탁현황</td>
			<td class="tdhead_center" width="70" rowspan="">수임일자</td>
			<td class="tdhead_center" width="70" rowspan="">위탁번호</td>
			<td class="tdhead_center" width="70" rowspan="">해지일자</td>
		</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//등록일시
	$w_date = $row['w_date'];
	//등록자ID
	$w_user = $row['w_user'];
	//위탁현황
	$samu_req_yn = $row['samu_req_yn'];
	$samu_req_yn_arry = array("","반려","수임가능","타수임","수임","해지");
	$samu_req_yn_text = $samu_req_yn_arry[$samu_req_yn];
	//수임일
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	//위탁번호
	if($row['samu_receive_no']) $samu_receive_no = $row['samu_receive_no'];
	else $samu_receive_no = "-";
	//해지일
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_user?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_req_yn_text?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_req_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_receive_no?></td>
			<td class="ltrow1_center_h22" style=""><?=$samu_close_date?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">사무위탁 이력이 없습니다.</td></tr>";
?>
	</table>
</div>
</body>
</html>
