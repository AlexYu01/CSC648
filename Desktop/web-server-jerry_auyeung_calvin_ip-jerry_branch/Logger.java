package webserver;
import webserver.Response;
import webserver.Request;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.nio.file.Path;
import java.nio.file.Paths;


public class Logger{
    private File file;
    private FileWriter fileWrite = null;
    
    public Logger(String fileName) throws IOException{
        Path path = Paths.get(fileName);
        String directory = path.getParent().toString();
        File fileDirectory = new File (directory);
        file = new File(filename);
        
        if (!fileDirectory.exists()){
            
            fileDirectory.mkdirs();
            
        }
        
        if (!file.exists()){
            
            file.createNewFile();
            
        }
        
        fileWrite (file.getAbsoluteFile(),true);
        
    }

    public void write(Request request, Response response) throws IOException{
        String path;
        if (response.code == 404){
            path = "Not Found";
        }
        else{
            path =response.resource.absolutePath();
        }
        
    }

}
