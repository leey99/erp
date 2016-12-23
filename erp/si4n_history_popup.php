<?
$sub_menu = "1901000";
include_once("./_common.php");
$sql_common = " from si4n_history ";

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
$colspan = 13;

//사업장 기본정보 호출
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

$sub_title = $row_com['com_name'];
$g4[title] = $sub_title." : 4대보험절감컨설팅 이력 : ".$easynomu_name;
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
<div style="padding:0 0 5px 0;">
	<table width="914" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="center">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="70" rowspan="">등록일시</td>
			<td class="tdhead_center" width="76">등록자명</td>
			<td class="tdhead_center" width="62" rowspan="">처리현황</td>
			<td class="tdhead_center" width="70" rowspan="">수수료</td>
			<td class="tdhead_center" width="30" rowspan="">선택</td>
			<td class="tdhead_center" width="76" rowspan="">입금일</td>
			<td class="tdhead_center" width="30" rowspan="">분납</td>
			<td class="tdhead_center">현황1</td>
			<td class="tdhead_center">문제점1</td>
			<td class="tdhead_center">방향1</td>
			<td class="tdhead_center">현황2</td>
			<td class="tdhead_center">문제점2</td>
			<td class="tdhead_center">방향2</td>
			<td class="tdhead_center">처리결과</td>
		</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$idx = $row['idx'];
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
	$si4n_process = $row['si4n_nhis_process'];
	$si4n_process_text = $si4n_nhis_process_arry[$si4n_process];
	if(!$si4n_process) $si4n_process_text = "-";
	//수수료
	if($row['si4n_fee']) $si4n_fee = $row['si4n_fee'];
	else $si4n_fee = "-";
	//선택
	if($row['si4n_fee_choice']) $si4n_fee_choice = $row['si4n_fee_choice'];
	else $si4n_fee_choice = "-";
	//분납
	if($row['si4n_installment']) $si4n_installment = $row['si4n_installment'];
	else $si4n_installment = "-";
	//보수변경
	if($row['si4n_change_date']) $si4n_change_date = $row['si4n_change_date'];
	else $si4n_change_date = "-";
	//셋팅비
	if($row['si4n_setting']) $si4n_setting = $row['si4n_setting'];
	else $si4n_setting = "-";
	//셋팅비입금일
	if($row['si4n_setting_date']) $si4n_setting_date = $row['si4n_setting_date'];
	else $si4n_setting_date = "-";
	//잔금
	if($row['si4n_remainder']) $si4n_remainder = $row['si4n_remainder'];
	else $si4n_remainder = "-";
	//잔금입금일
	if($row['si4n_remainder_date']) $si4n_remainder_date = $row['si4n_remainder_date'];
	else $si4n_remainder_date = "-";

	//컨설팅 1/2안 161213
	if($row['si4n_memo1']) {
		$si4n_memo1_full = $row['si4n_memo1'];
		$si4n_memo1 = cut_str($si4n_memo1_full, 6, "..");
	} else {
		$si4n_memo1 = "";
	}
	if($row['si4n_memo1_condition']) {
		$si4n_memo1_condition_full = $row['si4n_memo1_condition'];
		$si4n_memo1_condition = cut_str($si4n_memo1_condition_full, 6, "..");
	} else {
		$si4n_memo1_condition = "";
	}
	if($row['si4n_memo1_problem']) {
		$si4n_memo1_problem_full = $row['si4n_memo1_problem'];
		$si4n_memo1_problem = cut_str($si4n_memo1_problem_full, 6, "..");
	} else {
		$si4n_memo1_problem = "";
	}
	if($row['si4n_memo2']) {
		$si4n_memo2_full = $row['si4n_memo2'];
		$si4n_memo2 = cut_str($si4n_memo2_full, 6, "..");
	} else {
		$si4n_memo2 = "";
	}
	if($row['si4n_memo2_condition']) {
		$si4n_memo2_condition_full = $row['si4n_memo2_condition'];
		$si4n_memo2_condition = cut_str($si4n_memo2_condition_full, 6, "..");
	} else {
		$si4n_memo2_condition = "";
	}
	if($row['si4n_memo2_problem']) {
		$si4n_memo2_problem_full = $row['si4n_memo2_problem'];
		$si4n_memo2_problem = cut_str($si4n_memo2_problem_full, 6, "..");
	} else {
		$si4n_memo2_problem = "";
	}
	//처리결과
	if($row['si4n_etc']) {
		$si4n_etc_full = $row['si4n_etc'];
		$si4n_etc = cut_str($si4n_etc_full, 6, "..");
	} else {
		$si4n_etc = "";
	}
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22"><?=$no?></td>
			<td class="ltrow1_center_h22" title="<?=$w_time?>"><?=$w_date?></td>
			<td class="ltrow1_center_h22"><?=$w_name?></td>
			<td class="ltrow1_center_h22"><?=$si4n_process_text?></td>
			<td class="ltrow1_center_h22"><?=$si4n_fee?></td>
			<td class="ltrow1_center_h22"><?=$si4n_fee_choice?></td>
			<td class="ltrow1_center_h22"><?=$si4n_setting_date?></td>
			<td class="ltrow1_center_h22"><?=$si4n_installment?></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=condition1"><?=$si4n_memo1_condition?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=problem1"><?=$si4n_memo1_problem?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=memo1"><?=$si4n_memo1?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=condition2"><?=$si4n_memo2_condition?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=problem2"><?=$si4n_memo2_problem?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=memo2"><?=$si4n_memo2?></a></td>
			<td class="ltrow1_center_h22"><a href="si4n_history_popup_memo.php?idx=<?=$idx?>&memo=etc"><?=$si4n_etc?></a></td>
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
