<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE>4대사회보험 정보연계센터 - 직종코드3(139종 신 KECO 코드, 고용,산재)(실제 138개) 검색</TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content=IE=7 http-equiv=X-UA-Compatible>
<META content=text/css http-equiv=Content-Style-Type>
<LINK rel=stylesheet type=text/css href="images/default.css">
<LINK rel=stylesheet type=text/css href="images/pko.css">
<SCRIPT type=text/javascript src="images/jquery-1.5.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="images/jquery.maskedinput-1.3.min.js"></SCRIPT>
<?
if(!$_GET['n']) $n = "";
else $n = $_GET['n'];
?>
<SCRIPT type=text/javascript>
	$(function(){
        var nhicRowNum = "null";
        var rowNum     = "null";
		$("input[name='select01']").click(function() { 
			  var i = $("input[name='select01']").index(this); 
			  var value = $("input[name='select01']").eq(i).val();
			  
			  if( rowNum != "null" && nhicRowNum != "null" ){
				  parent.value_set('join_note<?=$n?>',value.split("_")[0],'join_jikjong<?=$n?>',value.split("_")[1])
				  //parent.ifr_close('join_note','join_jikjong');
			  }else{
	              //$('#join_jikjong',opener.document).focus();
	              $('#join_jikjong_code<?=$n?>',opener.document).val(value.split("_")[0]);
	              $('#join_jikjong<?=$n?>',opener.document).val(value.split("_")[1]);
								//alert(value.split("_")[0]);
	              self.close();
			  }
		}); 
		
		if( rowNum != "null" && nhicRowNum != "null" ){
			//parent.iframe_focus(rowNum,nhicRowNum);
		}
		
		$("#searchKeyword").focus();
	});
	
	function win_close(){
		
		    window.close();
		
	}
	</SCRIPT>

<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->
<DIV 
style="BORDER-TOP: black 0px solid; BORDER-RIGHT: black 0px solid; BORDER-BOTTOM: black 0px solid; TEXT-ALIGN: left; BORDER-LEFT: black 0px solid; WIDTH: 540px">
<DIV id=popup class=width540 style="BORDER-TOP: blue 0px solid; BORDER-RIGHT: blue 0px solid; BORDER-BOTTOM: blue 0px solid; BORDER-LEFT: blue 0px solid">
<H1><IMG alt="직종코드3(139종 신 KECO 코드, 고용,산재)(실제 138개) 검색" 
src="images/D107.gif"></H1>
<P class=logoBg><IMG alt="4대사회보험 정보연계센터" src="images/logoBg.gif"></P>
<p>※ Ctrl + F 단축키로 빠른 검색이 가능합니다.</p>
<P class=full>전체 <SPAN>138</SPAN>개</P>
<TABLE class=skyTable width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <THEAD>
		<TR>
			<TH scope=col>선택</TH>
			<TH scope=col>코드</TH>
			<TH scope=col>명칭</TH>
		</TR>
	</THEAD>
