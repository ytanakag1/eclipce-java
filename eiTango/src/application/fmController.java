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
		
		@FXML private Label testLabel; //��胉�x��
		@FXML private Label judge; //���胉�x��
		@FXML private TextField testTextField;
		
		private Random rand = new Random();
		private int lstCount;
		
		@Override
		public void initialize(URL url, ResourceBundle rb) {
			//URL����t�@�C����stream�œǂݍ���
          
			Tango tangoList = new Tango();
			 try {
				list =  tangoList.tango();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			 lstCount = list.size();
			 creatQuestion();
			 testTextField.setFocusTraversable(true); //�t�H�[�J�X
		}  //end initialze
	
	 
		@FXML
		protected void oninputButtonClick(ActionEvent evt) { //�u���́v�{�^���N���b�N
			Task task1 = new Task(testTextField.getText());
			String inpuText = task1.getResultText( answer);
			judge.setText( inpuText + " : " + answer );	
		}
	 
		@FXML
		protected void onGetButtonClick(ActionEvent evt) { // Clear �{�^���N���b�N
			testTextField.setText(""); 
			creatQuestion();
		}
		
		protected void creatQuestion() {
			
			int ransu = rand.nextInt(lstCount);
			for(Map.Entry<String, String> entry : list.get(ransu).entrySet()) {
				testLabel.setText( entry.getKey() ); //�����̓e�L�X�g
				answer = entry.getValue();
			}
		}
	
	
}