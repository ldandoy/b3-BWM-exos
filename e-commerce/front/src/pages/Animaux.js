import { useState } from 'react';

const Animaux = () => {
    const [animaux, setAnimaux] = useState(['Lion', 'Tigre']);
    const [animal, setAnimal] = useState('');

    const HandlerOnChange = (event) => {
        setAnimal(event.target.value);
    }

    const HandlerOnClick = (event) => {
        setAnimaux([...animaux, animal]);
        setAnimal('');
    }

    return <>
        <h1>Liste des animaux</h1>
        <input
            type="text"
            value={animal}
            onChange={HandlerOnChange}
        />
        <button onClick={HandlerOnClick}>Ajouter</button>
        <ul>
            {animaux.map((animal, index) =>
                <li key={index}>{ animal }</li>
            )}
        </ul>
    </>
}

export default Animaux;