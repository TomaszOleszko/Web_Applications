const express = require('express')
const users = require('./users')
const app = express()
const PORT = process.env.PORT || 3000
const uuid= require('uuid');

app.get('/api/users', (req,res) => {
    res.json(users)
})
app.get('/api/users/:id', (req, res) => {
    const found = users.some(user => user.id === parseInt(req.params.id))
    if(found){
        res.json(users.filter(user => user.id === parseInt(req.params.id)))
    } else {
        res.status(400).json({msg: `Użytkownik o id ${req.params.id} został odnaleziony`})}

})

app.post('/', (req, res) => {
    app.use(express.json())
    const newUser = {
        id: uuid.v4(),
        name: req.body.name,
        email: req.body.email,
        status: "aktywny"
    }
    if(!newUser.name || !newUser.email){
        return res.status(400).json({msg: 'Wprowadź poprawne imię i nazwisko oraz email!'})
    }
    users.push(newUser)
    res.json(users)
})
app.listen(PORT, () => console.log(`Server działa na porcie: ${PORT}`))