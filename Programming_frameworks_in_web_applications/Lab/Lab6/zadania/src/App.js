import {useState} from 'react'
import KartaPrac from './components/KartaPrac'
import Formularz from './components/Formularz'

function App() {
    const [dziennikZadan, ustawDziennikZadan] = useState([])
    const dodajZadanie = (zadanie) => {
        let zadania = [...dziennikZadan, zadanie]
        ustawDziennikZadan(zadania)
    }
    return (
        <section>
            <Formularz dodajPrace={dodajZadanie}/>
            <KartaPrac dziennik={dziennikZadan}/>
        </section>
    )
}

export default App