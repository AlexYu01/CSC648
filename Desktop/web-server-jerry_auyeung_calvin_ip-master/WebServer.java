package webserver;
import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import webserver.HttpdConf;
import webserver.MimeTypes;


public class WebServer {
    
    private HttpdConf configuration;
    private MimeTypes mimeTypes;
    private ServerSocket socket;
    public static String SERVER_ROOT = null;
    public static String DOCUMENT_ROOT = null;
    public static int DEFAULT_PORT = 8080;
    public static String LOG_FILE = null;
    //private Dictionary accessFiles;
    
    public WebServer() throws IOException{
        configuration = new HttpdConf( "./httpd.conf");
        mimeTypes = new MimeTypes ("./mime.types");
        socket = new ServerSocket (configuration.GetPort());
        
    }

    public static void main(String[] args) throws IOException {
		/*if (args.length != 1) {
			System.err.println("Usage: java WebServer <port number>");
			System.exit(1);
		}*/
        Webserver server = new WebServer();
        server.Start(server);
		
		
	}
    
    public void start(WebServer server){
        while(true){
            try{
                final Socket socket = server.socket.accept();
                new Thread((Runnable) new Worker(connection,config,mimes)).start();
            } catch (IOException e){
                System.out.println("Server Error");
                System.exit(1);
                
              }
        }
        
    }
}
