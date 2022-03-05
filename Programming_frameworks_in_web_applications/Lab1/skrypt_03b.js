const express = require('express')
const http = require('http')
const path = require('path')
const { check, validationResult } = require('express-validator')
const app = express()
app.use(express.urlencoded({
    extended: true
}))

app.get("/form3", (req, res) => {
    res.sendFile(path.join(__dirname, "public/form3.html"))
})

app.post("/form3", [
    check('nazwisko').isLength({ min: 3, max: 25 }).matches(/^[A-Za-z ]+$/).withMessage("Zle imie").trim().stripLow(),
    check('email').isEmail().bail().withMessage("zly email").normalizeEmail(),
    check('wiek').isNumeric().isFloat({min: 0, max: 110}).withMessage("zly wiek")], (req, res) => {
    const errors = validationResult(req)
    if (!errors.isEmpty()) {
        return res.status(422).json({errors: errors.array()})
    }
    const nazwisko = req.body.nazwisko.split(" ").map((n)=>n[0]).join(".");
    const email = req.body.email
    const wiek = req.body.wiek
    res.send("Użytkownik: " + nazwisko + "<br>Email: " + email + "<br>Wiek:" + wiek)
})

app.listen(3000)