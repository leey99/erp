<?
$year = 2013;
$sub_title = "작성방법";
$g4[title] = $sub_title." : ".$year."년도 보수총액 신고";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<script type="text/javascript" language="javascript" src="js/retire_util.js"></script>
<script type="text/javascript" language="javascript" src="js/retire_cal.js"></script>
<link href="css/popup.css" rel="stylesheet" type="text/css" />
</head>
<!--<body onload="setCurrYear()">-->
<body>
<form name="form1" action="retire_cal.html" >
	<input type="hidden" name="control"/>
	<input type="hidden" name="index_value"/>
	<!--에제 설명 -->
	<div class="ex"  style="float:left;">
		<h1>* 보수총액 신고 작성방법 안내 *</h1>
		<div class="content">
			<table summary="" class="ex_t">
				<caption>1. ①번란의 "보험료 부과구분" 부호의 내용</caption>
				<tr>
					<th scope="col" rowspan="3">부과<br>구분<br>부호</th>
					<th scope="col" colspan="4">부과범위</th>
					<th scope="col" rowspan="3">대상근로자</th>
				</tr>
        <tr>
					<th scope="col" colspan="2">산재<br>보험</th>
					<th scope="col" colspan="2">고용보험</th>
				</tr>
        <tr>
					<th scope="col" colspan="">산재</th>
					<th scope="col" colspan="">임채</th>
					<th scope="col" colspan="">실업급여</th>
					<th scope="col" colspan="">고안직능</th>
				</tr>
        <tr>
					<td scope="row">51</td>
					<td>○</td>
					<td>○</td>
					<td>X</td>
					<td>X</td>
					<td style="text-align:left">고용보험미가입 외국인근로자, 월 60시간 미만 근로자, 항운노조원(임채부과대상)</td>
				</tr>
        <tr>
					<td scope="row">52</td>
					<td>○</td>
					<td>X</td>
					<td>X</td>
					<td>X</td>
					<td style="text-align:left">항운노조원(임채소송승소), 현장실습생</td>
				</tr>
        <tr>
					<td scope="row">54</td>
					<td>○</td>
					<td>X</td>
					<td>○</td>
					<td>○</td>
					<td style="text-align:left">자활근로종사자(급여특례ㆍ차상위계층)</td>
				</tr>
        <tr>
					<td scope="row">55</td>
					<td>X</td>
					<td>X</td>
					<td>○</td>
					<td>○</td>
					<td style="text-align:left">국가기관에서 근무하는 청원경찰, 선원법 및 어선재해보상법적용자, 해외파견자</td>
				</tr>
        <tr>
					<td scope="row">56</td>
					<td>X</td>
					<td>X</td>
					<td>○</td>
					<td>X</td>
					<td style="text-align:left">별정직ㆍ계약직공무원, 노동조합 등으로부터 금품을 지급받는 노조전임자</td>
				</tr>
        <tr>
					<td scope="row">57</td>
					<td>○</td>
					<td>X</td>
					<td>○</td>
					<td>X</td>
					<td style="text-align:left">시간제계약직 공무원</td>
				</tr>
        <tr>
					<td scope="row">58</td>
					<td>○</td>
					<td>X</td>
					<td>X</td>
					<td>○</td>
					<td style="text-align:left">자활근로종사자(국민기초생활보장수급권자)</td>
				</tr>
			</table>
			<br />
			2. ②, ④, ⑤번란의 "연간보수총액"은 해당년도에 발생된 보수총액을 작성
			<br />
			* 연간보수총액:「소득세법」제20조에 따른 근로소득에서 같은 법 제12조제3호에 따른 비과세 근로소득을 뺀 금액(연말정산에 따른 갑근세 원천징수 대상 근로소득과 동일)
			<br />
			* 휴업ㆍ휴직 및 「근로기준법」 제74조에 따른 보호휴가(산전후 휴가 또는 유산ㆍ사산휴가) 중의 보수는 고용보험 보수총액에는 포함, 산재보험 보수총액에서는 제외 
			<br />
			<br />
			3. ③, ⑥번란의 "월평균보수" 는 아래 계산식에 따라 산정하여 기재(이미 상실(고용종료)된 근로자는 기재하지 않음)
			<br />
			* 9.30. 이전 입사자 : 해당년도 보수총액 ÷ 해당년도 근무개월수
			<br />
			* 10.1. 이후 입사자 : 취득(고용)일부터 1년간(1년 이내의 근로계약기간을 정한 경우에는 그 기간) 지급하기로 정한 보수총액 ÷ 해당 근무개월수
			<br />
			※ 다만, 고용(취득)한 달의 근무일수가 20일 미만인 자는 월평균보수 산정 시 그 달은(고용한 달)은 제외하고 산정
			<br />
			(예시. 4.20에 입사한 근로자의 월평균보수는 5.1. 이후 발생한 보수총액÷8개월로 산정)
			<br />
			<br />
			4. ⑦번란의 "일용근로자 보수총액"은 일용근로자(1개월미만 동안 고용된 근로자)들의 연간 보수총액 합계액을 적습니다.
			<br />
			<br />
			5. ⑧번란의 "그 밖의 근로자 보수총액"은 월 60시간 미만 근로자 및 고용보험에 가입하지 않은 외국인근로자 중 산재보험 고용정보를 신고하지 아니한 근로자들의 연간 보수총액 합계액을 적습니다.
			<br />
			<br />
			6. ⑩번란의 "매월말 현재 일용근로자 및 그밖의 근로자수"는 매월말 현재 근무하는 일용근로자의 수 및 그 밖의 근로자의 수를 기재(해당자가 없는 경우에는 기재하지 않음).
			<br />
			<br />
			7. ⑪번란의 "년도 중 산재보험 업종변경 사업장의 기간별 보수총액"은 ⑧번의 합계금액을 업종변경 전과 후를 구분하여 기재(년도 중 산재보험 업종변경이 없는 경우에는 기재하지 않음)
			<br />
			<br />
			8. 사업장 정보가 틀린 경우 "보험관계변경신고서", 산재보험 근로자 고용정보가 틀린 경우 "근로자고용정보정정요청서", 신고가 누락된 근로자를 추가 신고하는 경우 "근로자고용신고서" 또는 "피보험자격취득신고서"를 별도 제출
			<br />
			<br />
			※ 변경 및 정정에 필요한 각종 서식은 근로복지공단홈페이지 <a href="http://kcomwel.or.kr" target="blank">kcomwel.or.kr</a> 에서 다운로드 가능
			<br />
		</div>
	</div>
	<br/>
	<input type="image" value="" title="" alt="" style="display:none;"/>
</form>
</body>
</html>
