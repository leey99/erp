<?
$sub_menu = "1900100";
include_once("./_common.php");
$sql_common = " from electric_charges_history ";

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
$g4[title] = $sub_title." : 전기요금컨설팅 이력 : ".$easynomu_name;
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
			<td class="tdhead_center" width="78" rowspan="">전기료1년</td>
			<td class="tdhead_center" width="76" rowspan="">절감예상금액</td>
			<td class="tdhead_center" width="76" rowspan="">한전불입금</td>
			<td class="tdhead_center" width="64" rowspan="">계약전력</td>
			<td class="tdhead_center" width="64" rowspan="">처리결과</td>
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
	$electric_charges_process = $row['electric_charges_process'];
	$electric_charges_process_text = $electric_charges_process_arry[$electric_charges_process];
	if(!$electric_charges_process) $electric_charges_process_text = "-";
	//전기료
	if($row['electric_charges_year_fee']) $electric_charges_year_fee = $row['electric_charges_year_fee'];
	else $electric_charges_year_fee = "-";
	//절감예상금액
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else $electric_charges_reduce = "-";
	//한전불입금
	if($row['electric_charges_payments']) $electric_charges_payments = $row['electric_charges_payments'];
	else $electric_charges_payments = "-";
	//계약전력
	if($row['electric_charges_watt']) $electric_charges_watt = $row['electric_charges_watt']."kW";
	else $electric_charges_watt = "-";
	//처리결과
	if($row['electric_charges_etc']) {
		$electric_charges_etc_full = $row['electric_charges_etc'];
		$electric_charges_etc = cut_str($electric_charges_etc_full, 8, "..");
	} else {
		$electric_charges_etc = "-";
	}
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22" style=""><?=$no?></td>
			<td class="ltrow1_center_h22" title="<?=$w_time?>"><?=$w_date?></td>
			<td class="ltrow1_center_h22" style=""><?=$w_name?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_process_text?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_year_fee?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_reduce?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_payments?></td>
			<td class="ltrow1_center_h22" style=""><?=$electric_charges_watt?></td>
			<td class="ltrow1_center_h22" title="<?=$electric_charges_etc_full?>"><?=$electric_charges_etc?></td>
		</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">전기요금컨설팅 이력이 없습니다.</td></tr>";
?>
	</table>
</div>
</body>
</html>
