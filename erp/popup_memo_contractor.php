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
	frm.action = "popup_memo_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx,memo_type) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "popup_memo_delete.php?id="+id+"&idx="+idx+"&memo_type="+memo_type+"&dealer=contractor";
	}
}
</script>
<?
//덧글
//전기공사 권한 : memo_type = 99
if($memo_type) $sql_comment_search = " and memo_type = '$memo_type' ";
//공사업체 서로 전달사항 열람 불가
if($member['mb_id'] == "el1001") $sql_comment_search .= " and ( user_id != 'el1002' and user_id != 'el1003' and user_id != 'el1004' and user_id != 'el001' ) ";
else if($member['mb_id'] == "el1002") $sql_comment_search .= " and ( user_id != 'el1001' and user_id != 'el1003' and user_id != 'el1004' and user_id != 'el002' ) ";
else if($member['mb_id'] == "el1003") $sql_comment_search .= " and ( user_id != 'el1001' and user_id != 'el1002' and user_id != 'el1004' and user_id != 'el003' ) ";
else if($member['mb_id'] == "el1004") $sql_comment_search .= " and ( user_id != 'el1001' and user_id != 'el1002' and user_id != 'el1003' and user_id != 'el004' ) ";
//job_id 공사업체 id 체크 160831
if($member['mb_id'] == "el1001") $sql_comment_search .= " and ( job_id != 'el1002' and job_id != 'el1003' and job_id != 'el1004' and job_id != 'el001' ) ";
else if($member['mb_id'] == "el1002") $sql_comment_search .= " and ( job_id != 'el1001' and job_id != 'el1003' and job_id != 'el1004' and job_id != 'el002' ) ";
else if($member['mb_id'] == "el1003") $sql_comment_search .= " and ( job_id != 'el1001' and job_id != 'el1002' and job_id != 'el1004' and job_id != 'el003' ) ";
else if($member['mb_id'] == "el1004") $sql_comment_search .= " and ( job_id != 'el1001' and job_id != 'el1002' and job_id != 'el1003' and job_id != 'el004' ) ";
//비밀글 : 본사, 관리자만 열람 가능 151111
if($member['mb_profile'] != '1' && $member['mb_id'] != 'master') $sql_comment_search .= " and secret != '1' ";
$sql_comment = " select * from com_list_gy_comment where com_code='$row[com_code]' and delete_yn != '1' $sql_comment_search order by regdt ";
//echo $sql_comment."<br />";
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	if($row_comment['user_id'] == "master") $color = "blue";
	else $color = "#343434";
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
	$comment = "<span style='color:".$color.";'><b>".$row_comment['user_name']."</b>(".$row_comment['user_nick'].") : ".$row_comment['memo']."</span> <span>(".str_replace('-','.',$row_comment['regdt']).")</span>".$icon_secret.$comment_del."<br>";
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
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="memo_type" value="<?=$memo_type?>" />
	<input type="hidden" name="dealer" value="contractor" />
	<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
	<table border="0" cellpadding="0" cellspacing="0" style="float:left;height:18px;margin-top:5px;margin-right:5px">
		<tr>
			<td>
				<input type="hidden" name="send_to7" value="kcmc1001" />
				<!--<input type="hidden" name="contractor" value="1" />-->
				<input type="hidden" name="send_to8" value="" />
				<input type="hidden" name="send_to1" value="" />
				<input type="hidden" name="send_to2" value="">
				<input type="hidden" name="send_to3" value="" />
				<input type="hidden" name="send_to4" value="" />
				<input type="hidden" name="send_to5" value="" />
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
