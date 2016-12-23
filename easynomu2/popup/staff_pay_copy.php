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
$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_com = sql_fetch($sql_com);
$com_code = $row_com[com_code];

$sql_common = " from pibohum_base a, pibohum_base_opt b ";

//자기자신은 빠짐
$code_id_array = explode("_", $id);
$code = $code_id_array[0];
$id = $code_id_array[1];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' and a.sabun!='$id' ";
}
//옵션DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";

//echo $stx_name;
// 검색 : 성명
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// 검색 : 사번
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// 검색 : 채용형태
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
// 검색 : 취득여부
//echo $stx_get_ok;
//exit;
if ($stx_get_ok == '0') {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '$stx_get_ok') ";
	$sql_search .= " ) ";
} else if ($stx_get_ok == 1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.apply_gy = '') ";
	$sql_search .= " ) ";
}
//정렬
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//정렬 1순위
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//정렬 2순위
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//정렬 3순위
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
//정렬 4순위
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 200;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
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
			frm.action="staff_pay_copy_update.php";
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
		<H1><IMG alt="" src="images/D109.gif"></H1>
		<P class=logoBg><IMG alt="이지노무" src="images/logoBg_easynomu.gif"></P>
<?
$sql_base = " select * from pibohum_base a, pibohum_base_opt b where a.com_code='$com_code' and a.sabun='$id' and ( (a.com_code = b.com_code and a.sabun = b.sabun) ) ";
$row_base = sql_fetch($sql_base);
//직위
$position = " ";
if($row_base['position']) {
	$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row_base[position] ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position = sql_fetch_array($result_position);
	$position = $row_position['name'];
}
//주민등록번호 뒷 다섯자리 별표 처리
$jumin_no = substr($row_base['jumin_no'],0,9)."*";
//급여구분
$pay_gbn_array = array("월급제","시급제","복합근무","연봉제","-");
$pay_gbn_id = $row_base['pay_gbn'];
if($pay_gbn_id == "") $pay_gbn_id = 4;
$pay_gbn = $pay_gbn_array[$pay_gbn_id];
//급여DB
$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun='$id' ";
$row_opt2 = sql_fetch($sql_opt2);
?>
		<p style="margin:0 0 9px 0">[기준] 성명 : <b><?=$row_base[name]?></b> / 직위 : <?=$position?> / <?=$jumin_no?> / 입사일 : <?=$row_base[in_day]?>
		/ 급여유형 : <?=$pay_gbn?> / 결정임금 : <?=number_format($row_opt2[money_month_base])?></p>
		<P class=full>전체 <SPAN><?=$total_count?></SPAN>개</P>
		<form name="dataForm" method="post" style="margin:0">
		<input type="hidden" name="chk_data">
		<input type="hidden" name="code" value="<?=$code?>">
		<input type="hidden" name="id" value="<?=$id?>">
		<TABLE class=skyTable width="100%" summary="">
			<COLGROUP>
			<COL width="60">
			<COL width="80">
			<COL width="80">
			<COL width="90">
			<COL width="90">
			<COL width="90">
			<COL width="">
			</COLGROUP>
			<THEAD>
				<TR>
					<TH scope=col><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></TH>
					<TH scope=col>성명</TH>
					<TH scope=col>직위</TH>
					<TH scope=col>주민번호</TH>
					<TH scope=col>입사일</TH>
					<TH scope=col>급여유형</TH>
					<TH scope=col>결정임금</TH>
				</TR>
			</THEAD>
		</TABLE>
		<div style="overflow:auto;overflow-x:hidden;height:470px">
			<TABLE class=skyTable2 width="100%" summary="">
				<COLGROUP>
				<COL width="60">
				<COL width="80">
				<COL width="80">
				<COL width="90">
				<COL width="90">
				<COL width="90">
				<COL width="">
				</COLGROUP>
				<TBODY>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//사업장 코드 / 사번 / 코드_사번
	$code = $row['com_code'];
	$id = $row['sabun'];
	$code_id = $code."_".$id;
	//직위
	$position = " ";
	if($row['position']) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position['name'];
	}
	//주민등록번호 뒷 다섯자리 별표 처리
	$jumin_no = substr($row['jumin_no'],0,9)."*";
	//입사일
	if($row['in_day'] == "..") $in_day = "-";
	else if($row['in_day'] == "") $in_day = "-";
	else $in_day = $row['in_day'];
	//급여구분
	$pay_gbn_id = $row['pay_gbn'];
	if($pay_gbn_id == "") $pay_gbn_id = 4;
	$pay_gbn = $pay_gbn_array[$pay_gbn_id];
	//급여DB
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$row_opt2 = sql_fetch($sql_opt2);
	$money_month_base = number_format($row_opt2['money_month_base']);
?>
				<TR>
					<TD class=alignC><INPUT class=select01 type=checkbox value="<?=$code_id?>" name=idx></TD>
					<TD class=alignC><?=$row['name']?></TD>
					<TD class=alignC><?=$position?></TD>
					<TD class=alignC><?=$jumin_no?></TD>
					<TD class=alignC><?=$in_day?></TD>
					<TD class=alignC><?=$pay_gbn?></TD>
					<TD class=alignC><?=$money_month_base?></TD>
				</TR>
<?
}
?>
			</TBODY>
		</TABLE>
		</div>
		<P class=close>
			<A onclick="pay_copy();event.returnValue = false;"  href="#" style="margin:0 10px 0 0"><IMG alt=복사 src="images/btn_copy.gif">
			<A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif"></A>
		</P>
		<DIV style="HEIGHT: 10px"></DIV>
		</form>
	</DIV>
</DIV>
</BODY>
</HTML>
