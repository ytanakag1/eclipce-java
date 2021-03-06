package application;

import java.io.IOException;
import java.net.URL;
import java.util.List;
import java.util.Map;
import java.util.Random;
import java.util.ResourceBundle;

import javafx.scene.control.TextField;
import javafx.scene.control.Label;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;

	
	public class fmController implements Initializable {
		private List<Map<String, String>> list;
		protected String answer;
		
		@FXML private Label testLabel; //問題ラベル
		@FXML private Label judge; //判定ラベル
		@FXML private TextField testTextField;
		
		private Random rand = new Random();
		private int lstCount;
		
		@Override
		public void initialize(URL url, ResourceBundle rb) {
			//URLからファイルをstreamで読み込む
          
		
			Tango tangoList = new Tango();
			// 他のクラスのフィールドを使うにはtry~catith 必須
			try {
				list =  tangoList.tango();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			 lstCount = list.size();
			 creatQuestion();
			 testTextField.setFocusTraversable(true); // フォーカス
		}  //end initialze
	
	 
		@FXML
		protected void oninputButtonClick(ActionEvent evt) { // ボタンクリック
			Task task1 = new Task(testTextField.getText());
			String inpuText = task1.getResultText( answer);
			judge.setText( inpuText + " : " + answer );	
		}
	 
		@FXML
		protected void onGetButtonClick(ActionEvent evt) { //  Next ボタンクリック
			testTextField.setText(""); 
			judge.setText( " " );	
			creatQuestion();
		}
		
		@FXML
		protected void onKosanclick(ActionEvent evt) { // kousan ボタンクリック
			judge.setText( "正解は : " + answer );	
		}
		
		
		protected void creatQuestion() {
			
			int ransu = rand.nextInt(lstCount);
			for(Map.Entry<String, String> entry : list.get(ransu).entrySet()) {
				testLabel.setText( entry.getKey() ); // 未入力テキスト
				answer = entry.getValue();
			}
		}
	
	
}
