package application;

public class Task {
	private String tgtText;
	
	//  v�R���X�g���N�^
	public Task(String tgt_text) {
		tgtText=tgt_text;
	}
	
	
	// v�e�L�X�gBOX�̒l����
	public String getResultText(String ans) {
		String resultText = "";
		//  v���𔻒�
		if (tgtText.equals(ans)) {
			resultText = "����!";
		}else {
			resultText = "�n�Y��";
		}
		return resultText;
	}
	
	
}
