<?
$sub_menu = "100101";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");

$sql_common = " regdt = '$now_time',
						com_code = '$id',
						memo = '$memo',
						user_id = '$user_id'
";
//수정
if ($w == 'u'){
	$sql = " update shipbuilding_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("정상적으로 덧글이 수정 되었습니다.","popup_memo.php?id=$id&w=$w&idx=$idx");
//등록
}else{
	$sql = " insert shipbuilding_comment set 
					$sql_common 
					";
	sql_query($sql);
	alert("정상적으로 덧글이 등록 되었습니다.","shipbuilding_memo.php?id=$id");
}
?>