import {useState} from 'react'
import KartaPrac from './components/KartaPrac'
import Formularz from './components/Formularz'
import './App.css'

function App() {
    const [dziennikZadan, ustawDziennikZadan] = useState([])
    const dodajZadanie = (zadanie) => {
        let zadania = [...dziennikZadan, zadanie]
        ustawDziennikZadan(zadania)
    }
    return (
        <section style={{padding:'15px',margin:'15px'}}>
            <Formularz dodajPrace={dodajZadanie}/>
            <KartaPrac dziennik={dziennikZadan}/>
        </section>
    )
}

export default App