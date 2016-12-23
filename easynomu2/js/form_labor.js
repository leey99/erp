var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function OnStart(){

	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()) {
		//alert("��������� ���ͳ� �ͽ��÷η������� �����մϴ�.);
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

	InitToolBarJS();
	
	if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
			var act = pHwpCtrl.CreateAction("InsertText");
			var set = act.CreateSet();
			set.SetItem("Text",document.HwpControl.mb_name.value );
			act.Execute(set);
		}
	}

	if(document.HwpControl.labor.value != '') {
		pageLoad(document.HwpControl.labor.value);
	}

}
//custom Toolbar ���� �⺻ �׼ǿ��� ���θ����, ����, �ٸ��̸����� ����, ����, �� ���µ� ��ü �׼��� ���� ���
//html�� onstart()�� ������ ���� �ְ� ����ϸ� �ȴ�. ��ܿ� �Լ��� onstart�ִ�.
function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
//	HwpControl.HwpCtrl.SetToolBar(3, "FileNew, FileSave, FileSaveAs, FileOpen");
	/*
	HwpControl.HwpCtrl.SetToolBar(0, "FileNew, FileSave, FileSaveAs, FileOpen, Separator, FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	*/
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	/*
	HwpControl.HwpCtrl.SetToolBar(1, "DrawObjCreatorLine, DrawObjCreatorRectangle, DrawObjCreatorEllipse,"
	+"DrawObjCreatorArc, DrawObjCreatorPolygon, DrawObjCreatorCurve, DrawObjTemplateLoad,"
	+"Separator, ShapeObjSelect, ShapeObjGroup, ShapeObjUngroup, Separator, ShapeObjBringToFront,"
	+"ShapeObjSendToBack, ShapeObjDialog, ShapeObjAttrDialog");

	HwpControl.HwpCtrl.SetToolBar(2, "StyleCombo, CharShapeLanguage, CharShapeTypeFace, CharShapeHeight,"
	+"CharShapeBold, CharShapeItalic, CharShapeUnderline, ParagraphShapeAlignJustify, ParagraphShapeAlignLeft,"
	+"ParagraphShapeAlignCenter, ParagraphShapeAlignRight, Separator, ParaShapeLineSpacing,"
	+"ParagraphShapeDecreaseLeftMargin, ParagraphShapeIncreaseLeftMargin");
	*/
	HwpControl.HwpCtrl.ShowToolBar(true);

}

function _VerifyVersion(){	 //��ġ Ȯ��
	if(pHwpCtrl.Version == null){
//	if(pHwpCtrl.getAttribute("Version") == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("�ѱ�  ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.");
		return false;
	}
	//���� Ȯ��
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl�� ������ ���Ƽ� ���������� �������� ���� �� �ֽ��ϴ�.\n"+
			"�ֽ� �������� ������Ʈ�ϱ⸦ �����մϴ�.\n\n"+
			"���� ����:" + CurVersion + "\n"+
			"���� ����:" + MinVersion + " �̻�"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath�� ���Ѵ�.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath ����
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// �� ����������.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath ����
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // ���̺� ���� Ŀ���� �ִ°�?
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			//�� ������
			if(i==99){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else{
				dact.Execute(dset);
				pHwpCtrl.Run("TableRightCell");
			}
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
		return false;
	}
}

function TableAppendRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false)){
		pHwpCtrl.Run("TableCellBlock");
		pHwpCtrl.Run("TableColPageDown");
		pHwpCtrl.Run("Cancel");
		pHwpCtrl.Run("TableAppendRow");
		return true;
	}else	{
		if (_DEBUG)
			alert("���ʵ�(" + FirstCellName +")�� �������� �ʽ��ϴ�.");
		return false;
	}
}


// ǥ�� ������ ���� �߰��ϰ�, ������ ä���.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
}

function TableAppendRowContents2(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents2(ColumnArray);
}



