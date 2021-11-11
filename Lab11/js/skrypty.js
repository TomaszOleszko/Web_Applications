//Fetch API
document.addEventListener('DOMContentLoaded', () => {
    var bonas = document.getElementById('onas');
    bonas.addEventListener("click", () => {
        console.log("Strona O nas");
        pokazSkrypt("onas.php");
    });
    var bgaleria = document.getElementById('galeria');
    bgaleria.addEventListener("click", () => {
        console.log("Galeria zdjęć");
        pokazSkrypt("galeria.php");
    });
    var bglowna = document.getElementById('index');
    bglowna.addEventListener('click', ()=>{
        console.log("Glowna");
        pokazSkrypt("glowna.php");
    });
    var bformularz = document.getElementById('formularz');
    bglowna.addEventListener('click', ()=>{
        console.log("Formularz");
        pokazSkrypt("formularz.php");
    });
});

function pokazSkrypt(plik){
    fetch("http://localhost/Lab11/skrypty/"+plik)
        .then((response) => {
            if (response.status !== 200) {
                return Promise.reject('Coś poszło nie tak!');
            }
            return response.text();
        })
        .then((data) => {
            document.getElementById('main').innerHTML=data;
        })
        .catch((error) => {
            console.log(error);
        });
}
