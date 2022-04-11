module.exports = {
     metoda: function (req, res, next) {
        console.log("Metoda: ", req.method)
        let sciezka = "Ścieżka: "+ req.protocol + "://" + req.get('host') + req.originalUrl
        console.log(sciezka)
         res.send("<h1>a</h1>")
        next()
    }
};