function TableColumnContents2(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ 
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			dact.Execute(dset);
			pHwpCtrl.Run("TableRightCell");
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
		return false;
	}
}

function TableDeleteRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false))
	{
		pHwpCtrl.Run("TableDeleteRow");
	}
}


function pageLoad(pName){
	//alert('�غ����Դϴ�!'); return;

	var labor1 ='';
	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+(now.getMonth()+1);
	var dd = ''+now.getDate();
	var toDay = yyyy +' ��  '+ mm + ' ��  ' + dd + ' ��';


	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	labor1='labor_1a.hwp';

	switch(pName){
		case 'labor1': { // �ٷΰ�༭
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+labor1)){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[��������1]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������2]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������3]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������4]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������5]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������6]", true, true, false)) {set.SetItem("Text",frm.addtxt11_5.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�1]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�2]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�3]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�4]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�5]", true, true, false)) {set.SetItem("Text",frm.addtxt12_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[��������ݾ�6]", true, true, false)) {set.SetItem("Text",frm.addtxt12_5.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[ȣ��]", true, true, false)) {	set.SetItem("Text",frm.job_grade.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[�ð���]", true, true, false)) {set.SetItem("Text",frm.timegub.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[���ó�¥]", true, true, false)) {set.SetItem("Text",frm.today.value);act.Execute(set);}
			
				if (pHwpCtrl.MoveToField("[������1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������2]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������3]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������4]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������5]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������6]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������7]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������8]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������9]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������10]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������11]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������12]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[����ڵ�Ϲ�ȣ]", true, true, false)) {	set.SetItem("Text",frm.comp_num.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ǥ]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[������ּ�]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +' '+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)) {	set.SetItem("Text",frm.comp_upte.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[�������1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�������2]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ֹε�Ϲ�ȣ]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����ּ�]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի�����1]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�Ի�����2]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��������]", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[ä������]", true, true, false)) {	set.SetItem("Text",frm.job_div.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[��ٽð�]", true, true, false)) {	set.SetItem("Text",frm.stime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[��ٽð�]", true, true, false)) {	set.SetItem("Text",frm.etime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ϱٹ��ð�]", true, true, false)) {	set.SetItem("Text",frm.wtime.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�ּ����ٹ��ð�]", true, true, false)) {	set.SetItem("Text",frm.jogun.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�⺻�޿�]", true, true, false)) {	set.SetItem("Text",frm.pay1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[����������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay3.value );	act.Execute(set)	;}
				if (pHwpCtrl.MoveToField("[���������հ�]", true, true, false)) {	set.SetItem("Text",frm.pay4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[���޿����հ�]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[�޿���]", true, true, false)) {	set.SetItem("Text",frm.pay_day.value );	act.Execute(set);	}
			}
			break;
		}
		case 'career_describe': { // ��±����
			if(!pHwpCtrl.Open(BasePath + "/files/docs/career_describe.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�������", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("���ּ�", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.sex.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.age.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�з�1", true, true, false)){set.SetItem("Text",frm.hak1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�з�2", true, true, false)){set.SetItem("Text",frm.hak2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�з�3", true, true, false)){set.SetItem("Text",frm.hak3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.graduate1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����2", true, true, false)){set.SetItem("Text",frm.graduate2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����3", true, true, false)){set.SetItem("Text",frm.graduate3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�����1", true, true, false)) {	set.SetItem("Text",frm.career_date1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����2", true, true, false)) {	set.SetItem("Text",frm.career_date2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����3", true, true, false)) {	set.SetItem("Text",frm.career_date3.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ٹ�ó1", true, true, false)) {	set.SetItem("Text",frm.career_space1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ٹ�ó2", true, true, false)) {	set.SetItem("Text",frm.career_space2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ٹ�ó3", true, true, false)) {	set.SetItem("Text",frm.career_space3.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����1", true, true, false)) {	set.SetItem("Text",frm.career_jik1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����2", true, true, false)) {	set.SetItem("Text",frm.career_jik2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����3", true, true, false)) {	set.SetItem("Text",frm.career_jik3.value );	act.Execute(set);	}
			}
			break;
		}
		case 'labor15': { // �������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/career_certificate.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�Ҽ�", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ֹε�Ϲ�ȣ", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ּ�", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�Ի���", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ����", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ��", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������1", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				
			}
			break;
		}
		case 'public_document': { // ����(����������)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/public_document.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("������", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("������1", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ּ�", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value+" "+frm.comp_addr2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ȭ", true, true, false)) {	set.SetItem("Text",frm.comp_tel.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ѽ�", true, true, false)) {	set.SetItem("Text",frm.comp_fax.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�̸���", true, true, false)) {	set.SetItem("Text",frm.comp_email.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ����", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ��", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		}
		case 'advice_resign': { // �ǰ������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/advice_resign.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ֹε�Ϲ�ȣ", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'minor_consent': { // �̼�����������Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/minor_consent.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�������", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ּ�", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.age.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'resign': { // ������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/resign.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.resign_cause.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�Ի���", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("������", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'identity': { // �ſ�������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/identity.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("���ּ�", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�������", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ֹε�Ϲ�ȣ", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'personnel_appointment': { // �λ�߷���
			if(!pHwpCtrl.Open(BasePath + "/files/docs/personnel_appointment.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}
			else{
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����1", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�⵵", true, true, false)) {	set.SetItem("Text",frm.yy.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�⵵1", true, true, false)) {	set.SetItem("Text",frm.yy.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������1", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'hold_retirement_certificate': { // ����(����)����
			if(!pHwpCtrl.Open(BasePath + "/files/docs/hold_retirement_certificate.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("�ּ�", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ֹι�ȣ", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ٹ�������", true, true, false)) {	set.SetItem("Text",frm.sdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ٹ�������", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ����", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ��", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		}
		case 'business_trip_report': { // ����ǰ�Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/business_trip_report.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;			
		}
		case 'worker_register_holder': { // �ٷ��ڸ��(������)
			var worker_count = frm.worker_count.value;
			if(worker_count > 16 && worker_count <= 32) worker_register_holder_hwp = 'worker_register_holder_2page.hwp';
			else if(worker_count > 33 && worker_count <= 48) worker_register_holder_hwp = 'worker_register_holder_3page.hwp';
			else if(worker_count > 49 && worker_count <= 64) worker_register_holder_hwp = 'worker_register_holder_4page.hwp';
			else worker_register_holder_hwp = 'worker_register_holder.hwp';

			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+worker_register_holder_hwp)){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if(worker_count <= 16) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<16;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 32) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<32;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 48) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����3", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������3", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<48;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 64) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����3", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������3", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����4", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������4", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<64;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
			}
			break;
		}
		case 'worker_register_retiree': { // �ٷ��ڸ��(������)
			var worker_count = frm.worker_count.value;
			if(worker_count > 16 && worker_count <= 32) worker_register_retiree_hwp = 'worker_register_retiree_2page.hwp';
			else if(worker_count > 33 && worker_count <= 48) worker_register_retiree_hwp = 'worker_register_retiree_3page.hwp';
			else if(worker_count > 49 && worker_count <= 64) worker_register_retiree_hwp = 'worker_register_retiree_4page.hwp';
			else worker_register_retiree_hwp = 'worker_register_retiree.hwp';

			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+ worker_register_retiree_hwp)){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if(worker_count <= 16) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<16;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 32) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<32;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 48) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����3", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������3", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<48;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 64) {
					if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�����4", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("��������4", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// ���� ���κ� ����Ʈ
					for(i=0;i<64;i++){
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ֹι�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰ���"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ڰݹ�ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�ּ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("ȣ"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("��������"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
			}
			break;
		}
		case 'night_holiday_work_consent': { // �߰����ϱٷε��Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/night_holiday_work_consent.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("�Ҽ�", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�ð�", true, true, false)){set.SetItem("Text",frm.time.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ����", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
			}
			break;
		}
		case 'extend_work_consent': { // ����ٷ����Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/extend_work_consent.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�μ�", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ����", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
			}
			break;
		}
		case 'personnel_document_card': { // �λ���ī��(����)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/personnel_document_card.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ֹι�ȣ", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)) {	set.SetItem("Text",frm.sex.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�������", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ּ�", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��������1", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����2", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��ǥ����", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ��", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		}
		case 'change_vacation_agree': { // ��ü�ް����Ǽ�
			if(!pHwpCtrl.Open(BasePath + "/files/docs/change_vacation_agree.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("��ǥ��", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��ǥ���ֹι�ȣ", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("������ּ�", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value+" "+frm.comp_addr2.value);	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�ֹι�ȣ", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�ּ�", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ��1", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��ǥ��2", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����2", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'written_apology': { // �ø���
			if(!pHwpCtrl.Open(BasePath + "/files/docs/written_apology.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("�Ҽ�", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("��ǥ����", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
			}
			break;
		}
		case 'annual_paid_holiday': { // ������������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/annual_paid_holiday.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("�⵵", true, true, false)){set.SetItem("Text",frm.yy.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�����", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}

				// ���� ���κ� ����Ʈ
				for(i=0;i<30;i++){
					if (pHwpCtrl.MoveToField("��å"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�Ի�����"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�߻��ϼ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.annual_sum[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("����ϼ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.annual_use[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("�ܿ��ϼ�"+(i+1), true, true, false)) {	set.SetItem("Text",frm.annual_rest[i].value );	act.Execute(set);	}
				}
			}
			break;
		}
		case 'attendance_reason': { // ����,����,��� ������
			if(!pHwpCtrl.Open(BasePath + "/files/docs/attendance_reason.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
			}
			break;
		}
		case 'vacation': { // �ް���û��(ȸ��)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/vacation_request.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("�Ҽ�", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����ó", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�ް�����", true, true, false)){set.SetItem("Text",frm.cause.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�Ⱓ", true, true, false)){set.SetItem("Text",frm.vdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�༱��", true, true, false)){set.SetItem("Text",frm.space.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.reason.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.today.value );act.Execute(set);}
			}
			break;
		}
		case 'bonus_pay_ledger': { // �󿩱����޴���
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bonus_pay_ledger.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.approval1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����2", true, true, false)){set.SetItem("Text",frm.approval2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����3", true, true, false)){set.SetItem("Text",frm.approval3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("�����", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("�⵵", true, true, false)){set.SetItem("Text",frm.yy.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.bonus_time1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����2", true, true, false)){set.SetItem("Text",frm.bonus_time2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����3", true, true, false)){set.SetItem("Text",frm.bonus_time3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����4", true, true, false)){set.SetItem("Text",frm.bonus_time4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����5", true, true, false)){set.SetItem("Text",frm.bonus_time5.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("����6", true, true, false)){set.SetItem("Text",frm.bonus_time6.value);act.Execute(set);}
				setRowInsert();
			}
			break;
		}
		case 'retirement_pay_ledger': { // ���������޴���
			if(!pHwpCtrl.Open(BasePath + "/files/docs/retirement_pay_ledger.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("�⵵", true, true, false)){set.SetItem("Text",frm.yy.value);act.Execute(set);}
				setRowInsert();
			}
			break;	
		}
		default : {
			if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
					var act = pHwpCtrl.CreateAction("InsertText");
					var set = act.CreateSet();
					set.SetItem("Text",frm.mb_name.value );
					act.Execute(set);
				}
			}
		}
	}
	pHwpCtrl.MovePos(2);
}

$(document).ready(function(e) {
	//alert(myagent);
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='./';
	}
});