<?
$mode = "popup";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
//사업장정보
$sql_com = " select * from $g4[com_list_gy] where com_code = '$id' ";
$row_com = sql_fetch($sql_com);

$colspan = 14;
//4대사회보험 정보연계센터 - 직종코드3(139종 신 KECO 코드, 고용,산재)(실제 138개) 검색
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" http-equiv="X-UA-Compatible">
<TITLE>급여복사</TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content=IE=7 http-equiv=X-UA-Compatible>
<META content=text/css http-equiv=Content-Style-Type>
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="css/sj_upjong.css">
<SCRIPT type=text/javascript src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$n) $n = "";
?>
<SCRIPT type="text/javascript">
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function pay_copy() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else {
		//alert(cnt);
		if(confirm("정말 복사 하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="pay_copy_update.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function win_close(){
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
	<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
		<H1><IMG alt="" src="images/D109.gif" /></H1>
		<P class=logoBg><IMG alt="이지노무" src="images/logoBg_kidsnomu.png" /></P>
		<p style="margin:0 0 9px 0;font-size:14px;">[기준] 급여년도 : <strong><?=$send_year?></strong> / 급여월 : <strong><?=$send_month?></strong> / 사업장명 : <?=$row_com['com_name']?></p>
		<P style="margin:0 0 9px 0">
			<strong>해당년도</strong>
			<select name="search_year" class="selectfm" onChange="goSearch();">
<?
if(!$search_year) {
	$search_year = $send_year;
}
for($i=2013;$i<=2015;$i++) {
?>
				<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
			</select> 년
		</P>
		<form name="dataForm" method="post" style="margin:0">
			<input type="hidden" name="chk_data" />
			<input type="hidden" name="code" value="<?=$id?>" />
			<input type="hidden" name="send_year" value="<?=$send_year?>" />
			<input type="hidden" name="send_month" value="<?=$send_month?>" />
			<TABLE class=skyTable width="100%" summary="">
				<COLGROUP>
					<COL width="60">
					<COL width="160">
					<COL width="90">
					<COL width="70">
					<COL width="90">
					<COL width="">
				</COLGROUP>
				<THEAD>
					<TR>
						<TH scope=col><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></TH>
						<TH scope=col>급여대장</TH>
						<TH scope=col>등록여부</TH>
						<TH scope=col>인원</TH>
						<TH scope=col>공제계</TH>
						<TH scope=col>실지급액</TH>
					</TR>
				</THEAD>
			</TABLE>
			<div style="overflow:auto;overflow-x:hidden;height:386px">
				<TABLE class=skyTable2 width="100%" summary="">
					<COLGROUP>
						<COL width="60">
						<COL width="160">
						<COL width="90">
						<COL width="70">
						<COL width="90">
						<COL width="">
					</COLGROUP>
					<TBODY>
<?
// 리스트 출력
for($i=1;$i<=12;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
	//코드값
	$code_id = $search_year."_".$month;
	//등록여부
	$sql_pay = " select count(sabun) as cnt, sum(money_gongje) as money_gongje, sum(money_result) as money_result from pibohum_base_pay where com_code='$id' and year='$search_year' and month='$month' and money_total != '0' ";
	$result_pay = sql_query($sql_pay);
	$row_pay = sql_fetch_array($result_pay);
	//등록여부, 인원
	if($row_pay['cnt'] > 0) {
		$pay_yn = "<strong>등록</strong>";
		$pay_cnt = $row_pay['cnt']."명";
	} else {
		$pay_yn = "-";
		$pay_cnt = "-";
	}
	//공제계
	if($row_pay['money_gongje']) {
		$money_gongje = number_format($row_pay['money_gongje']);
	} else {
		$money_gongje = "-";
	}
	//실지급액
	if($row_pay['money_result']) {
		$money_result = number_format($row_pay['money_result']);
	} else {
		$money_result = "-";
	}
?>
					<TR>
						<TD class="alignC"><input class="select01" type="checkbox" value="<?=$code_id?>" name="idx"></TD>
						<TD class="alignC"><strong><?=$search_year?></strong>년 <strong><?=$month?></strong>월 급여대장</TD>
						<TD class="alignC"><?=$pay_yn?></TD>
						<TD class="alignC"><?=$pay_cnt?></TD>
						<TD class="alignC"><?=$money_gongje?></TD>
						<TD class="alignC"><?=$money_result?></TD>
					</TR>
<?
}
?>
				</TBODY>
			</TABLE>
			</div>
			<P class=close>
				<A onclick="pay_copy();event.returnValue = false;"  href="#" style="margin:0 10px 0 0"><IMG alt=복사 src="images/btn_copy.gif" />
				<A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif" /></A>
			</P>
			<DIV style="HEIGHT: 10px"></DIV>
		</form>
	</DIV>
</DIV>
</BODY>
</HTML>
