package getInfo;

import java.io.FileWriter;
import java.io.IOException;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class Scraping {

	public static void main(String[] args) throws IOException {
		// TODO Auto-generated method stub
	//	String url = "https://ultimai.org/mdlsrc/mnglb/03_customaize.php";
		String html = "";
		
		for(String url : args) {
			//日本語のコメントは
		  Document document = Jsoup.connect( url ).get();
	    Elements courses = document.select("h2");
	    
	    for (Element course : courses) {
	        System.out.println(course.text()+"\n");
	        html += course.text()+"\n";
	    }
	    try {
	      FileWriter fw = new FileWriter("test.txt",true);
	      fw.write(html);
	      fw.close();
			  } catch (IOException ex) {
			      ex.printStackTrace();
			  }
    
		}
	}

}
