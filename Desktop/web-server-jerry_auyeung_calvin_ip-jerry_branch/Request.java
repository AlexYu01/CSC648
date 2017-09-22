package webserver;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.Socket;
import java.util.Dictionary;
import java.util.stream.Stream;
import java.util.Dictionary;

public class Request {
	
    private String uri;
	private String verb;
	private String[] body;
	private String httpVersion;
	private Dictionary<String, String> headers;
	
    public Request(String test){
        
    }

	public Request(String httpString,Socket client) throws IOException {
        InputStream input = client.getInputStream();
        BufferedReader read = new BufferedReader(new InputStreamReader(input));
        httpString = read.readLine();
    }
	
	
	public void parse() {
		
	}
	
	// Accessors
	
	private String getVerb() {
		return verb;
	}
	
	private String getUri() {
		return uri;
	}
	
	private String getHttpVersion() {
		return httpVersion;
	}
	
	private String[] getBody() {
		return body;
	}
    private Dictionary getHeaders(){
        return headers;
    }
}
