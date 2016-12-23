<?
$sub_menu = "100101";
include_once("./_common.php");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";

if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "전달사항";
$g4['title'] = $sub_title." : 거래처관리 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;


$row=mysql_fetch_array($result);
//master 로그인시 com_code 오류
if(!$com_code) $com_code = $id;
//사업장DB 옵션
$sql1 = " select * from com_list_gy_opt where com_code='$com_code' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

//echo $row[com_code];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_attend=".$stx_attend;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0 10px 10px 10px;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.memo.value == "") {
		alert("내용을 입력하십시오.");
		frm.memo.focus();
		return;
	}
	//공사업체 복수 발송 금지 160831
	if( (frm.contractor.checked && frm.contractor2.checked && frm.contractor3.checked && frm.contractor4.checked && frm.contractor5.checked) || (frm.contractor.checked && frm.contractor2.checked) || (frm.contractor.checked && frm.contractor3.checked) || (frm.contractor.checked && frm.contractor4.checked) || (frm.contractor.checked && frm.contractor5.checked) || (frm.contractor2.checked && frm.contractor3.checked) || (frm.contractor2.checked && frm.contractor4.checked) || (frm.contractor2.checked && frm.contractor5.checked) || (frm.contractor3.checked && frm.contractor4.checked) || (frm.contractor3.checked && frm.contractor5.checked) || (frm.contractor4.checked && frm.contractor5.checked) ) {
		alert("전기공사업체 한 곳만 선택하십시오..");
		return;
	}

	//비밀글 체크 시 담당자 미지정 가능 151117 / 공사업체 4곳 개별 발송 가능 160831
	if(!frm.secret.checked && !frm.contractor.checked && !frm.contractor2.checked && !frm.contractor3.checked && !frm.contractor4.checked) {
<?
//본사 직원 명단 160706
if($member['mb_profile'] == 1) {
	//14 이경훈 신입 전기담당 추가 161004
?>
		if(!frm.send_to1.checked && !frm.send_to2.checked && !frm.send_to3.checked && !frm.send_to4.checked && !frm.send_to5.checked && !frm.send_to6.checked && !frm.send_to7.checked && !frm.send_to8.checked && !frm.send_to9.checked && !frm.send_to10.checked && !frm.send_to14.checked ) {
// && !frm.send_to11.checked && !frm.send_to12.checked && !frm.send_to13.checked
<?
} else {
	//4대보험절감컨설팅 담당자 : 김국진, 임현미, 박소향 161201
?>
		if(!frm.send_to1.checked && !frm.send_to2.checked && !frm.send_to3.checked && !frm.send_to4.checked && !frm.send_to5.checked && !frm.send_to7.checked && !frm.send_to8.checked && !frm.send_to9.checked && !frm.send_to10.checked ) {
<?
}
?>
			alert("담당자를 체크하십시오.");
			return;
		}
	}
	frm.action = "popup_memo_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx,memo_type) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "popup_memo_delete.php?id="+id+"&idx="+idx+"&memo_type="+memo_type;
	}
}
</script>
<?
//덧글
if($memo_type) {
	$sql_comment_search = " and ( memo_type = '$memo_type' ";
	// (본사 or 관리자) and 전기요금 160927
	if( ($member['mb_profile'] == '1' || $member['mb_id'] == 'master') && $memo_type == 11) $sql_comment_search .= " or memo_type = '99' ";
	$sql_comment_search .= " ) ";
}
//비밀글 : 본사, 관리자만 열람 가능 151111
if($member['mb_profile'] != '1' && $member['mb_id'] != 'master') {
	$sql_comment_search .= " and secret != '1' ";
	$sql_comment_search .= " and memo_type != '99' ";
}
//대구남부(지원대상확인, 신규고용확인) 전달사항 지사 전달사항 제거 161007
if($member['mb_level'] <= 6) {
	if($member['mb_profile'] != 16) $sql_comment_search .= " and user_name != '대구남부' ";
}
$sql_comment = " select * from com_list_gy_comment where com_code='$row[com_code]' and delete_yn != '1' $sql_comment_search order by regdt ";
//echo $sql_comment."<br />";
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	if($row_comment['user_id'] == "master") $color = "blue";
	else $color = "#343434";
	//전기공사 업체 전송 전달사항 memo_type=99 파란색 160525
	if($row_comment['memo_type'] == 99) $color = "blue";
	//삭제 권한 설정
	if($member['mb_id'] == $row_comment['user_id'] || $member['mb_id'] == "master") {
		$memo_del_href = "javascript:memo_del('".$com_code."','".$row_comment['idx']."','".$memo_type."')";
		$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	} else {
		$memo_del_href = "javascript:alert('삭제 권한이 없습니다.')";
		$comment_del = " ";
	}
	if($row_comment['secret'] == '1') {
		$icon_secret = " <img src='images/icon_secret.png' width='16' height='15' border='0' style='vertical-align:middle;' alt='비밀글' title='비밀글'>";
		$color = "red";
	} else {
		$icon_secret = "";
	}
	$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;' alt='삭제' title='삭제'></a>";
	//대상자 표시 160905
	$sql_manage = "select * from a4_manage where user_id = '$row_comment[job_id]' and state=1 ";
	$row_manage = sql_fetch($sql_manage);
	$to_name = $row_manage['name'];
	if($to_name) $to_name = "(".$to_name.")";
	else $to_name = "";
	$comment = "<span style='color:".$color.";'><b>".$row_comment['user_name']."</b>(".$row_comment['user_nick'].") : ".$row_comment['memo']."".$to_name."</span> <span>(".str_replace('-','.',$row_comment['regdt']).")</span>".$icon_secret.$comment_del."<br>";
	echo $comment;
}
//지원대상 탭, 경산지사일 경우 자동 체크 151116
if($memo_type == 12 && $member['mb_profile'] == 16) {
	$checked_send_to4 = "checked";
	$checked_secret = "checked";
} else {
	$checked_send_to4 = "";
	$checked_secret = "";
}
?>
<form name="dataForm" method="post" enctype="" style="margin:5px 0 0 0;height:84px;">
	<input type="hidden" name="w" value="<?=$w?>" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="job_id" value="<?=$job_id?>" />
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>" />
	<input type="hidden" name="manage_cust_numb" value="<?=$row1['manage_cust_numb']?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="memo_type" value="<?=$memo_type?>" />
	<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
	<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:5px;margin-right:5px">
		<tr>
			<td>
