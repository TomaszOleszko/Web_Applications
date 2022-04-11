var {connect} = require('mongoose');
let dotenv = require('dotenv').config()

const uri = "mongodb+srv://TomaszOleszko:"+process.env.PASSWORD+"@cluster0.f7l41.mongodb.net/myFirstDatabase?retryWrites=true&w=majority";

module.exports = connect(
    uri,
    {
        useNewUrlParser: true
    },
    err => {
        if (!err) {
            console.log("Connection succeeded")
        } else {
            console.log("Error in connection: " + err)
        }
    }
)