const express = require('express')
const path = require('path')
const app = express()
const hbs = require('hbs')
const Console = require("console");
app.use(express.urlencoded({
    extended: true
}))

app.set('view engine', 'hbs')
app.set('views', path.join(__dirname, 'views'))
app.get('/about', (req, res) => {
    res.render('about', {name: 'Jan'})
})
app.get('/form',(req, res) => {
    res.sendFile(path.join(__dirname, "public/form3.html"))
})
app.post('/form3', (req, res) =>{
    const nazwisko = req.body.nazwisko.split(" ").map((n)=>n[0]).join(".");
    const email = req.body.email
    const wiek = req.body.wiek
     res.render('info',{lastname: nazwisko, email: email, wiek: wiek})
})
app.listen(3000, () => console.log('Serwer działa!'))