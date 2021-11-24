let express = require('express');
let router = express.Router();

const productCategory = require('../models/productCategory');
const productModel = require('../models/product');

router.get('/', async (req, res) => {
    let categories = await productCategory.findAll();
    res.status(200).json(categories);
});

router.get('/:categoryProductId/products', async (req, res) => {
    let { categoryProductId } = req.params;

    let products = await productModel.findAll({
        where: { 
            product_category_id: categoryProductId
        },
    });
    res.status(200).json(products);
});

module.exports = router;