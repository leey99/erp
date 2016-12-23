<?
$sub_menu = "100200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$g4[com_code_list] = "com_code_list";
$now_time = date("Y-m-d H:i:s");

$sql_max = " select max(rank), max(code) from $g4[com_code_list] where com_code = '$com_code' and item = '$item' ";
//echo $sql_max;
//exit;
$result_max = sql_query($sql_max);
$row_max = mysql_fetch_array($result_max);
$rank_max = $row_max[0] + 1;
$code_max = $row_max[1] + 1;

if($w != 'u') $rank_insert = " rank = '$rank_max', ";

$sql_common = "
						name = '$name',
						rate = '$rate',
						use_yn = '$use_yn',
						memo = '$memo',
						$rank_insert
						amount = '$amount' ";

//수정
if ($w == 'u'){
	$sql = " update $g4[com_code_list] set 
				$sql_common 
			  where com_code = '$com_code' and code = '$id' and item = '$item' ";
	//echo $sql;
	//exit;
	sql_query($sql);
	//alert("정상적으로 코드가 수정 되었습니다.","com_code_view.php?id=$id&w=u&item=$item&page=$page");
	alert("정상적으로 코드가 수정 되었습니다.","com_code_list.php?item=$item&page=$page");

//등록
}else{
	$sql = " insert $g4[com_code_list] set 
					$sql_common
					,com_code = '$com_code', code = '$code_max', item = '$item'
				";
	//echo $sql;
	//exit;
	sql_query($sql);
	alert("정상적으로 코드가 추가 되었습니다.","com_code_list.php?item=$item&page=$page");
}

//goto_url("./4insure_list.php");
?>
