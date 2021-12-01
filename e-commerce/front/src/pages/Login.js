import React, { useState } from 'react'
import { login } from '../services/auth'
import { useNavigate } from 'react-router-dom'

const Login = () => {
    let navigate = useNavigate();

    const [user, setUser] = useState({
        'email'         : '',
        'password'      : ''
    })
    const [messages, setMessages] = useState([])

    const onSubmitHandler = async (event) => {
        event.preventDefault();

        if (user.password !== "" && user.email !== "") {
            try {
                await login(user)

                /*setMessages([...messages, {
                    type: "success",
                    msg: 'Vous êtes connecté !'
                }])*/

                navigate("/");
            } catch (error) {
                if (error.response) {
                    setMessages([...messages, {
                        type: "danger",
                        msg: error.response.data
                    }])
                } else {
                    setMessages([...messages, {
                        type: "danger",
                        msg: 'Erreur: ' + error.message
                    }])
                }
            }
        } else {
            setMessages([...messages, {
                type: "danger",
                msg: 'Vous devez remplir tous les champs obligatoires'
            }])
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
            <div className="mb-4">
                {messages.map((message, index) => <div key={`alert-${index}`} className={`alert alert-${message.type}`} role="alert">
                    {message.msg}
                </div>)}
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