</TABLE>
<div style="overflow:auto;overflow-x:hidden;height:470px">
<TABLE class=skyTable2 width="100%" summary="피부양자 자격취득부호(건강) 검색 조회결과(코드,명칭)">
  <CAPTION>4대사회보험 정보연계센터 - 비고 검색</CAPTION>
  <COLGROUP>
  <COL width="11%">
  <COL width="12%">
  <COL></COLGROUP>
  <TBODY>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="011_고위공무원 및 기업 고위임원" name=select01></TD>
    <TD class=alignC>011</TD>
    <TD>고위공무원 및 기업 고위임원</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="012_경영지원, 행정 및 금융 관련 관리자" name=select01></TD>
    <TD class=alignC>012</TD>
    <TD>경영지원, 행정 및 금융 관련 관리자</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="013_사회서비스 관련 관리자(교육, 법률, 보건 등)" name=select01></TD>
    <TD class=alignC>013</TD>
    <TD>사회서비스 관련 관리자(교육, 법률, 보건 등)</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="014_문화, 예술, 디자인, 영상 관련 관리자" name=select01></TD>
    <TD class=alignC>014</TD>
    <TD>문화, 예술, 디자인, 영상 관련 관리자</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="015_건설 및 생산 관련 관리자" name=select01></TD>
    <TD class=alignC>015</TD>
    <TD>건설 및 생산 관련 관리자</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="016_정보통신 관련 관리자" name=select01></TD>
    <TD class=alignC>016</TD>
    <TD>정보통신 관련 관리자</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="017_영업, 판매 및 운송 관련 관리자" name=select01></TD>
    <TD class=alignC>017</TD>
    <TD>영업, 판매 및 운송 관련 관리자</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="018_음식, 숙박, 여행, 오락 및 스포츠 관련 관리자" name=select01></TD>
    <TD class=alignC>018</TD>
    <TD>음식, 숙박, 여행, 오락 및 스포츠 관련 관리자</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="019_환경, 청소 및 경비 관련 관리자" name=select01></TD>
    <TD class=alignC>019</TD>
    <TD>환경, 청소 및 경비 관련 관리자</TD></TR>
  <TR>
    <TD class=alignC><INPUT title=코드선택 class=select01 type=radio 
      value="021_경영 및 행정 관련 전문가" name=select01></TD>
    <TD class=alignC>021</TD>
    <TD>경영 및 행정 관련 전문가</TD></TR>

	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="022_회계, 세무 및 감정평가 관련 전문가"/></td>
		<td class="alignC">022</td>
		<td>회계, 세무 및 감정평가 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="023_광고, 홍보, 조사, 행사기획 관련 전문가"/></td>
		<td class="alignC">023</td>
		<td>광고, 홍보, 조사, 행사기획 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="024_경영지원 및 행정 관련 사무원"/></td>
		<td class="alignC">024</td>
		<td>경영지원 및 행정 관련 사무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="025_생산 관련 사무원"/></td>
		<td class="alignC">025</td>
		<td>생산 관련 사무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="026_무역 및 운송 관련 사무원"/></td>
		<td class="alignC">026</td>
		<td>무역 및 운송 관련 사무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="027_회계 및 경리 관련 사무원"/></td>
		<td class="alignC">027</td>
		<td>회계 및 경리 관련 사무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="028_안내,접수, 고객응대, 통계조사 관련 사무원"/></td>
		<td class="alignC">028</td>
		<td>안내,접수, 고객응대, 통계조사 관련 사무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="029_비서 및 사무보조원"/></td>
		<td class="alignC">029</td>
		<td>비서 및 사무보조원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="031_금융, 보험 관련 전문가"/></td>
		<td class="alignC">031</td>
		<td>금융, 보험 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="032_금융 및 보험 관련 사무원"/></td>
		<td class="alignC">032</td>
		<td>금융 및 보험 관련 사무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="033_보험 관련 영업원"/></td>
		<td class="alignC">033</td>
		<td>보험 관련 영업원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="041_대학교수(시간강사 포함)"/></td>
		<td class="alignC">041</td>
		<td>대학교수(시간강사 포함)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="042_장학관 및 교육 관련 전문가"/></td>
		<td class="alignC">042</td>
		<td>장학관 및 교육 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="043_자연과학, 생명과학 관련 전문가"/></td>
		<td class="alignC">043</td>
		<td>자연과학, 생명과학 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="044_인문사회과학 관련 전문가"/></td>
		<td class="alignC">044</td>
		<td>인문사회과학 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="045_자연과학, 생명과학 관련 시험원"/></td>
		<td class="alignC">045</td>
		<td>자연과학, 생명과학 관련 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="046_학교교사"/></td>
		<td class="alignC">046</td>
		<td>학교교사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="047_유치원교사"/></td>
		<td class="alignC">047</td>
		<td>유치원교사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="048_학원강사 및 학습지 교사"/></td>
		<td class="alignC">048</td>
		<td>학원강사 및 학습지 교사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="051_법률전문가"/></td>
		<td class="alignC">051</td>
		<td>법률전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="052_법률관련 사무원"/></td>
		<td class="alignC">052</td>
		<td>법률관련 사무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="053_경찰, 소방, 교도 관련 종사자"/></td>
		<td class="alignC">053</td>
		<td>경찰, 소방, 교도 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="061_의사"/></td>
		<td class="alignC">061</td>
		<td>의사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="062_수의사"/></td>
		<td class="alignC">062</td>
		<td>수의사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="063_약사"/></td>
		<td class="alignC">063</td>
		<td>약사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="064_간호사 및 치과위생사"/></td>
		<td class="alignC">064</td>
		<td>간호사 및 치과위생사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="065_치료사"/></td>
		<td class="alignC">065</td>
		<td>치료사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="066_의료장비 및 치과 관련 기술 종사자"/></td>
		<td class="alignC">066</td>
		<td>의료장비 및 치과 관련 기술 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="067_의료 및 보건 서비스 관련 종사자"/></td>
		<td class="alignC">067</td>
		<td>의료 및 보건 서비스 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="068_의료복지 관련 단순 종사자"/></td>
		<td class="alignC">068</td>
		<td>의료복지 관련 단순 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="071_사회복지 및 상담 전문가"/></td>
		<td class="alignC">071</td>
		<td>사회복지 및 상담 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="072_보육교사, 육아도우미 및 생활지도원"/></td>
		<td class="alignC">072</td>
		<td>보육교사, 육아도우미 및 생활지도원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="073_성직자 및 종교 관련 종사자"/></td>
		<td class="alignC">073</td>
		<td>성직자 및 종교 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="081_작가 및 출판 전문가"/></td>
		<td class="alignC">081</td>
		<td>작가 및 출판 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="082_학예사, 사서 및 기록물관리사"/></td>
		<td class="alignC">082</td>
		<td>학예사, 사서 및 기록물관리사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="083_기자"/></td>
		<td class="alignC">083</td>
		<td>기자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="084_창작 및 공연 관련 전문가"/></td>
		<td class="alignC">084</td>
		<td>창작 및 공연 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="085_디자이너"/></td>
		<td class="alignC">085</td>
		<td>디자이너</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="086_영화, 연극 및 방송 관련 전문가"/></td>
		<td class="alignC">086</td>
		<td>영화, 연극 및 방송 관련 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="087_영화, 연극 및 방송 관련 기술 종사자"/></td>
		<td class="alignC">087</td>
		<td>영화, 연극 및 방송 관련 기술 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="088_연예인 매니저 및 기타 문화/예술 관련 종사자"/></td>
		<td class="alignC">088</td>
		<td>연예인 매니저 및 기타 문화/예술 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="091_선박, 항공기 조종 및 관제 관련 종사자"/></td>
		<td class="alignC">091</td>
		<td>선박, 항공기 조종 및 관제 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="092_철도, 지하철 기관사 및 관련 종사자"/></td>
		<td class="alignC">092</td>
		<td>철도, 지하철 기관사 및 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="093_자동차 운전원"/></td>
		<td class="alignC">093</td>
		<td>자동차 운전원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="094_물품이동장비 조작원"/></td>
		<td class="alignC">094</td>
		<td>물품이동장비 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="095_배달원 및 운송 관련 단순 종사자"/></td>
		<td class="alignC">095</td>
		<td>배달원 및 운송 관련 단순 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="101_영업원 및 상품중개인"/></td>
		<td class="alignC">101</td>
		<td>영업원 및 상품중개인</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="102_부동산 중개인"/></td>
		<td class="alignC">102</td>
		<td>부동산 중개인</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="103_판매원 및 상품대여원"/></td>
		<td class="alignC">103</td>
		<td>판매원 및 상품대여원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="104_계산원 및 매표원"/></td>
		<td class="alignC">104</td>
		<td>계산원 및 매표원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="105_노점,이동,방문 판매원 및 판매관련 및 단순 종사원"/></td>
		<td class="alignC">105</td>
		<td>노점,이동,방문 판매원 및 판매관련 및 단순 종사원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="111_경호원, 청원경찰, 보안 관련 종사자"/></td>
		<td class="alignC">111</td>
		<td>경호원, 청원경찰, 보안 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="112_경비원"/></td>
		<td class="alignC">112</td>
		<td>경비원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="113_청소원, 가사도우미, 그 외 청소관련 단순 종사자"/></td>
		<td class="alignC">113</td>
		<td>청소원, 가사도우미, 그 외 청소관련 단순 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="114_세탁원 및 다림질원"/></td>
		<td class="alignC">114</td>
		<td>세탁원 및 다림질원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="115_계기검침, 수금 및 주차관리 관련 단순 종사자"/></td>
		<td class="alignC">115</td>
		<td>계기검침, 수금 및 주차관리 관련 단순 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="121_이, 미용 및 관련 서비스 종사자"/></td>
		<td class="alignC">121</td>
		<td>이, 미용 및 관련 서비스 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="122_결혼 및 장례 관련 서비스 종사자"/></td>
		<td class="alignC">122</td>
		<td>결혼 및 장례 관련 서비스 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="123_여행 서비스 관련 종사자"/></td>
		<td class="alignC">123</td>
		<td>여행 서비스 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="124_승무원"/></td>
		<td class="alignC">124</td>
		<td>승무원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="125_숙박시설 서비스 관련 종사자"/></td>
		<td class="alignC">125</td>
		<td>숙박시설 서비스 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="126_오락시설 서비스 관련 종사자"/></td>
		<td class="alignC">126</td>
		<td>오락시설 서비스 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="127_스포츠 및 레크레이션 관련 종사자"/></td>
		<td class="alignC">127</td>
		<td>스포츠 및 레크레이션 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="131_주방장 및 조리사"/></td>
		<td class="alignC">131</td>
		<td>주방장 및 조리사</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="132_식당 서비스 관련 종사자"/></td>
		<td class="alignC">132</td>
		<td>식당 서비스 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="141_건축 및 토목 관련 기술자 및 시험원"/></td>
		<td class="alignC">141</td>
		<td>건축 및 토목 관련 기술자 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="142_건설구조관련 기능 종사자"/></td>
		<td class="alignC">142</td>
		<td>건설구조관련 기능 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="143_건설마감 관련 기능 종사자"/></td>
		<td class="alignC">143</td>
		<td>건설마감 관련 기능 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="144_배관공"/></td>
		<td class="alignC">144</td>
		<td>배관공</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="145_건설 및 채굴기계 운전원"/></td>
		<td class="alignC">145</td>
		<td>건설 및 채굴기계 운전원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="146_토목 및 채굴 관련 종사자"/></td>
		<td class="alignC">146</td>
		<td>토목 및 채굴 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="147_건설 및 광업 관련 단순 종사자"/></td>
		<td class="alignC">147</td>
		<td>건설 및 광업 관련 단순 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="151_기계공학 기술자,연구원 및 시험원"/></td>
		<td class="alignC">151</td>
		<td>기계공학 기술자,연구원 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="152_기계장비 설치 및 정비원"/></td>
		<td class="alignC">152</td>
		<td>기계장비 설치 및 정비원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="153_운송장비 정비원(자동차 제외)"/></td>
		<td class="alignC">153</td>
		<td>운송장비 정비원(자동차 제외)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="154_자동차정비원"/></td>
		<td class="alignC">154</td>
		<td>자동차정비원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="155_금형 및 공작기계 조작원"/></td>
		<td class="alignC">155</td>
		<td>금형 및 공작기계 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="156_냉난방 관련 설비 조작원"/></td>
		<td class="alignC">156</td>
		<td>냉난방 관련 설비 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="157_자동조립라인 및 산업용 로봇 조작원"/></td>
		<td class="alignC">157</td>
		<td>자동조립라인 및 산업용 로봇 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="158_자동차 및 자동차 부분품 조립원"/></td>
		<td class="alignC">158</td>
		<td>자동차 및 자동차 부분품 조립원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="159_운송차량 및 기계 관련 조립원"/></td>
		<td class="alignC">159</td>
		<td>운송차량 및 기계 관련 조립원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="161_금속 및 재료공학 기술자,연구원 및 시험원"/></td>
		<td class="alignC">161</td>
		<td>금속 및 재료공학 기술자,연구원 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="162_판금, 제관 및 섀시 관련 종사자"/></td>
		<td class="alignC">162</td>
		<td>판금, 제관 및 섀시 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="163_단조원 및 주조원"/></td>
		<td class="alignC">163</td>
		<td>단조원 및 주조원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="164_용접원"/></td>
		<td class="alignC">164</td>
		<td>용접원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="165_도장기 및 도금기 조작원"/></td>
		<td class="alignC">165</td>
		<td>도장기 및 도금기 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="166_금속가공 관련 장치 및 기계 조작원"/></td>
		<td class="alignC">166</td>
		<td>금속가공 관련 장치 및 기계 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="167_비금속제조 관련 장치 및 기계 조작원(유리/점토/시멘트/석제품)"/></td>
		<td class="alignC">167</td>
		<td>비금속제조 관련 장치 및 기계 조작원(유리/점토/시멘트/석제품)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="171_화학공학 기술자,연구원 및 시험원"/></td>
		<td class="alignC">171</td>
		<td>화학공학 기술자,연구원 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="172_석유 및 화학물 가공장치 조작원"/></td>
		<td class="alignC">172</td>
		<td>석유 및 화학물 가공장치 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="173_화학,고무 및 플라스틱 제품 생산기 조작원"/></td>
		<td class="alignC">173</td>
		<td>화학,고무 및 플라스틱 제품 생산기 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="181_섬유공학 기술자,연구원 및 시험원"/></td>
		<td class="alignC">181</td>
		<td>섬유공학 기술자,연구원 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="182_섬유제조기계 조작원"/></td>
		<td class="alignC">182</td>
		<td>섬유제조기계 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="183_섬유가공 관련 조작원"/></td>
		<td class="alignC">183</td>
		<td>섬유가공 관련 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="184_의복 제조원 및 수선원"/></td>
		<td class="alignC">184</td>
		<td>의복 제조원 및 수선원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="185_재단, 재봉 및 관련 기능 종사자"/></td>
		<td class="alignC">185</td>
		<td>재단, 재봉 및 관련 기능 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="186_제화 및 기타 직물 관련 기계조작원 및 조립원"/></td>
		<td class="alignC">186</td>
		<td>제화 및 기타 직물 관련 기계조작원 및 조립원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="191_전기 및 전자공학 기술자,연구원 및 시험원"/></td>
		<td class="alignC">191</td>
		<td>전기 및 전자공학 기술자,연구원 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="192_전공"/></td>
		<td class="alignC">192</td>
		<td>전공</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="193_전기, 전자기기 설치 및 수리원"/></td>
		<td class="alignC">193</td>
		<td>전기, 전자기기 설치 및 수리원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="194_발전 및 배전장치 조작원"/></td>
		<td class="alignC">194</td>
		<td>발전 및 배전장치 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="195_전기 및 전자설비 조작원"/></td>
		<td class="alignC">195</td>
		<td>전기 및 전자설비 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="196_전기ㆍ전자 부품 및 제품 제조 기계 조작원"/></td>
		<td class="alignC">196</td>
		<td>전기ㆍ전자 부품 및 제품 제조 기계 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="197_전기ㆍ전자 부품 및 제품 조립원"/></td>
		<td class="alignC">197</td>
		<td>전기ㆍ전자 부품 및 제품 조립원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="201_컴퓨터 하드웨어 및 통신공학 기술자,연구원"/></td>
		<td class="alignC">201</td>
		<td>컴퓨터 하드웨어 및 통신공학 기술자,연구원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="202_컴퓨터 시스템 설계 전문가"/></td>
		<td class="alignC">202</td>
		<td>컴퓨터 시스템 설계 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="203_소프트웨어 개발 전문가"/></td>
		<td class="alignC">203</td>
		<td>소프트웨어 개발 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="204_웹 전문가"/></td>
		<td class="alignC">204</td>
		<td>웹 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="205_데이터베이스 및 정보시스템 운영 전문가"/></td>
		<td class="alignC">205</td>
		<td>데이터베이스 및 정보시스템 운영 전문가</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="206_통신,방송 장비기사,설치 및 수리원"/></td>
		<td class="alignC">206</td>
		<td>통신,방송 장비기사,설치 및 수리원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="211_식품공학 기술자,연구원 및 시험원"/></td>
		<td class="alignC">211</td>
		<td>식품공학 기술자,연구원 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="212_제과,제빵원 및 떡제조원"/></td>
		<td class="alignC">212</td>
		<td>제과,제빵원 및 떡제조원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="213_식품가공 관련 기능 종사자"/></td>
		<td class="alignC">213</td>
		<td>식품가공 관련 기능 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="214_식품제조 기계 조작원"/></td>
		<td class="alignC">214</td>
		<td>식품제조 기계 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="221_환경공학 기술자,연구원 및 관련 시험원"/></td>
		<td class="alignC">221</td>
		<td>환경공학 기술자,연구원 및 관련 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="222_산업안전 및 에너지, 기타 공학 기술자,연구원 및 시험원"/></td>
		<td class="alignC">222</td>
		<td>산업안전 및 에너지, 기타 공학 기술자,연구원 및 시험원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="223_환경관련 장치 조작원(상하수, 소각)"/></td>
		<td class="alignC">223</td>
		<td>환경관련 장치 조작원(상하수, 소각)</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="224_인쇄 및 사진현상 관련 조작원"/></td>
		<td class="alignC">224</td>
		<td>인쇄 및 사진현상 관련 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="225_목재, 펄프, 종이가공 및 제조 관련 조작원"/></td>
		<td class="alignC">225</td>
		<td>목재, 펄프, 종이가공 및 제조 관련 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="226_가구, 목제품 조립 및 제조 관련 종사자"/></td>
		<td class="alignC">226</td>
		<td>가구, 목제품 조립 및 제조 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="227_공예원, 세공원 및 악기제조원, 기타 기능 종사자"/></td>
		<td class="alignC">227</td>
		<td>공예원, 세공원 및 악기제조원, 기타 기능 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="228_간판 제작,설치 및 기타 제조 관련 기계 조작원"/></td>
		<td class="alignC">228</td>
		<td>간판 제작,설치 및 기타 제조 관련 기계 조작원</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="229_제조관련 단순 종사자"/></td>
		<td class="alignC">229</td>
		<td>제조관련 단순 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="231_작물재배 종사자"/></td>
		<td class="alignC">231</td>
		<td>작물재배 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="232_낙농 및 사육 관련 종사자"/></td>
		<td class="alignC">232</td>
		<td>낙농 및 사육 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="233_임업 관련 종사자"/></td>
		<td class="alignC">233</td>
		<td>임업 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="234_어업 관련 종사자"/></td>
		<td class="alignC">234</td>
		<td>어업 관련 종사자</td>
	</tr>
	<tr>
		<td class="alignC"><input type="radio" name="select01" class="select01" title="코드선택" value="235_농림어업 관련 단순 종사자"/></td>
		<td class="alignC">235</td>
		<td>농림어업 관련 단순 종사자</td>
	</tr>
	</TBODY>
</TABLE>
</div>

<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
