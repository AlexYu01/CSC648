import java.io.FileNotFoundException;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

public class HttpdConf {
	
	private Map<String, String> aliases = new HashMap<String, String>();
	private Map<String, String> scriptAliases = new HashMap<String, String>();
	
	public HttpdConf(String fileName) throws IOException {
		String[] content = fileName.split("\\r?\\n");
		for(int index = 0; index < content.length; index++) {
			
			String[] parts = content[index].split("\\s+", 2);
			String key = parts[0];
			parts[1] = parts[1].replaceAll("\"", "");
			String value = parts[1];
			
			switch(key) {
			
			case "ServerRoot":
				WebServer.SERVER_ROOT = value;
				break;
				
			case "DocumentRoot":
				value = value.substring(0, value.length() - 1);
				WebServer.DOCUMENT_ROOT = value;
				break;
				
			case "Listen":
				WebServer.DEFAULT_PORT = Integer.parseInt(value);
				break;
			
			case "LogFile":
				WebServer.LOG_FILE = value;
				break;
				
			case "ScriptAlias":
				String[] scriptA = value.split("\\s+");
				scriptAliases.put(scriptA[0], scriptA[1]);
				
				for(HashMap.Entry<String, String> entry1 : scriptAliases.entrySet()) {
					String scriptAliasKey = entry1.getKey();
					String scriptAliasValue = entry1.getValue();
				}
				break;
				
			case "Alias":
				String[] aliasParts = value.split("\\s+");
				aliases.put(aliasParts[0], aliasParts[1]);
				
				for(HashMap.Entry<String, String> entry2 : aliases.entrySet()) {
					String aliasKey = entry2.getKey();
					String aliasValue = entry2.getValue();
				}
				break;
				
			default:
				System.out.println("Invalid file");
			}
		}
	}
	
	public void load() {
		try {
			HttpdConf conf = new HttpdConf("./conf/httpd.conf");
			System.out.println(conf.aliases);
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}
}
