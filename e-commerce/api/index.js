const express = require('express');
const morgan = require('morgan');
const cors = require('cors');
const bodyParser = require('body-parser');

const routesAuth = require('./routes/auth');
const routesProducts = require('./routes/products');
const routesProductCategory = require('./routes/productCaterogy');

const app = express();

const port = 5000;

app.use(cors());
app.use(bodyParser());
app.use(morgan('dev'));
app.use(express.static('public'))
app.use('/api/product-category', routesProductCategory);
app.use('/api/products', routesProducts);
app.use('/api', routesAuth);

app.get('/', (req, res) => {
    res.status(200).send('Hello World');
});

app.listen(port, () => {
    console.log('Server listen on http://localhost:5000');
});