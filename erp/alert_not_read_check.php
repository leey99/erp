<?
$sub_menu = "100100";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");
$now_time = date("Y-m-d H:i:s");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	$sql = "select * from erp_alert where idx = '$id' ";
	//echo count($idx);
	//echo $sql;
	$row = sql_fetch($sql);
	if (!$row[com_code]) {
		$msg ="코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		//담당자 설정
		$mb_id = $member['mb_id'];
		$mb_name = $member['mb_name'];
		$mb_profile_code = $member['mb_profile'];
		if($mb_profile_code == 1) {
			$read_main = "";
			$read_main_time = $now_time;
			//안읽음처리 본인만 제외 150930
			$read_main_array = explode(",", $row['read_main']);
			for($rm=0;$rm<count($read_main_array);$rm++) {
				if($read_main_array[$rm] != $mb_id) $read_main .= $read_main_array[$rm].",";
			}
			$read_main_sql = " read_main = '$read_main', read_main_time = '$read_main_time' ";
			$read_branch_sql = "";
		} else {
			$read_branch = $mb_id;
			$read_branch_time = $now_time;
			$read_branch_sql = " read_branch = '', read_branch_time = '$read_branch_time' ";
			$read_main_sql = "";
		}
		sql_query(" update erp_alert set read_check = '', $read_main_sql $read_branch_sql where idx = '$id' ");
	}
}
if($stx_my == "1") $url_file = "alert_my.php";
else $url_file = "alert_list.php";
//전달사항, 거래처, 전자결제 URL 160502
if($this_url) $url_file = $this_url.".php";
goto_url("./".$url_file."?page=".$page."&".$qstr);
?>
