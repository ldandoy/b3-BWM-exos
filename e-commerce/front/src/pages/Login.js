import React, { useState } from 'react'
import {login} from '../services/auth'

const Login = () => {
    const [user, setUser] = useState({
        'email'         : '',
        'password'      : ''
    })

    const onSubmitHandler = async (event) => {
        event.preventDefault();
        console.log(user)

        if (user.password !== "" && user.email !== "") {
            const res = await login(user)
            console.log(res)
        } else {
            console.log('erreur sending ...')
        }
    }

    const onChangeHandler = (event) => {
        const {name, value} = event.target
        setUser({...user, [name]: value}) 
    }

    return (<div className="container">
        <form onSubmit={onSubmitHandler}>
            <div className="mb-4">
                <h1>Connexion au service</h1>
            </div>
            <div>
                <label className="form-label">Email:</label>
                <input onChange={onChangeHandler} className="form-control" type="email" name="email" placeholder="Votre Email" />
            </div>
            <div className="mt-4">
                <label className="form-label">Mot de passe:</label>
                <input onChange={onChangeHandler} className="form-control" type="password" name="password" placeholder="Votre Mot de passe" />
            </div>
            <div className="mt-4 text-end">
                <input className="btn btn-success" type="submit" name="send" value="Connexion" />
            </div>
        </form>
    </div>)
}

export default Login
