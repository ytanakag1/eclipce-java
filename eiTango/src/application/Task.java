package application;

public class Task {
	private String tgtText;
	
	// コンストラクタ
	public Task(String tgt_text) {
		tgtText=tgt_text;
	}
	
	
	// テキストBOXの値処理
	public String getResultText(String ans) {
		String resultText = "";
		// 正解判定
		if (tgtText.equals(ans)) {
			resultText = "正解!";
		}else {
			resultText = "ハズレ";
		}
		return resultText;
	}
	
	
}
