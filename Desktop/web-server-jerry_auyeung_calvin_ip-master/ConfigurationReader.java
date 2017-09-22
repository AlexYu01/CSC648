import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;

public class ConfigurationReader {
	private BufferedReader file;
	private String line = null;
	
	public ConfigurationReader(String fileName) throws FileNotFoundException{
		file = new BufferedReader(new FileReader(fileName));
	}
	
	public boolean hasMoreLines(){
		try {
			line = file.readLine();
			if (line != null) {
				return true;
			}
			else {
				file.close();
				return false;
			}
		} catch (IOException e) {
			throw new RuntimeException(e);
		}
	}
	
	public String nextLine() throws IOException{
		line = file.readLine();
		if(line.trim().startsWith("#")) {
			return " ";
		}
		return line;
	}
	
	public void load(){
		try {
			ConfigurationReader configurationReader = new ConfigurationReader("./conf");
			System.out.println(configurationReader.file);
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}
	}
}


