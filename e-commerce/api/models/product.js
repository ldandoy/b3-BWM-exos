const { Sequelize, DataTypes, Model } = require('sequelize');
const sequelize = new Sequelize('mysql://root:root@localhost:3306/e-commerce');

class product extends Model {};

product.init({
    price: {
        type: DataTypes.DECIMAL,
        allowNull: false
    },
    name: {
        type: DataTypes.STRING,
        allowNull: false
    },
    description: {
        type: DataTypes.TEXT,
        allowNull: true
    },
    picture: {
        type: DataTypes.TEXT,
        allowNull: true
    },
    product_category_id: {
        type: DataTypes.INTEGER,
        allowNull: false
    }
}, {
    sequelize,
    timestamps: true,
    underscored: true,
    tableName: 'product',
    modelName: 'product'
});

module.exports = product;