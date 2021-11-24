const { Sequelize } = require('sequelize');

const sequelize = new Sequelize('mysql://root:root@localhost:3306/e-commerce');

try {
    sequelize.authenticate();
    console.log('Connection has been established successfully.');
} catch (error) {
    console.error('Unable to connect to the database:', error);
}

module.exports = sequelize;