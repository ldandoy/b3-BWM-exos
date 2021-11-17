let express = require('express');
let router = express.Router();

router.get('/', (req, res) => {
    res.status(200).json({"msg": "Liste des produits"});
});

router.get('/:productId', (req, res) => {
    let { productId } = req.params;

    res.status(200).json({"msg": "Juste un produit " + productId});
})

module.exports = router;