package application;

public class Task {
	private String tgtText;
	
	//  vコンストラクタ
	public Task(String tgt_text) {
		tgtText=tgt_text;
	}
	
	
	// vテキストBOXの値処理
	public String getResultText(String ans) {
		String resultText = "";
		//  v正解判定
		if (tgtText.equals(ans)) {
			resultText = "正解!";
		}else {
			resultText = "ハズレ";
		}
		return resultText;
	}
	
	
}
