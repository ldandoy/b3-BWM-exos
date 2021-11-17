let express = require('express');
let router = express.Router();

const productModel = require('../models/product');

router.get('/:productId', async (req, res) => {
    let { productId } = req.params;

    let product = await productModel.findByPk(productId);

    res.status(200).json(product);
});

module.exports = router;