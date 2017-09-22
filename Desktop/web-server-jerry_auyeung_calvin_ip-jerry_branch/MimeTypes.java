import java.util.*;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.io.*;

public class MimeTypes{
    private Map<String, String> types = new HashMap<String, String>();
    private String fileName = null;
    
    public MimeTypes(String fileName) throws FileNotFoundException{	
        try {
        	for(String line: new ConfigurationReader(fileName)) {
        		if(!line.trim().startsWith("#")) {
        			String temp[] = line.split("\\s+");
        			ArrayList<String> tempList = new ArrayList<>(Arrays.asList(temp));
        			if(tempList.size() > 1) {
        				String value = tempList.get(0);
        				for(int i = 1; i < tempList.size(); ++i) {
        					String key = tempList.get(i);
        					types.put(key, value);
        				}
        			}
        			tempList.clear();
        		}
        	}
        } catch (FileNotFoundException e) {
        	System.err.println("File mime.types not found in /conf directory.");
        	System.exit(0);
        } catch (IOException e) {
        	
        }
    }
    

    public void load(){
        try {
			MimeTypes mimes = new MimeTypes("./conf/mime.types");
			System.out.println(mimes.types);
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}
    }
    
    public String lookup(String extension){
    	if(types.containsKey(extension)) {
    		return types.get(extension);
    	}
    	else {
    		return "text/text";
    	}
    }
    
    public static void main(String[] args) {
    	
    }
}

