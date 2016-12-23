var idx =0;

function dateChk(){
	var main = document.form1;

	var syear = main.syear.value;
	var smon  = main.smon.value;
	var sday  = main.sday.value;

	var eyear = main.eyear.value;
	var emon  = main.emon.value; 
	var eday  = main.eday.value;

	var revalue1 = fn_isYearMonthDay(syear, smon, sday);

	//입사일자 유효성 체크
	if(main.syear.value =='' || main.syear.value =='0' ||revalue1 == 1 ){
		alert("입사년도가 적합하지 않습니다. 바르게 입력해 주십시오.");
		main.syear.focus();
		return false;
	}
	if(main.smon.value =='' || main.smon.value =='0' || revalue1 == 2){
		alert("입사월이 적합하지 않습니다. 바르게 입력해 주십시오.");
		main.smon.focus();
		return false;
	} 
	if(main.sday.value =='' || main.sday.value =='0' || revalue1 == 3){
		alert("입사일이 적합하지 않습니다. 바르게 입력해 주십시오.");
		main.sday.focus();
		return false;
	}

	var revalue2 = fn_isYearMonthDay(eyear, emon, eday);
	//퇴사일자 유효성 체크
	if(main.eyear.value =='' || main.eyear.value =='0' || revalue2 == 1){
		alert("퇴사년도가 적합하지 않습니다. 바르게 입력해 주십시오.");
		main.eyear.focus();
		return false;
	}
	if(main.emon.value =='' || main.emon.value =='0' || revalue2 == 2){
		alert("퇴사월이 적합하지 않습니다. 바르게 입력해 주십시오.");
		main.emon.focus();
		return false;
	}
	if(main.eday.value =='' || main.eday.value =='0' || revalue2 == 3){
		alert("퇴사일이 적합하지 않습니다. 바르게 입력해 주십시오.");
		main.eday.focus();
		return false;
	}
	
var symd1 = syear+fn_setFillzeroByVal(smon,2)+fn_setFillzeroByVal(sday,2);
var eymd2 = eyear+fn_setFillzeroByVal(emon,2)+fn_setFillzeroByVal(eday,2);	

	if(eval(symd1) > eval(eymd2) ){
		alert("퇴사일이 입사일 이전 입니다. 바르게 입력해 주십시오.");
		main.syear.focus();
		return false;
	}

	return true;
}

