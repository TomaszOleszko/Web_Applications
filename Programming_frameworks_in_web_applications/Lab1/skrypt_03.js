const http = require('http')
const url = require('url')
http.createServer(function (req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'})
    let q = url.parse(req.url, true).query
    let p = 0.5 * (q.a + q.b + q.c);
    let P = Math.sqrt(p*(p-q.a)*(p-q.b)*(p-q.c));

    let txt = "Boki = "+q.a +" "+q.b+" "+q.c+"\nPole = " + P;
    res.end(txt)
}).listen(3000)
