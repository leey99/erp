<?
//결산 : 권한(대표, 지사장, 본부장, 부장, 경리담당, 관리자) 설정 150914 / 광주지사 박현용 본부장(지사장 권한) 160406 / 전북1 정미영 팀장 160408
$mb_id_check = explode('000',$member['mb_id']);
if($mb_id_check[1] != "1" && $member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1002" && $member['mb_id'] != "kcmc1004" && $member['mb_id'] != "kcmc1008" && $member['mb_id'] != "master" && $member['mb_id'] != "gj0024" && $member['mb_id'] != "jb10002") {
	alert("해당 페이지를 열람할 권한이 없습니다.");
}
?>