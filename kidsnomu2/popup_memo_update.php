<?
$sub_menu = "100101";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$sql_common = " regdt = '$now_time',
						com_code = '$id',
						t_no = '$t_no',
						memo = '$memo',
						user_id = '$mb_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name'
";
//수정
if ($w == 'u'){
	$sql = " update total_pay_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("정상적으로 메모가 수정 되었습니다.","popup_memo.php?id=$id&w=$w&idx=$idx");
//등록
}else{
	$sql = " insert total_pay_comment set 
					$sql_common 
					";
	sql_query($sql);
	alert("정상적으로 메모가 등록 되었습니다.","popup_memo.php?id=$id&t_no=$t_no");
}
?>