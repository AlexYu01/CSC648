package webserver;
import java.net.Socket;
import java.io.IOException;
import java.util.logging.Level;
import webserver.Logger;
import webserver.response.ResponseFactory;
import webserver.Resource;
import webserver.Request;
import webserver.MimeTypes;
import webserver.HttpdConf;
import webserver.Response;



public class Worker implements Runnable{
    private Socket client;
    private MimeTypes mimes;
    private HttpdConf config;
    


    public Worker(Socket socket, HttpdConf config, MimeTypes mimes){
        this.client = socket;
        this.config = config;
        this.mimes = mimes;
    }

    
    public void run(){
        try{
            Request request = new Request(client);
            Resource resource = new Resource(request.getUri(),config,mimes);
            ResponseFactory responseFactory = new ResponseFactory();
                if (request.getVerb() !=null){
                    Response response = responseFactory.getResponse(request,resource);
                    response.Send(client.getOutputStream());
                    client.close();
                
                }
            
            
        }catch (IOException e){
            System.out.println("Worker error)");
        }
        
    
    }
    
    
    
}
