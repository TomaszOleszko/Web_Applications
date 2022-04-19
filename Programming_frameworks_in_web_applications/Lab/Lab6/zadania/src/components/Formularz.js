import {useState} from 'react'

function Formularz({dodajPrace}) {
    const [opis, ustawOpis] = useState("")
    const [nazwa, ustawNazwe] = useState("")
    const [data, ustawDate] = useState("")
    const [priorytet, ustawPriorytet] = useState("NIE")
    const handleSubmit = (e) => {
        e.preventDefault()
        dodajPrace([opis, nazwa, data, priorytet])
    }
    return (
        <form style={{
            float: "left",
            border: "3px solid rgb(0,0,0)",
            width: "fit-content",
            whiteSpace: "nowrap",
            padding: "auto",
            margin: "auto",
            clear: "both"
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
            <input name='priorytet' type='checkbox' value={priorytet}
                   onChange={e => {
                       let str = e.target.checked ? 'TAK' : 'NIE'
                       ustawPriorytet(str)
                   }}/> <br/>
            <input type='submit' value='Dodaj zadanie'/>
        </form>
    )
}

export default Formularz