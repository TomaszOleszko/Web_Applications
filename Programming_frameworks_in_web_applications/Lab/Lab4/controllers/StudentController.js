const express = require('express')
const { appendFile } = require('fs')
const router = express.Router()

const Student = require('../models/Student')
const db = require("../db")

router.get("/", (req, res) => {
    res.send(`
    <h3 style="text-align:center">Baza danych studentów</h3>
    <h4 style="text-align:center">Kliknij <a href="/list"> tutaj</a>, aby uzyskać dostęp do bazy.</h4>`)
})

router.get("/list", (req, res) => {
    Student.find((err, docs) => {
        if (!err) {
            res.render("list", {
                list: docs
            })
        } else {
            console.log("Błąd pobierania danych" + err)
        }
    })
})

router.get("/addOrEdit", (req, res) => {
    res.render("addOrEdit", {
        viewTitle: "Dodaj studenta"
    })
})

router.post("/", (req, res) => {
    if (req.body._id == "") {
        insert(req, res)
    } else {
        update(req, res)
    }
})

router.get("/:id", (req, res) => {
    Student.findById(req.params.id, (err, doc) => {
        if (!err) {
            res.render("addOrEdit", {
                viewTitle: "Zaktualizuj dane studenta",
                student: doc
            });
        }
    })
})

router.get("/delete/:id", (req, res) => {
    Student.findByIdAndRemove(req.params.id, (err, doc) => {
        if (!err) {
            res.redirect("/list")
        } else {
            console.log("Błąd podczas usuwania: " + err)
        }
    })
})


function insert(req, res) {
    var student = new Student()
    student.fullName = req.body.fullName
    student.email = req.body.email
    student.mobile = req.body.mobile
    student.city = req.body.city
    student.save((err, doc) => {
        if (!err) {
            res.redirect("/list")
        } else {
            console.log("Błąd podczas dodawania studenta: " + err)
        }
    })
}

function update(req, res) {
    Student.findOneAndUpdate(
        { _id: req.body._id },
        req.body,
        { new: true },
        (err, doc) => {
            if (!err) {
                res.redirect("list")
            } else {
                console.log("Błąd podczas aktualizowania danych: " + err)
            }
        }
    )
}

module.exports = router