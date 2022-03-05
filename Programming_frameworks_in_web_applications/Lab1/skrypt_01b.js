const express = require('express')
const app = express()
const port = process.env.PORT || 3000
app.get('/', function(req, res){
    res.send('Szkielet programistyczny Express!')
})
app.get('/about', function (req,res){
    res.send('Autor strony: Tomasz Oleszko')
})
app.get('/name/:imie&:imie2', function (request, response) {
    response.status(200)
    response.set('Content-Type', 'text/html')
    response.end('<html><body>' + '<h1>Cześć ' + request.params.imie + ' i ' + request.params.imie2 + '</h1>' + '</body></html>'
    )
})

app.listen(port, function () {
    console.log('Serwer jest uruchomiony, ' + ' otwórz przeglądarkę i wpisz adres http://localhost:%s',
        port)
})