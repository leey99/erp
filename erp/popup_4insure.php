<?
$sub_menu = "400101";
include_once("./_common.php");
$colspan = 8;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0 4px 0 0;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.report_kind.value == "") {
		alert("신고구분을 입력하십시오.");
		frm.memo.focus();
		return;
	}
	frm.action = "popup_4insure_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx,stx_report_kind) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "popup_4insure_delete.php?id="+id+"&amp;idx="+idx+"&amp;stx_report_kind="+stx_report_kind;
	}
}
//숫자, 하이픈만 입력 가능
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//hyphen 109 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 109 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
//주민등록번호 입력 하이픈
function checkhyphen_ssnb(inputVal, type) {
	main = document.dataForm;
	var chk		= 0;
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	input = delhyphen(inputVal, inputVal.length);
	//탭 시프트+탭 좌 우 Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if(inputVal.length == 6) {
			total += input.substring(0,6)+"-";
		} else {
			total += inputVal;
		}
		type.value = total;
	}
	return total;
}
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-') {		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
</script>
<div style="overflow-y:auto;height:160px;width:100%;margin-bottom:9px;" id="popup_4insure_div">
	<table width="99%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="90" rowspan="">신고구분</td>
			<td class="tdhead_center" width="90" rowspan="">신고일자</td>
			<td class="tdhead_center" width="140" rowspan="">보험구분</td>
			<td class="tdhead_center" width="120" rowspan="">근로자명</td>
			<td class="tdhead_center" width="120" rowspan="">주민등록번호</td>
			<td class="tdhead_center">비고</td>
			<td class="tdhead_center" width="40" rowspan="">삭제</td>
		</tr>
<?
//신고 구분별 검색
if($stx_report_kind) $sql_4insure_search = " and report_kind = '$stx_report_kind' ";
$sql_common = " from samu_4insure ";
$sql_search = " where com_code='$id' and delete_yn != '1' $sql_4insure_search ";
$order_by = " order by regdt desc, idx desc ";
$sql = " select count(*) as cnt $sql_common $sql_search ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$sql_4insure = "  select * $sql_common $sql_search $order_by ";
$result_4insure = sql_query($sql_4insure);
for ($i=0; $row_4insure=sql_fetch_array($result_4insure); $i++) {
	$no = $total_count - $i;
	$idx = $row_4insure['idx'];
	$report_kind = $row_4insure['report_kind'];
	$report_kind_text = $report_kind_arry[$report_kind];
	//등록일자
	$date1 = substr($row_4insure['regdt'],0,10); //날짜표시형식변경
	$samu_4insure_regdt_time = substr($row_4insure['regdt'],11,8); //시간만 표시
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$samu_4insure_regdt = $year.".".$month.".".$day."";
	//보험구분
	$insure_kind = "";
	if($row_4insure['isgy']) $insure_kind = "고용.";
	if($row_4insure['issj']) $insure_kind .= "산재.";
	if($row_4insure['iskm']) $insure_kind .= "연금.";
	if($row_4insure['isgg']) $insure_kind .= "건강.";
	//삭제 권한 설정 : 등록한 자신, 관리자, 임현미(사무위탁 담당자) 151002
	if($member['mb_id'] == $row_4insure['user_id'] || $member['mb_id'] == "master" || $member['mb_id'] == "kcmc1007") {
		$memo_del_href = "javascript:memo_del('".$id."','".$row_4insure['idx']."','".$stx_report_kind."')";
		$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	} else {
		$memo_del_href = "javascript:alert('삭제 권한이 없습니다.')";
		$comment_del = " ";
	}
	$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	//피보험자 성명
	if($row_4insure['staff_name']) $staff_name = $row_4insure['staff_name'];
	else $staff_name = "사업장신고";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22"><?=$no?></td>
			<td class="ltrow1_center_h22"><?=$report_kind_text?></td>
			<td class="ltrow1_center_h22" title="<?=$samu_4insure_regdt_time?>"><?=$samu_4insure_regdt?></td>
			<td class="ltrow1_center_h22"><?=$insure_kind?></td>
			<td class="ltrow1_center_h22"><a href="samu_insure_view.php?id=<?=$id?>&amp;w=u&amp;idx=<?=$idx?>" target="_parent"><strong><?=$staff_name?></strong></a></td>
			<td class="ltrow1_center_h22"><?=$row_4insure['staff_ssnb']?></td>
			<td class="ltrow1_left_h22"><?=$row_4insure['staff_memo']?></td>
			<td class="ltrow1_center_h22" style=""><?=$comment_del?></td>
		</tr>
<?
}
if($i == 0) echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
	</table>
</div>
<form name="dataForm" method="post" enctype="" style="margin:5px 0 0 0;height:84px;">
	<input type="hidden" name="w" value="<?=$w?>" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="stx_report_kind" value="<?=$stx_report_kind?>" />
	<div style="float:left">
		<strong>신고구분</strong>
		<select name="report_kind" class="selectfm">
			<option value="">선택</option>
<?
for($m=1;$m<count($report_kind_arry);$m++) {
?>
			<option value="<?=$m?>" <? if($stx_report_kind == $m) echo "selected"; ?> ><?=$report_kind_arry[$m]?></option>
<?
}
?>
		</select>
		<strong>보험구분</strong>
		<input type="checkbox" name="isgy" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />고용
		<input type="checkbox" name="issj" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />산재
		<input type="checkbox" name="iskm" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />연금
		<input type="checkbox" name="isgg" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />건강
		<strong>근로자명</strong> <input name="staff_name" type="text" class="textfm" style="width:80px;ime-mode:active;" value="" maxlength="14" />
		<strong>주민등록번호</strong> <input name="staff_ssnb" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="" maxlength="14" onkeydown="" onkeyup="checkhyphen_ssnb(this.value, this)" />
		<strong>비고</strong>
		<input name="staff_memo" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$row_4insure['staff_memo']?>" maxlength="30" />
	</div>
	<div style="float:left;padding:4px 0 0 4px;">
		<a href="javascript:goInsert();"><img src="images/btn_reg_gray.png" border="0" /></a>
	</div>
</form>
</body>
</html>
