const express = require('express')
const router = express.Router()
const users = require('../users')
const uuid = require("uuid");
const middlewares = require("../middleware/metoda")

router.use('/metoda', middlewares.metoda)

router.get('/api/users',(req,res) => {
     res.json(users)
})
router.get('/api/users/:id', (req, res) => {
    const found = users.some(user => user.id === parseInt(req.params.id))
    if(found){
        res.json(users.filter(user => user.id === parseInt(req.params.id)))
    } else {
        res.status(400).json({msg: `Użytkownik o id ${req.params.id} nie istnieje`})}

})
router.use(express.json())
router.post('/', (req, res) => {
    //console.log(JSON.stringify(req.body))
    const newUser = {
        id: uuid.v4(),
        name: req.body.name,
        email: req.body.email,
        status: "aktywny"
    }
    if(!newUser.name || !newUser.email){
        res.status(400).json({msg: 'Wprowadź poprawne imię i nazwisko oraz email!'})
    }
    users.push(newUser)
    res.json(users)
})
router.put('/api/users/:id', (req, res) => {
    const found = users.some(user => user.id ===
        parseInt(req.params.id))
    if(found){
        const updUser = req.body
        users.forEach(user => {
            if(user.id === parseInt(req.params.id)) {
                user.name = updUser.name ? updUser.name : user.name
                user.email = updUser.email ? updUser.email : user.email
                res.json({msg: 'Dane użytkownika zaktualizowane', user})
            }
        })
    } else {
        res.status(400).json({msg: `Użytkownik o id ${req.params.id} nie istnieje!`})
    }
})
router.delete('/api/users/:id', (req, res) => {
    const found = users.some(user => user.id === parseInt(req.params.id))
    if(found){
        const index = users.findIndex((user, index) => user.id == req.params.id)
        users.splice(index, 1)
        res.json({msg: `Uzytkownik o id ${req.params.id} zostal usuniety`})
    } else {
        res.status(400).json({msg: `Użytkownik o id ${req.params.id} nie istnieje!`})
    }
})

module.exports = router