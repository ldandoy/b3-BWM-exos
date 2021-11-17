const express = require('express');
const morgan = require('morgan');
const { Sequelize } = require('sequelize');

const sequelize = new Sequelize('mysql://root:root@localhost:3306/e-commerce');

try {
    sequelize.authenticate();
    console.log('Connection has been established successfully.');
} catch (error) {
    console.error('Unable to connect to the database:', error);
}

const routesProducts = require('./routes/products');
const routesProductCategory = require('./routes/productCaterogy');

const app = express();

const port = 5000;

app.use(morgan());
app.use('/api/product-category', routesProductCategory);
app.use('/api/products', routesProducts);

app.get('/', (req, res) => {
    res.status(200).send('Hello World');
});

app.listen(port, () => {
    console.log('Server listen on http://localhost:5000');
});