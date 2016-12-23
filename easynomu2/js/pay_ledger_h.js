var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;
var _DEBUG = true; // Debug mode.
var pHwpCtrl;
function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	HwpControl.HwpCtrl.ShowToolBar(true);
}
function _VerifyVersion(){	 //��ġ Ȯ��
	if(pHwpCtrl.Version == null){
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
			if(i==4){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else if(i==9){
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
function OnStart(){
	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;
	if(!_VerifyVersion()){
		location.href='main.php';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.
	InitToolBarJS();
	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();
	var pay_count = frm.pay_count.value;
	var pay_page = frm.pay_page.value;
	pay_table = 'pay_ledger_h_'+pay_page+'page.hwp';
	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		alphabet = "abcdefghijklmnopqrstuvwxyyz";
		for(k=1;k<=pay_page;k++) {
			if(k == 1) {
				p = "";
				u = "";
			} else {
				p = k;
				u = alphabet.charAt(k-1);
			}
			if (pHwpCtrl.MoveToField("[�����"+p+"]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿��⵵"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿���"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
		}
		tr_count = pay_page * 15;
		for(i=0;i<=tr_count;i++) {
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[����"+i+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�Ի���"+i+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ֹε�Ϲ�ȣ"+i, true, true, false)){set.SetItem("Text",frm.ssnb[i].value);act.Execute(set);}
			//�ٷνð�
			if (pHwpCtrl.MoveToField("[�Ұ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_sum[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���a"+i, true, true, false)){set.SetItem("Text",frm.w_1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���b"+i, true, true, false)){set.SetItem("Text",frm.w_2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���c"+i, true, true, false)){set.SetItem("Text",frm.w_3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�޽�a"+i, true, true, false)){set.SetItem("Text",frm.w_1_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�޽�b"+i, true, true, false)){set.SetItem("Text",frm.w_2_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�޽�c"+i, true, true, false)){set.SetItem("Text",frm.w_3_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����ð�"+i, true, true, false)){set.SetItem("Text",frm.w_edu[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����Ʈ��"+i, true, true, false)){set.SetItem("Text",frm.w_phone[i].value);act.Execute(set);}
			//�������� = ����������
			if (pHwpCtrl.MoveToField("��������"+i, true, true, false)){set.SetItem("Text",frm.annual_paid_holiday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�޿��Ѿ�"+i, true, true, false)){set.SetItem("Text",frm.money_for_tax[i].value);act.Execute(set);}
			//���ټ�
			if (pHwpCtrl.MoveToField("�ҵ漼"+i, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ֹμ�"+i, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}
			//��ȸ����
			if (pHwpCtrl.MoveToField("���ݺ���"+i, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ǰ�����"+i, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����"+i, true, true, false)){set.SetItem("Text",frm.yoyang[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��뺸��"+i, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			//�����հ�
			if (pHwpCtrl.MoveToField("������"+i, true, true, false)){set.SetItem("Text",frm.m_sum[i].value);act.Execute(set);}
			//���� ���޾�
			if (pHwpCtrl.MoveToField("�����Ѿ�"+i, true, true, false)){set.SetItem("Text",frm.money_result[i].value);act.Execute(set);}
		}
		//�Ѱ�
		if (pHwpCtrl.MoveToField("[�Ұ�t]", true, true, false)){set.SetItem("Text",frm.w_sum_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���at", true, true, false)){set.SetItem("Text",frm.w_1_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���bt", true, true, false)){set.SetItem("Text",frm.w_2_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ct", true, true, false)){set.SetItem("Text",frm.w_3_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�޽�at", true, true, false)){set.SetItem("Text",frm.w_1_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�޽�bt", true, true, false)){set.SetItem("Text",frm.w_2_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�޽�ct", true, true, false)){set.SetItem("Text",frm.w_3_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����ð�t", true, true, false)){set.SetItem("Text",frm.w_edu_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����Ʈ��t", true, true, false)){set.SetItem("Text",frm.w_phone_sum_t.value);act.Execute(set);}
		//�������� = ����������
		if (pHwpCtrl.MoveToField("��������t", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�޿��Ѿ�t", true, true, false)){set.SetItem("Text",frm.money_for_tax_sum_t.value);act.Execute(set);}
		//���ټ�
		if (pHwpCtrl.MoveToField("�ֹμ�t", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ҵ漼t", true, true, false)){set.SetItem("Text",frm.tax_so_sum_t.value);act.Execute(set);}
		//��ȸ����
		if (pHwpCtrl.MoveToField("���ݺ���t", true, true, false)){set.SetItem("Text",frm.yun_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ǰ�����t", true, true, false)){set.SetItem("Text",frm.health_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����t", true, true, false)){set.SetItem("Text",frm.yoyang_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��뺸��t", true, true, false)){set.SetItem("Text",frm.goyong_sum_t.value);act.Execute(set);}
		//�����հ�
		if (pHwpCtrl.MoveToField("������t", true, true, false)){set.SetItem("Text",frm.m_sum_sum_t.value);act.Execute(set);}
		//���� ���޾�
		if (pHwpCtrl.MoveToField("�����Ѿ�t", true, true, false)){set.SetItem("Text",frm.money_result_sum_t.value);act.Execute(set);}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='index.php';
	}		
});