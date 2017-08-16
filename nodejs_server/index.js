/*var http = require('http')

http.createServer(function (req,res){
    res.writeHead(200, {'Content-Type': 'text/plain'});
    res.end('Hello World!');
}).listen(3000)
*/
var app = require("express")();
var fs =    require('fs');
var port = 8443;
var options = {
    key:    fs.readFileSync('/etc/letsencrypt/live/www.sfsu648.me/privkey.pem'),
    cert:   fs.readFileSync('/etc/letsencrypt/live/www.sfsu648.me/cert.pem')
};
var https = require('https').Server(options,app);
var io = require('socket.io')(https);
var bodyParser = require('body-parser');



app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.get("/", function(req, res){
        res.send(__dirname + '/test.html');
});
/*
app.post("/",function(req,res){
    res.sendFile(__dirname + '/test.html');
})
*/
io.on('connection',function(socket){
    var id = socket.handshake.query.id
    console.log('user '+ id +' connected');
    socket.on('disconnect',function(){
        console.log('user '+ id + ' disconnected');
    })
    socket.on('messages',function(msg){
      console.log( msg.id + ' message: ' + msg.content)
      io.emit('messages',{id:msg.id,content:msg.content});
    })
})

https.listen(port,function(){
    console.log("Listening on port: " + port);
})
