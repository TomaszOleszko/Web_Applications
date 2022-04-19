function KartaPrac(props) {
    return (
        <table style={{clear: "both"}}>
            <thead>
            <tr>
                <th>Opis zadania</th>
                <th>Nazwa</th>
                <th>Data</th>
                <th>Priorytet</th>
            </tr>
            </thead>
            <tbody>
            {props.dziennik.map((v, i) => {
                return <tr key={i}>
                    <th>{v[0]}</th>
                    <th>{v[1]}</th>
                    <th>{v[2]}</th>
                    <th>{v[3]}</th>
                </tr>
            })}
            </tbody>
        </table>
    )
}

export default KartaPrac
