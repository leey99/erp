<?
$sub_menu = "1700101";
include_once("./_common.php");
$sql_common = " from com_list_gy a, job_education b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and b.idx='$id' ";

if (!$sst) {
    $sst = "b.idx";
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

$sub_title = "직무교육관리(뷰)";
$g4[title] = $sub_title." : 직무교육 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];
$colspan = 11;
$row=mysql_fetch_array($result);

//echo $row[id];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_attend=".$stx_attend;
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
	if (!frm.send_to1.checked && !frm.send_to2.checked && !frm.send_to3.checked && !frm.send_to4.checked && !frm.send_to5.checked && !frm.send_to6.checked ) {
	//if (!frm.send_to2.checked && !frm.send_to3.checked && !frm.send_to4.checked && !frm.send_to5.checked && !frm.send_to6.checked ) {
		alert("담당자를 체크하십시오.");
		return;
	}
	frm.action = "job_education_memo_update.php";
	frm.submit();
	return;
}
</script>
<div style="padding:0 0 5px 0;">
	<b>·상호</b>: <?=$row[com_name]?> <b>·업태</b>: <?=$row[uptae]?> <b>·전화번호</b>: <?=$row[com_tel]?>
</div>
<?=$row[job_memo]?>
<span style='font-size:9px'> (<?=$row[w_date]?>)</span>
<br>
<?
//덧글
$sql_comment = " select * from job_education_comment where mid='$row[idx]' and delete_yn != '1' ";
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	//if($i == 0) echo "<b>덧글</b> (".$member['mb_id'].")<br>";
	$memo_name = $row_comment['user_nick'];
	$memo_id = $row_comment['user_id'];
	if($row_comment['user_id'] == "ps20002") $color = "blue";
	else $color = "#343434";
	$comment_del = " <a href='job_education_memo_delete.php?id=".$id."&idx=".$row_comment['idx']."'><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	$comment = "<div style='padding:2px 0 2px 0;'><b>".$memo_name."<span style='font-size:9px'>(".$memo_id.")</span></b> <span style='color:".$color."'>".$row_comment['memo']."</span><span style='font-size:9px'> (".$row_comment['regdt'].")</span>".$comment_del."</div>";
	echo $comment;
}
?>
<form name="dataForm" method="post" enctype="" style="margin:0">
	<input type="hidden" name="w" value="<?=$w?>">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<input type="hidden" name="com_code" value="<?=$row['com_code']?>">
	<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
	<table border=0 cellpadding=0 cellspacing=0 style="height:18px;margin-top:5px;margin-right:5px">
		<tr>
			<td style="">
				<input type="checkbox" name="send_to1" value="kcmc1006"  style="vertical-align:middle"><b>박소향 사원</b>
				<input type="checkbox" name="send_to2" value="kcmc1008"  style="vertical-align:middle"><b>전정애 주임</b>
				<input type="checkbox" name="send_to3" value="manager"  style="vertical-align:middle"><b>정경용 부장</b>
				<input type="checkbox" name="send_to4" value="kcmc1009"  style="vertical-align:middle"><b>김국진 과장</b>
				<input type="checkbox" name="send_to5" value="kcmc0331"  style="vertical-align:middle"><b>임영진 주임</b>
				<input type="checkbox" name="send_to6" value="branch"  style="vertical-align:middle"><b>담당지사</b>
			</td>
		</tr>
	</table> 
	<table border=0 cellpadding=0 cellspacing=0 style="float:left;height:18px;margin-top:5px">
		<tr>
			<td width="2"></td><td><img src="images/btn9_lt.gif"></td>
			<td style="background:url('images/btn9_bg.gif') repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();" target="">등록</a></td>
			<td><img src=images/btn9_rt.gif></td><td width=2></td>
		</tr>
	</table> 
	<table border=0 cellpadding=0 cellspacing=0 style="float:left;height:18px;margin:8px 0 0 10px;">
		<tr>
			<td><span style="color:blue;">※ 위 담당자 체크시 해당 담당자에게 전송됩니다.</span></td>
		</tr>
	</table> 
</form>
</body>
</html>
