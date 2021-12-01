import React, { useState } from 'react'

import { register } from '../services/auth'

const Register = () => {
    const [user, setUser] = useState({
        'email'         : '',
        'cf_email'      : '',
        'password'      : '',
        'cf_password'   : ''
    })

    const onSubmitHandler = async (event) => {
        event.preventDefault();

        if ( user.email === user.cf_email && 
            user.password === user.cf_password &&
            user.password.length >= 3 &&
            user.email !== ""
        ) {
            const res = await register(user)
            console.log(res)
        } else {
            console.log('erreur sending ...')
        }
    }

    const onChangeHandler = (event) => {
        const {name, value} = event.target
        setUser({...user, [name]: value}) 
    }

    return (
        <div className="container">
            <form onSubmit={onSubmitHandler}>
                <div className="mb-4">
                    <h1>Créez votre compte </h1>
                </div>

                <div>
                    <label className="form-label">Email:</label>
                    <input onChange={onChangeHandler} className="form-control" value={user.email} type="email" name="email" placeholder="Entrer votre email" />
                </div>

                <div className="mt-4">
                    <label className="form-label">Confirme Email:</label>
                    <input onChange={onChangeHandler} className="form-control" type="email" name="cf_email" placeholder="Confirmer votre email" />
                </div>

                <div className="mt-4">
                    <label className="form-label">Mot de passe:</label>
                    <input onChange={onChangeHandler} className="form-control" type="password" name="password" placeholder="Votre mot de passe" />
                </div>

                <div className="mt-4">
                    <label className="form-label">Confirmer votre mot de passe:</label>
                    <input onChange={onChangeHandler} className="form-control" type="password" name="cf_password" placeholder="Confirmer votre mot de passe" />
                </div>

                <div className="mt-4">
                    <label className="form-label">Prénom:</label>
                    <input onChange={onChangeHandler} className="form-control" type="text" name="firstname" placeholder="Entrer votre prénom" />
                </div>

                <div className="mt-4">
                    <label className="form-label">Nom:</label>
                    <input onChange={onChangeHandler} className="form-control" type="text" name="lastname" placeholder="Entrer votre nom" />
                </div>

                <div className="mt-4 text-end">
                    <input className="btn btn-success" type="submit" name="send" value="Créer votre compte" />
                </div>
            </form>
        </div>
    )
}

export default Register
