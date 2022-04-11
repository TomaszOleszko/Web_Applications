const express = require('express')
const app = express()
const PORT = process.env.PORT || 3000

const metoda = require('./middleware/metoda')
app.use('/', require('./api/routes'))

app.listen(PORT, () => console.log(`Server działa na porcie: ${PORT}`))