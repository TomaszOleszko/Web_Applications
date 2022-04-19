import {useState} from 'react'

function Formularz({dodajZadanie}) {
    const [opis, ustawOpis] = useState()
    const [nazwa, ustawNazwe] = useState()
    const [data, ustawDate] = useState()
    const [priorytet, ustawPriorytet] = useState(0)
    const handleSubmit = (e) => {
        dodajZadanie([opis, nazwa, data, priorytet])
        e.preventDefault()
    }
    return (
        <form style={{
            float:"left",
            border: "3px solid rgb(0,0,0)",
            width: "fit-content",
            'white-space': "nowrap",
            padding: "auto",
            margin: "auto",
            clear:"both"
        }} onSubmit={e => {
            handleSubmit(e)
        }}>
            <label>Opis pracy:</label> <br/>
            <input name='opis' type='text' value={opis}
                   onChange={e => ustawOpis(e.target.value)}/> <br/>
            <label>Nazwa:</label> <br/>
            <input name='nazwa' type='text' value={nazwa}
                   onChange={e => ustawNazwe(e.target.value)}/> <br/>
            <label>Date:</label> <br/>
            <input name='data' type='date' value={data}
                   onChange={e => ustawDate(e.target.value)}/> <br/>
            <label>Priorytet:</label> <br/>
            <input type="checkbox" value={priorytet}
                   onChange={e => ustawPriorytet(e.target.value)}/> <br/>
            <input type='submit' value='Dodaj zadanie'/>
        </form>
    )
}

export default Formularz