let express = require('express');
let router = express.Router();

const productCategory = require('../models/productCategory');

router.get('/', async (req, res) => {
    let categories = await productCategory.findAll();
    res.status(200).json(categories);
});

module.exports = router;