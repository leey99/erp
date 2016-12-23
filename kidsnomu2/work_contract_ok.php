<?
$sub_menu = "100200";
include_once("./_common.php");

//echo $g4[pibohum_base_opt];
//exit;
$g4[pibohum_base_opt] = "pibohum_base_opt";
$now_time = date("Y-m-d H:i:s");

$sql_common = " work_contract = '1' ";

//추가 필드 데이터 유무
$sql1 = " select * from $g4[pibohum_base_opt] where com_code='$code' and sabun='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//echo $total1;
//exit;

//수정
if($total1) {
	$sql = " update $g4[pibohum_base_opt] set 
				$sql_common 
			  where com_code='$code' and sabun='$id' ";
	//echo $sql;
	//exit;

//등록
}else{
	$sql = " insert $g4[pibohum_base_opt] set 
			$sql_common ";
	//echo $sql;
	//exit;
}
sql_query($sql);
alert("정상적으로 작성완료가 되었습니다.","work_contract.php?id=$id&code=$code&page=$page");
?>