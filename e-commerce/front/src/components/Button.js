import { useState } from 'react'

const Button = () => {
    const [ score, setScore ] = useState(0);
    const [ qty, setQty ] = useState(1);

    const handlerClick = (event) => {
        if (qty) {
            setScore(score + qty);
        }
    }

    const handlerOnChange = (event) => {
        if (event.target.value !== "") {
            let newQty = parseInt(event.target.value);
            setQty(newQty);
        } else {
            setQty(1);
        }
    }

    return <>
        <div>{ score }</div>
        <input 
            type="number" 
            onChange={handlerOnChange} 
            name="qty" 
            value={qty}
        />
        <button onClick={handlerClick}>Cliquez ici</button>
    </>
}

export default Button;