function setDate(){
	var main = document.form1;

	//입사 퇴사 일자체크
	if(!dateChk()) return;

	var syear = main.syear.value;
	var smon  = main.smon.value;
	var sday  = main.sday.value;

	var eyear = main.eyear.value;
	var emon  = main.emon.value;
	var eday  = main.eday.value;

	var sdate1 = main.syear.value+'/'+main.smon.value+'/'+main.sday.value;
	var edate1 = main.eyear.value+'/'+main.emon.value+'/'+main.eday.value;

	//재직일수 구하기
	//var sDate = new Date(syear, smon,sday);     
	//var eDate = new Date(eyear, emon,eday);   
	//var termDays = Math.ceil((eDate-sDate)/24/60/60/1000);    //오늘날짜와 특정 날짜의 차를 구한다

	var sDate = new Date(sdate1);
	var eDate = new Date(edate1);  
	var termDays = Math.ceil((eDate-sDate)/1000/60/60/24);    //오늘날짜와 특정 날짜의 차를 구한다
	main.termDays.value = termDays;

	var maxDay = fn_MaxdayYearMonth(eyear, emon); 

	var yy;
	var mm;  
	var dd;
	var dd2;
	var cntday = 0;
	var fymd;
	var tymd;  
	var sumday = 0;
	var sumbasic = 0;
	var sumbonus = 0;

	if(eval(eday -1) == 0){   //1일이라면
		emon = emon -1;
		//eday = fn_MaxdayYearMonth(eyear, emon);   //전달 말일
		idx = 3;
		main.index_value.value = "3";
	}else if(eval(eday -1) > 0){	// 5.31, 5.30
		idx = 4;	
		main.index_value.value = "4";
	}    

	// 5.29, 5.30, 5.31 일 경우 2월 계산을 하지 않키위해서. 윤년일때는 5.29일 허용
	if( (emon+eday == '529' && !fn_isLeafYear(eyear)) || emon+eday == '530' || emon+eday == '531'){
		idx = 3;
		main.index_value.value = "3";
	}

	if(idx == 3){
		main.basic4.value = "0";
		main.bonus4.value = "0";
		main.basic4.disabled	= true;
		main.bonus4.disabled	= true;
		main.basic4.className	= "noinput";
		main.bonus4.className	= "noinput";
	}else if(idx ==4){
		//main.basic4.value = "0";
		//main.bonus4.value = "0";
		main.basic4.disabled	= false;
		main.bonus4.disabled	= false;
		main.basic4.className	= "textfield";
		main.bonus4.className	= "textfield";
	}

	for(i=1; i<idx+1 ; i++){

		//년월 계산
		if(eval(emon - idx + i) <= 0){
			yy = eval(eyear -1);
			mm =  12 + eval(emon - idx + i);
			
		}else{
			yy = eyear ;
			mm = eval(emon - idx) + i;              
		}
		
		//일자 계산
		if(idx == 3){
			if( ((emon+eday == '529' && !fn_isLeafYear(eyear)) || emon+eday == '530' || emon+eday == '531') && i == 3){
				dd = 1;
				dd2 = eval(eday -1);
			} else {
				dd  = 1;
				dd2 = fn_MaxdayYearMonth(yy,mm);
			}
		}else if(idx ==4){
			if(i ==1){      
				
				if(eval(eday) > eval(fn_MaxdayYearMonth(yy,mm))){
					dd = fn_MaxdayYearMonth(yy,mm) - eval(fn_MaxdayYearMonth(eyear,emon) - eval(eday));				
				}else{
					dd = eval(eday);
				}
				dd2 = fn_MaxdayYearMonth(yy,mm);
			}else if(i ==2 || i ==3){
				dd = 1;
				dd2 = fn_MaxdayYearMonth(yy,mm);
			}else if(i ==4){
				dd = 1;
				dd2 = eval(eday -1);
			}
		}    

		//날짜 관련 화면셋팅
		fymd = yy+"."+mm+"."+dd;
		
		if(dd2 != 0 && dd != dd2) {
			tymd = "~ "+yy+"."+mm+"."+dd2;
			var s = new Date(yy, mm,dd);     
			var e = new Date(yy, mm,dd2);  
			cntday = Math.ceil((e-s)/24/60/60/1000) +1;
		}else{
			tymd = "";            
			cntday = 1;
		}
		
		if(idx ==3 && i ==3){
			main.elements['fymd4'].value = "";
			main.elements['tymd4'].value = "";
			main.elements['cntday4'].value = "";               
		}
		
		sumday = eval(sumday + cntday);          

		main.elements['fymd'+i].value = fymd;
		main.elements['tymd'+i].value = tymd;
		main.elements['cntday'+i].value = cntday;

		//월별일수
		main.elements['sumday'].value = sumday;                               
	} 
	
	//기간이 바뀌면 기간별 금액도 바뀐다.
	//main.sumbasic.value = 0 ;
    //main.sumbonus.value = 0 ;  
	main.control.value = "1";
}	


function sumPay(obj){   
   
	var main = document.form1;

	if(main.control.value != "1"){
		obj.value = "0";
		alert("'평균임금계산 기간보기' 버튼을 눌러 주십시오");
		return;
	}
	
	var sumbasic = 0;
	var sumbonus = 0;
	var sumday = 0;
    for(j=1; j < idx+1; j++){
        
        sumbasic = sumbasic + parseInt(delCom(main.elements['basic'+j].value,main.elements['basic'+j].value.length));
        sumbonus = sumbonus + parseInt(delCom(main.elements['bonus'+j].value, main.elements['bonus'+j].value.length));
		sumday = sumday + parseInt(main.elements['cntday'+j].value);
    }
    
    main.sumbasic.value = checkThousand(sumbasic+"", '0','N');
    main.sumbonus.value = checkThousand(sumbonus+"", '0','N');  
	main.sumday.value = sumday;
}
        
