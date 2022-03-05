const express = require('express')
const http = require('http')
const path = require('path')
const app = express()
app.use(express.urlencoded({
    extended:true
}))
app.get("/", (req, res) => {
    res.send("Żądanie GET")
})
app.get("/form", (req, res) => {
    res.sendFile(path.join(__dirname, "public/form.html"))
})
app.post("/form", (req, res) => {
    let username = req.body.username
    let password = req.body.password
    if (username === "" || password === ""){
        res.send("Uzupenij dane!")
    }else{
        res.send("Użytkownik: " + username + "<br>Hasło: " + password)
    }
})

app.get("/form2", (req, res) => {
    res.sendFile(path.join(__dirname, "public/form2.html"))
})
app.post("/form2", (req, res) => {
    let imie = req.body.name
    let nazw = req.body.surname
    let jezyk = req.body.jezyk
    if (imie === "" || nazw === "" || jezyk === ""){
        res.send("Uzupenij dane!")
    }else{
        let str = "<ul>"
       for (let j in jezyk){
            str += "<li>"+jezyk[j]+"</li>"
        }
       str += "</ul>"
        res.send("Użytkownik: " + imie + ' ' +nazw + '<br\>Jezyki: ' + str)
    }
})



app.listen(3000)