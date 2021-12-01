let express = require('express');
const bcrypt = require('bcrypt');
let router = express.Router();

let userModel = require('../models/user');

router.post('/register', async (req, res) => {
    try {
        const {firstname, lastname, email, password} = req.body;

        if (
            email === "" || typeof email === 'undefined' ||
            firstname === "" || typeof firstname === 'undefined' ||
            lastname === "" || typeof lastname === 'undefined' ||
            password === "" || typeof password === 'undefined'
        ) {
            let error = 'Les champs obligatoires n\'ont pas été renseignés !';
            console.log(error);
            return res.status(500).json(error);
        }

        // TODO: Vérif longueur mot de passe !!

        // TODO: Vérif si le user existe déjà !!
        
        const hash = bcrypt.hashSync(password, 10);

        const user = await userModel.create({
            firstname,
            lastname,
            email,
            password: hash,
            admin: 0
        });
        user.password = null
        
        return res.status(200).json(user);
    }
    catch (error) {
        console.log(error);
        return res.status(500).json(error);
    }
});

router.post('/login', async (req, res) => {
    try {
        const {email, password} = req.body;
        
        if (typeof email === 'undefined' || email === "" || typeof password === 'undefined' || password === "") {
            let error = 'Les champs obligatoires n\'ont pas été renseignés !';
            console.log(error);
            return res.status(503).json(error);
        }

        const user = await userModel.findOne({
            where: { 
                email: email
            }
        });

        if (user) {
            if (!bcrypt.compareSync(password, user.password)) {
                let error = 'Erreur lors de l\'authentification !';
                console.log(error);
                return res.status(503).json(error);
            } else {
                user.password = null;
                return res.status(200).json(user);
            }
        } else {
            let error = 'Erreur lors de l\'authentification !';
            console.log(error);
            return res.status(503).json(error);
        }
    }
    catch (error) {
        console.log(error);
        return res.status(500).json(error);
    }
});

module.exports = router;