function avrPayCal(){

	var main = document.form1;
    //입사 퇴사 일자체크
	if(!dateChk()) return;
	
	//평균임금계산 체크
	if(main.control.value != "1"){
		alert("'평균임금계산 기간보기' 버튼을 눌러 주십시오");
		return;
	}

    var avrPay = 0;
    var totalPay = 0;
	var rounding = 0;
    var annualBonus = 0;
    var vacaBunus = 0;
    var sumbasic = eval(delCom(main.sumbasic.value, main.sumbasic.value.length * 1));
    var sumbonus = eval(delCom(main.sumbonus.value, main.sumbonus.value.length * 1));

	if(main.sumbasic.value == "" || main.sumbasic.value == "0")	sumbasic =0;
	if(main.sumbonus.value == "" || main.sumbonus.value == "0")	sumbonus =0;

    //상여금 계산
    annualBonus = eval(delCom(main.annualBonus.value,main.annualBonus.value.length) * 0.25);

    //연차수당
    vacaBunus = eval(delCom(main.vacaBunus.value, main.vacaBunus.value.length) * 0.25);

    //총합
    totalPay = eval(sumbasic + sumbonus + annualBonus + vacaBunus);

    //임금총합이 0일때
	if(main.avrPay.value == "" && totalPay == 0 ){
		alert("임금총합이 0 입니다. 임금을 입력해 주십시오.");
		return;
	}
	
	//alert("기본급합parseInt=="+ eval(annualBonus + vacaBunus));
    //alert("기본급합eval="+ eval(sumbasic + sumbonus));
    //alert("기본급합="+ sumbasic + sumbonus);
    //alert("합계액 ="+totalPay);
    //alert("평균임금==>"+eval(totalPay /main.sumday.value));
    //alert("세째자리반올림==>"+myRound(eval(totalPay /main.sumday.value), 2));

    //소수 셋째 자리에서 반올림
	rounding = myRound(eval(totalPay /main.sumday.value),2)+"";
	//셋째자리에서 올림
	rounding = myCeil(eval(totalPay /main.sumday.value),2)+"";
	
	//금액 포멧만들어주기
	if(rounding.indexOf(".") == -1){
	}else{
		var k = rounding.lastIndexOf(".");
		var comFormat = checkThousand(rounding.substring(0, k), '0','N'); ;		
		rounding = comFormat + rounding.substring(k, rounding.length)
	}
	//1일 평균임금. 
    main.avrPay.value = rounding;
	
	//퇴직금은 ""로 셋팅
	main.retirePay.value= "";
}


function calRet(){
    var main = document.form1;
	//입사 퇴사 일자체크
	if(!dateChk()) return;

    var retPay =0;
	var rounding ;
	var comPay = delCom(main.comPay.value, main.comPay.value.length);
	var avrPay = delCom(main.avrPay.value, main.avrPay.value.length);
	var calPay = delCom(main.avrPay.value, main.avrPay.value.length);	//기본은 평균값으로 

    //평균임금이 입력되어 있는 지 계산
	if(main.avrPay.value =="" || main.avrPay.value =="0"){
		alert("1일 평균임금이 없습니다. '평균임금계산' 버튼을 눌러 계산하시거나 직접 입력해 주십시오");
		return;
	}

	//평균임금계산 체크
	if(main.control.value != "1"){
		alert("'평균임금계산 기간보기' 버튼을 눌러 주십시오");
		return;
	}

	//통상임금이 일일평균임금보다 클경우 통상임금이 일일평균임금임.
	if(main.comPay.value != "" && main.comPay.value != "0"){
		if(parseFloat(avrPay) < parseFloat(comPay)){
			calPay = comPay;
		}
	}

	//retirePay = parseInt(calPay) * 30 * parseInt(main.termDays.value)/365; 
	//평균임금 소수점 제외계산을 소수점 포함하여 계산
	retirePay = calPay * 30 * parseInt(main.termDays.value)/365; 
	
	//소수 셋째 자리에서 반올림
	rounding = myRound(retirePay,2)+"";
	
	//금액 포멧만들어주기
	if(rounding.indexOf(".") == -1){
		rounding =checkThousand(rounding, '0','N'); ;	
	}else{
		var k = rounding.lastIndexOf(".");
		var comFormat = checkThousand(rounding.substring(0, k), '0','N'); ;		
		rounding = comFormat + rounding.substring(k, rounding.length)
	}

    main.retirePay.value= rounding;
}

function payreset(){
	var main = document.form1;

	main.basic1.value = "0";
	main.basic2.value = "0";
	main.basic3.value = "0";
	main.basic4.value = "0";
	main.bonus1.value = "0";
	main.bonus2.value = "0";
	main.bonus3.value = "0";
	main.bonus4.value = "0";
	main.sumbasic.value = "";
	main.sumbonus.value = "";

}

function setCurrYear(){
	var main = document.form1;
	for(m =0; m<main.syear.options.length; m++){
		if(main.syear.options[m].value == fn_getDateNowYear()){
			main.syear.options[m].selected =true ;
		}
	}

	for(n =0; n<main.eyear.options.length; n++){
		if(main.eyear.options[n].value == fn_getDateNowYear()){
			main.eyear.options[n].selected =true ;
		}
	}
}

function view_excel(){
	var main = document.form1;
	
	if(main.retirePay.value == "" ){
		alert("퇴직금 계산을 해주십시오.");
		return;
	}
	
	//top.location.href = "view_excel.jsp?fymd1="+main.fymd1.value;

	main.target="_top";
	main.action="view_excel.jsp";
	main.submit();
}