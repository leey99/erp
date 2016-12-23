<?
$sub_menu = "1900101";
include_once("./_common.php");
$sql_common = " from job_time a, job_time_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.id=b.id and a.id='$id' ";

if (!$sst) {
    $sst = "a.id";
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

$sub_title = "시간선택제(전달사항)";
$g4[title] = $sub_title." : 사업분야 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];

$colspan = 11;


$row=mysql_fetch_array($result);
//사업장DB 옵션
$sql1 = " select * from job_time where id='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

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
	frm.action = "job_time_memo_update.php";
	frm.submit();
	return;
}
</script>
<div style="padding:0 0 5px 0;">
	·<strong>상호</strong>: <?=$row['com_name']?> ·<strong>업종</strong>: <?=$row['upjong']?> ·<strong>전화번호</strong>: <?=$row['com_tel']?> ·<strong>방문일자</strong>: <?=$row['visitdt']."(".$row['visitdt_time'].")"?>
</div>
<?=$row[memo]?>
(<?=$row[regdt]?>)
<div style="height:1px;font-size:0px;line-height:0px;"></div>
<div style="height:1px;font-size:0px" class="bgtr"></div>
<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//덧글
$sql_comment = " select * from job_time_comment where mid='$row[id]' and delete_yn != '1' ";
$result_comment = sql_query($sql_comment);
for ($i=0; $row_comment=sql_fetch_array($result_comment); $i++) {
	//if($i == 0) echo "<b>덧글</b> (".$member['mb_id'].")<br>";
	$memo_name = $row_comment['user_nick'];
	$memo_id = $row_comment['user_id'];
	if($row_comment['user_id'] == "ps20002") $color = "#343434";
	else $color = "#343434";
	$comment_del = " <a href='job_time_memo_delete.php?id=".$id."&idx=".$row_comment['idx']."'><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	$comment = "<div style='padding:2px 0 2px 0;'>".$memo_name."<span style='font-size:9px'>(".$memo_id.")</span> <span style='color:".$color."'>".$row_comment['memo']."</span><span style='font-size:9px'> (".$row_comment['regdt'].")</span>".$comment_del."</div>";
	echo $comment;
}
if($row['etc']) {
	echo "<div style='padding:2px 0 2px 0;color:blue;'>".$row['etc']."<span style='font-size:9px'> (".$row['editdt'].")</span></div>";
}
?>
<form name="dataForm" method="post" enctype="" style="margin:0">
<input type="hidden" name="w" value="<?=$w?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="com_code" value="<?=$row1['com_code']?>">
<textarea name="memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="내용" required></textarea>
<div style="padding:5px 0 0 0;">
	<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src="images/btn9_lt.gif"></td>
	<td style="background:url(images/btn9_bg.gif) repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();" target="">덧글입력</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
</div>
</form>
</body>
</html>
