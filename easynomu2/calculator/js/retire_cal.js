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

	//�Ի����� ��ȿ�� üũ
	if(main.syear.value =='' || main.syear.value =='0' ||revalue1 == 1 ){
		alert("�Ի�⵵�� �������� �ʽ��ϴ�. �ٸ��� �Է��� �ֽʽÿ�.");
		main.syear.focus();
		return false;
	}
	if(main.smon.value =='' || main.smon.value =='0' || revalue1 == 2){
		alert("�Ի���� �������� �ʽ��ϴ�. �ٸ��� �Է��� �ֽʽÿ�.");
		main.smon.focus();
		return false;
	} 
	if(main.sday.value =='' || main.sday.value =='0' || revalue1 == 3){
		alert("�Ի����� �������� �ʽ��ϴ�. �ٸ��� �Է��� �ֽʽÿ�.");
		main.sday.focus();
		return false;
	}

	var revalue2 = fn_isYearMonthDay(eyear, emon, eday);
	//������� ��ȿ�� üũ
	if(main.eyear.value =='' || main.eyear.value =='0' || revalue2 == 1){
		alert("���⵵�� �������� �ʽ��ϴ�. �ٸ��� �Է��� �ֽʽÿ�.");
		main.eyear.focus();
		return false;
	}
	if(main.emon.value =='' || main.emon.value =='0' || revalue2 == 2){
		alert("������ �������� �ʽ��ϴ�. �ٸ��� �Է��� �ֽʽÿ�.");
		main.emon.focus();
		return false;
	}
	if(main.eday.value =='' || main.eday.value =='0' || revalue2 == 3){
		alert("������� �������� �ʽ��ϴ�. �ٸ��� �Է��� �ֽʽÿ�.");
		main.eday.focus();
		return false;
	}
	
var symd1 = syear+fn_setFillzeroByVal(smon,2)+fn_setFillzeroByVal(sday,2);
var eymd2 = eyear+fn_setFillzeroByVal(emon,2)+fn_setFillzeroByVal(eday,2);	

	if(eval(symd1) > eval(eymd2) ){
		alert("������� �Ի��� ���� �Դϴ�. �ٸ��� �Է��� �ֽʽÿ�.");
		main.syear.focus();
		return false;
	}

	return true;
}

function setDate(){
	var main = document.form1;

	//�Ի� ��� ����üũ
	if(!dateChk()) return;

	var syear = main.syear.value;
	var smon  = main.smon.value;
	var sday  = main.sday.value;

	var eyear = main.eyear.value;
	var emon  = main.emon.value;
	var eday  = main.eday.value;

	var sdate1 = main.syear.value+'/'+main.smon.value+'/'+main.sday.value;
	var edate1 = main.eyear.value+'/'+main.emon.value+'/'+main.eday.value;

	//�����ϼ� ���ϱ�
	//var sDate = new Date(syear, smon,sday);     
	//var eDate = new Date(eyear, emon,eday);   
	//var termDays = Math.ceil((eDate-sDate)/24/60/60/1000);    //���ó�¥�� Ư�� ��¥�� ���� ���Ѵ�

	var sDate = new Date(sdate1);
	var eDate = new Date(edate1);  
	var termDays = Math.ceil((eDate-sDate)/1000/60/60/24);    //���ó�¥�� Ư�� ��¥�� ���� ���Ѵ�
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

	if(eval(eday -1) == 0){   //1���̶��
		emon = emon -1;
		//eday = fn_MaxdayYearMonth(eyear, emon);   //���� ����
		idx = 3;
		main.index_value.value = "3";
	}else if(eval(eday -1) > 0){	// 5.31, 5.30
		idx = 4;	
		main.index_value.value = "4";
	}    

	// 5.29, 5.30, 5.31 �� ��� 2�� ����� ���� ��Ű���ؼ�. �����϶��� 5.29�� ���
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

		//��� ���
		if(eval(emon - idx + i) <= 0){
			yy = eval(eyear -1);
			mm =  12 + eval(emon - idx + i);
			
		}else{
			yy = eyear ;
			mm = eval(emon - idx) + i;              
		}
		
		//���� ���
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

		//��¥ ���� ȭ�����
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

		//�����ϼ�
		main.elements['sumday'].value = sumday;                               
	} 
	
	//�Ⱓ�� �ٲ�� �Ⱓ�� �ݾ׵� �ٲ��.
	//main.sumbasic.value = 0 ;
    //main.sumbonus.value = 0 ;  
	main.control.value = "1";
}	


