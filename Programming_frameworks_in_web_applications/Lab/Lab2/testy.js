const dane = require('./dane')


function wyswietlLiczby(...arguments) {
    console.log('Suma liczb: ' + arguments + ' wynosi ' + arguments.reduce((total, num) => {
        return total + num;
    }, 0))
}

function wyswietlTekst(tablica) {
    tablica.forEach((item) => {
        console.log(item.tekst)
    })
}

function utworzTablice_map(tablica) {
    console.log(tablica.map((item) => {
        return item.tekst;
    }))
}

function utworzTablice_filter(tablica) {
    console.log(tablica.filter((item) => {
        return item.zrealizowano === true
    }).map((item) => {
        return item.tekst;
    }))
}

/*
wyswietlLiczby(1, 2, 3, 4)
wyswietlTekst(dane.listaZadan)
utworzTablice_map(dane.listaZadan)
utworzTablice_filter(dane.listaZadan)
*/
function func2_3(...tablica) {
    const result = tablica
        .reduce((a, b) => [...a, ...b])
        .map((key) => {
            key.czas = key.czas / 60;
            return key
        })
        .filter(item => item.czas > 2)
        .map(item => {
            item.czas *= 35;
            return item
        })
        .reduce((total, item) => item.czas + total, 0)
        .toFixed(2)
        .toString() + ' PLN'

    console.log(result)
}

function func2_4(tablica) {
    const resultA = tablica.filter(item => item.kategoria === "IT")
    console.log(resultA)
    const resultB = tablica.filter(item => item.poczatek >= 1990 && item.poczatek <= 1999 && item.koniec >= 1990 && item.koniec <= 1999)
    console.log(resultB)
    const resultC = tablica.filter(item => item.koniec - item.poczatek > 10)
    console.log(resultC)
}

/*
func2_3(dane.poniedzialek, dane.wtorek)
func2_4(dane.firmy)
*/

const calc = (a, b, p) => {
    if (!(a || b || p)) {
        return "Podaj wszystkie argumenty!"
    }
    switch (p) {
        case '+': {
            return a + b
        }
        case '-': {
            return a - b
        }
        case '*': {
            return a * b
        }
        case '/': {
            return a / b
        }
        default: {
            return
        }
    }
}

module.exports.calc = calc