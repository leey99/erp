<?
include_once("./_common.php");

$g4[title] = "일정보기";

$tmp_write_table = $g4[write_prefix] . $bo_table; // 게시판 테이블 전체이름
// 0~9 월까지를 01 ~ 09 로 만들어 준다. 
if((int)$day <= 9){ 
	$day = "0".$day; 
} 
if((int)$month <= 9){ 
	$month = "0".$month; 
} 
$thedate = $year.$month.$day;
$latest_skin_path = "$g4[path]/skin/latest/calendar";

$list = array();
$sql = " select * from {$g4[board_table]} where bo_table = '$bo_table'";
$board = sql_fetch($sql);

$sql = " select * from $tmp_write_table where wr_comment > -1 AND (wr_link1 = $thedate) order by wr_id desc limit 0, 10";
//explain($sql);
$result = sql_query($sql);
for ($i=0; $row = sql_fetch_array($result); $i++) {
    $list[$i] = get_list($row, $board, $latest_skin_path, 70);

	$html = 0;
	if (strstr($list[$i][wr_option], "html1"))
		$html = 1;
	else if (strstr($list[$i][wr_option], "html2"))
		$html = 2;

	$list[$i][content] = conv_content($list[$i][wr_content], $html);
	
}


include_once("$latest_skin_path/pop.skin.php");

?>
