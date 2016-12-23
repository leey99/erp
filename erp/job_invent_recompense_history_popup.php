<?
$sub_menu = "1900100";
include_once("./_common.php");
$sql_common = " from job_invent_history ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where com_code='$id' ";

if (!$sst) {
    $sst = "w_date";
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

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 10;

//사업장 기본정보 호출
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

$sub_title = $row_com['com_name'];
$g4[title] = $sub_title." : 직무발명보상제도 이력 : ".$easynomu_name;
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
	<table width="604" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="70" rowspan="">등록일시</td>
			<td class="tdhead_center" rowspan="">등록자명</td>
			<td class="tdhead_center" width="62" rowspan="">처리현황</td>
			<td class="tdhead_center" width="70" rowspan="">계약금</td>
			<td class="tdhead_center" width="70" rowspan="">계약입금일</td>
			<td class="tdhead_center" width="76" rowspan="">잔금</td>
			<td class="tdhead_center" width="76" rowspan="">전체수수료</td>
			<td class="tdhead_center" width="64" rowspan="">상담메모</td>
		</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//등록일시
	//$w_date = $row['w_date'];
	//등록일자
	$date1 = substr($row['w_date'],0,10); //날짜표시형식변경
	$w_time = substr($row['w_date'],11,8); //시간만 표시
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$w_date = $year.".".$month.".".$day."";
	//등록자ID
	$w_user = $row['w_user'];
	//등록자명
	$w_name = $row['w_name'];
	//위탁현황
	$job_invent_process = $row['job_invent_process'];
	$job_invent_process_text = $job_invent_process_arry[$job_invent_process];
	if(!$job_invent_process) $job_invent_process_text = "-";
	//계약금
	if($row['job_invent_down_payment']) $job_invent_down_payment = $row['job_invent_down_payment'];
	else $job_invent_down_payment = "-";
	//계약입금일
	if($row['job_invent_down_payment_date']) $job_invent_down_payment_date = $row['job_invent_down_payment_date'];
	else $job_invent_down_payment_date = "-";
	//잔금
	if($row['job_invent_payments']) $job_invent_payments = $row['job_invent_payments'];
	else $job_invent_payments = "-";
	//잔금
	if($row['job_invent_fee']) $job_invent_fee = $row['job_invent_fee'];
	else $job_invent_fee = "-";
	//상담메모
	if($row['job_invent_memo']) {
		$job_invent_memo_full = $row['job_invent_memo'];
		$job_invent_memo = cut_str($job_invent_memo_full, 8, "..");
	} else {
		$job_invent_memo = "-";
	}
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" title="<?=$w_time?>"><?=$w_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_name?></td>
			<td class="ltrow1_center_h22" style=""><?=$job_invent_process_text?></td>
			<td class="ltrow1_center_h22" style=""><?=$job_invent_down_payment?></td>
			<td class="ltrow1_center_h22" style=""><?=$job_invent_reduce?></td>
			<td class="ltrow1_center_h22" style=""><?=$job_invent_payments?></td>
			<td class="ltrow1_center_h22" style=""><?=$job_invent_fee?></td>
			<td class="ltrow1_center_h22" title="<?=$job_invent_memo_full?>"><?=$job_invent_memo?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">저장된 이력이 없습니다.</td></tr>";
?>
	</table>
</div>
</body>
</html>
