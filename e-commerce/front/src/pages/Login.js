import React from 'react'

const Login = () => {
    return (<div className="container">
        <div className="mb-4">
            <h1>Connexion au service</h1>
        </div>
        <div>
            <label className="form-label">Email:</label>
            <input className="form-control" type="email" name="email" placeholder="Votre Email" />
        </div>
        <div className="mt-4">
            <label className="form-label">Mot de passe:</label>
            <input className="form-control" type="password" name="password" placeholder="Votre Mot de passe" />
        </div>
        <div className="mt-4 text-end">
            <input className="btn btn-primary" type="submit" name="send" value="Connexion" />
        </div>
    </div>)
}

export default Login
