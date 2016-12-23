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
$sql1 = " select * from job_time a, job_time_opt b where a.id='$id' and a.id=b.id ";
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
	if (frm.etc.value == "")
	{
		alert("내용을 입력하세요.");
		frm.etc.focus();
		return;
	}
	frm.action = "job_time_etc_update.php";
	frm.submit();
	return;
}
</script>
<div style="padding:0 0 5px 0;">
	·<strong>상호</strong>: <?=$row['com_name']?> ·<strong>업종</strong>: <?=$row['upjong']?> ·<strong>전화번호</strong>: <?=$row['com_tel']?> ·<strong>방문일자</strong>: <?=$row['visitdt']."(".$row['visitdt_time'].")"?>
</div>
<?=$row[memo]?>
(<?=$row[regdt]?>)
<div style="height:4px;font-size:0px;line-height:0px;"></div>
<?
//echo "<br /><span style='color:red'>제작중입니다.</span>";
//exit;
?>
<form name="dataForm" method="post" enctype="" style="margin:0">
	<input type="hidden" name="w" value="<?=$w?>">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<input type="hidden" name="com_code" value="<?=$row1['com_code']?>">
	<textarea name="etc" class="textfm" style='width:100%;height:98px;word-break:break-all;' rows="7" cols=""><?=$row['etc']?></textarea>
	<div style="padding:5px 0 0 0;">
		<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;vertical-align:middle;">
			<tr>
				<td width=2></td><td><img src="images/btn9_lt.gif"></td>
				<td style="background:url(images/btn9_bg.gif) repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goInsert();" target="">저 장</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td>
			</tr>
		</table>
		최종수정일시 : <?=$row['editdt']?>
	</div>
</form>
</body>
</html>
