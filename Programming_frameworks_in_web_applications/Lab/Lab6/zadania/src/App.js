import {useState} from 'react'
import KartaPrac from './components/KartaPrac'
import Formularz from './components/Formularz'

function App() {
    const [dziennikZadan, ustawDziennikZadan] = useState([])
    const dodajPrace = (zadanie) => {
        let zadania = [...dziennikZadan, zadanie]
        ustawDziennikZadan(zadania)
    }
    return (
        <section style={{padding:"20px", margin:"10px"}}>
            <Formularz dodajPrace={dodajPrace}/>
            <KartaPrac dziennik={dziennikZadan}/>
        </section>
    )
}

export default App;