function sumPay(obj){   
   
	var main = document.form1;

	if(main.control.value != "1"){
		obj.value = "0";
		alert("'����ӱݰ�� �Ⱓ����' ��ư�� ���� �ֽʽÿ�");
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
    //�Ի� ��� ����üũ
	if(!dateChk()) return;
	
	//����ӱݰ�� üũ
	if(main.control.value != "1"){
		alert("'����ӱݰ�� �Ⱓ����' ��ư�� ���� �ֽʽÿ�");
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

    //�󿩱� ���
    annualBonus = eval(delCom(main.annualBonus.value,main.annualBonus.value.length) * 0.25);

    //��������
    vacaBunus = eval(delCom(main.vacaBunus.value, main.vacaBunus.value.length) * 0.25);

    //����
    totalPay = eval(sumbasic + sumbonus + annualBonus + vacaBunus);

    //�ӱ������� 0�϶�
	if(main.avrPay.value == "" && totalPay == 0 ){
		alert("�ӱ������� 0 �Դϴ�. �ӱ��� �Է��� �ֽʽÿ�.");
		return;
	}
	
	//alert("�⺻����parseInt=="+ eval(annualBonus + vacaBunus));
    //alert("�⺻����eval="+ eval(sumbasic + sumbonus));
    //alert("�⺻����="+ sumbasic + sumbonus);
    //alert("�հ�� ="+totalPay);
    //alert("����ӱ�==>"+eval(totalPay /main.sumday.value));
    //alert("��°�ڸ��ݿø�==>"+myRound(eval(totalPay /main.sumday.value), 2));

    //�Ҽ� ��° �ڸ����� �ݿø�
	rounding = myRound(eval(totalPay /main.sumday.value),2)+"";
	//��°�ڸ����� �ø�
	rounding = myCeil(eval(totalPay /main.sumday.value),2)+"";
	
	//�ݾ� ���丸����ֱ�
	if(rounding.indexOf(".") == -1){
	}else{
		var k = rounding.lastIndexOf(".");
		var comFormat = checkThousand(rounding.substring(0, k), '0','N'); ;		
		rounding = comFormat + rounding.substring(k, rounding.length)
	}
	//1�� ����ӱ�. 
    main.avrPay.value = rounding;
	
	//�������� ""�� ����
	main.retirePay.value= "";
}


function calRet(){
    var main = document.form1;
	//�Ի� ��� ����üũ
	if(!dateChk()) return;

    var retPay =0;
	var rounding ;
	var comPay = delCom(main.comPay.value, main.comPay.value.length);
	var avrPay = delCom(main.avrPay.value, main.avrPay.value.length);
	var calPay = delCom(main.avrPay.value, main.avrPay.value.length);	//�⺻�� ��հ����� 

    //����ӱ��� �ԷµǾ� �ִ� �� ���
	if(main.avrPay.value =="" || main.avrPay.value =="0"){
		alert("1�� ����ӱ��� �����ϴ�. '����ӱݰ��' ��ư�� ���� ����Ͻðų� ���� �Է��� �ֽʽÿ�");
		return;
	}

	//����ӱݰ�� üũ
	if(main.control.value != "1"){
		alert("'����ӱݰ�� �Ⱓ����' ��ư�� ���� �ֽʽÿ�");
		return;
	}

	//����ӱ��� ��������ӱݺ��� Ŭ��� ����ӱ��� ��������ӱ���.
	if(main.comPay.value != "" && main.comPay.value != "0"){
		if(parseFloat(avrPay) < parseFloat(comPay)){
			calPay = comPay;
		}
	}

	//retirePay = parseInt(calPay) * 30 * parseInt(main.termDays.value)/365; 
	//����ӱ� �Ҽ��� ���ܰ���� �Ҽ��� �����Ͽ� ���
	retirePay = calPay * 30 * parseInt(main.termDays.value)/365; 
	
	//�Ҽ� ��° �ڸ����� �ݿø�
	rounding = myRound(retirePay,2)+"";
	
	//�ݾ� ���丸����ֱ�
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
		alert("������ ����� ���ֽʽÿ�.");
		return;
	}
	
	//top.location.href = "view_excel.jsp?fymd1="+main.fymd1.value;

	main.target="_top";
	main.action="view_excel.jsp";
	main.submit();
}