public class Response{
    public int code = 0;
    public String reasonPhrase;
    public Resource resource;

    public Response(Resource resource){
        this.resource = resource;
        
    }
    
    public void Send() throws FileNotFoundException,IOException{
        
        
    }



}
