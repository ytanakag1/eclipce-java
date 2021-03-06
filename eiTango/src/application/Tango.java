package application;

import java.util.List;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;



public class Tango {

	
	public List<Map<String, String>> tango() throws IOException {
		
		String url = "https://ultimai.org/mdlsrc/fiddle/eitango_h1nam4.txt";
		String tango =	readToString(url);
		
		
   	ArrayList<Map<String, String>> list = new ArrayList<>();  //Listを作成する

    list.forEach(System.out::println);
    
		// カンマ区切り文字列を配列にする
		 String[] strArray = tango.split(",");
     for(String line : strArray) {
    	 Map<String, String> map = new HashMap<>();
    	 String[] mapArray = line.split(":");
    	 
    	 		map.put(mapArray[0],mapArray[1]);
    	 		list.add(map);
     }
     
      
   //   Stream<Map<String, String>> stream = list.stream();
    
     // System.out.println(list.get(0).keySet()); //値だけ出す
      //stream.forEach(System.out::println); //全部出す
      //mapStream.forEach( e->System.out.println(e.getKey() + " : " + e.getValue()) );
     
     
     return list;
	}
	
    
		
		
		
	
	
	
	public static String readToString(String targetURL) throws IOException {
			URL url = new URL(targetURL); 
			BufferedReader bufferedReader = new BufferedReader( new InputStreamReader(url.openStream(), StandardCharsets.UTF_8));
			StringBuilder stringBuilder = new StringBuilder(); 
			String inputLine; 
			while ((inputLine = bufferedReader.readLine()) != null) {
				stringBuilder.append(inputLine); 
				stringBuilder.append(System.lineSeparator()); 
				} 
			bufferedReader.close(); 
			return stringBuilder.toString().trim(); 
	} 





}