<?
//본사 직원 명단 160706
if($member['mb_profile'] == 1) {
?>
				<input type="checkbox" name="send_to7" value="kcmc1001"  style="vertical-align:middle" /><b>총괄관리</b>
				<input type="checkbox" name="send_to8" value="kcmc1004"  style="vertical-align:middle" /><b>정경용</b>
				<input type="checkbox" name="send_to5" value="kcmc1009"  style="vertical-align:middle" /><b>김국진</b>
				<input type="checkbox" name="send_to9" value="kcmc2006"  style="vertical-align:middle" /><b>이영래</b>
				<input type="checkbox" name="send_to3" value="kcmc1008"  style="vertical-align:middle" /><b>전정애</b>
				<input type="checkbox" name="send_to1" value="kcmc1007"  style="vertical-align:middle" /><b>임현미</b>
				<input type="checkbox" name="send_to2" value="kcmc1006"  style="vertical-align:middle" /><b>박소향</b>
				<!--<input type="checkbox" name="send_to11" value="kcmc0331"  style="vertical-align:middle" /><b>임영진</b>-->
				<input type="checkbox" name="send_to4" value="kcmc2001" style="vertical-align:middle" /><b>최희용</b>
				<!--<input type="checkbox" name="send_to12" value="kcmc4960" style="vertical-align:middle" /><b>송인혜</b>-->
				<!--<input type="checkbox" name="send_to13" value="kcmc1012" style="vertical-align:middle" /><b>김미정</b>-->
				<input type="checkbox" name="send_to10" value="kcmc2007" style="vertical-align:middle" /><b>박정현</b>
				<input type="checkbox" name="send_to14" value="kcmc1003" style="vertical-align:middle" /><b>이경훈</b>
				<br />
<?
} else {
?>
				<input type="checkbox" name="send_to7" value="kcmc1001"  style="vertical-align:middle" /><b>총괄관리</b>
				<input type="checkbox" name="send_to9" value="electric"  style="vertical-align:middle" /><b>전기담당</b>
				<input type="checkbox" name="send_to10" value="si4n"  style="vertical-align:middle" /><b>4대보험</b>
				<input type="checkbox" name="send_to8" value="kcmc1006,kcmc1009"  style="vertical-align:middle" /><b>사업주훈련</b>
				<input type="checkbox" name="send_to1" value="kcmc1007"  style="vertical-align:middle" /><b>사무위탁</b>
				<!--<input type="checkbox" name="send_to2" value="kcmc1006"  style="vertical-align:middle" /><b>계약서</b>(석정현)-->
				<input type="hidden" name="send_to2" value="">
				<input type="checkbox" name="send_to3" value="kcmc1008"  style="vertical-align:middle" /><b>계약서/대리인선임</b>
				<input type="checkbox" name="send_to4" value="manager" <?=$checked_send_to4?> style="vertical-align:middle" /><b>지원금/부담금</b>
				<input type="checkbox" name="send_to5" value="kcmc1009"  style="vertical-align:middle" /><b>이지노무/가족보험</b>
				<!--<input type="checkbox" name="send_to6" value="kcmc2006"  style="vertical-align:middle" /><b>ERP문의</b>(이영래)-->
				<!--<input type="checkbox" name="send_to9" value="<?=$manage_code?>"  style="vertical-align:middle" /><b>담당자</b>-->
<?
}
//전달사항 권한 : 본사, 관리자, 경산지사->대구남부 151116
if($member['mb_profile'] == 1 || $member['mb_id'] == 'master' || $member['mb_profile'] == 16) {
?>
				<input type="checkbox" name="send_to6" value="branch"  style="vertical-align:middle" /><b>담당지사</b>
				<input type="checkbox" name="secret" value="1" <?=$checked_secret?> style="vertical-align:middle" /><b style="color:red;">비밀글</b>
<?
	if($member['mb_profile'] != 16) {
?>
				<input type="checkbox" name="contractor"  value="1" <?=$checked_contractor?>  style="vertical-align:middle" /><b style="color:blue;"><?=$electric_charges_construct_arry[1]?></b>
				<input type="checkbox" name="contractor2" value="1" <?=$checked_contractor2?> style="vertical-align:middle" /><b style="color:blue;"><?=$electric_charges_construct_arry[2]?></b>
				<input type="checkbox" name="contractor3" value="1" <?=$checked_contractor3?> style="vertical-align:middle" /><b style="color:blue;"><?=$electric_charges_construct_arry[3]?></b>
				<input type="checkbox" name="contractor4" value="1" <?=$checked_contractor4?> style="vertical-align:middle" /><b style="color:blue;"><?=$electric_charges_construct_arry[4]?></b>
				<input type="checkbox" name="contractor5" value="1" <?=$checked_contractor5?> style="vertical-align:middle" /><b style="color:blue;"><?=$electric_charges_construct_arry[5]?></b>
<?
	} else {
		echo "<input type='checkbox' name='contractor'  value='1' style='display:none;' />";
		echo "<input type='checkbox' name='contractor2' value='1' style='display:none;' />";
		echo "<input type='checkbox' name='contractor3' value='1' style='display:none;' />";
		echo "<input type='checkbox' name='contractor4' value='1' style='display:none;' />";
	}
} else {
?>
				<input type="checkbox" name="secret"      value="1" style="display:none;" />
				<input type='checkbox' name='contractor'  value='1' style='display:none;' />
				<input type='checkbox' name='contractor2' value='1' style='display:none;' />
				<input type='checkbox' name='contractor3' value='1' style='display:none;' />
				<input type='checkbox' name='contractor4' value='1' style='display:none;' />
<?
}
?>
				<!--(전달 대상자 미지정시 전체 알림)-->
				<br /><span style="color:blue;">※ 위 담당자 체크시 해당 담당자에게 전송됩니다.</span>
			</td>
		</tr>
	</table> 
	<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:5px">
		<tr>
			<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
			<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();">등록</a></td>
			<td><img src="images/btn9_rt.gif" /></td><td width=2></td>
		</tr>
	</table> 
</form>
</body>
</html>
