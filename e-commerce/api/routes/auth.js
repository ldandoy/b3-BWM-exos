let express = require('express');
let router = express.Router();

let userModel = require('../models/user');

router.post('/register', async (req, res) => {
    try {
        const {firstname, lastname, email, password} = req.body;
        
        const user = await userModel.create({
            firstname,
            lastname,
            email,
            password,
            admin: 0
        });

        console.log(user);
        
        return res.status(200).json({"msg": "ok"});
    }
    catch (error) {
        console.log(error);
        return res.status(500).json(error);
    }
});

module.exports = router;