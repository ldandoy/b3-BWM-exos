const { Sequelize, DataTypes, Model } = require('sequelize');
const sequelize = new Sequelize('mysql://root:root@localhost:3306/e-commerce');

class productCategory extends Model {}

productCategory.init({
    name: {
        type: DataTypes.STRING,
        allowNull: false
    },
    /*cat_id: {
        type: DataTypes.INTEGER,
        primaryKey: true
    }*/
}, {
    sequelize,
    timestamps: true,
    underscored: true,
    tableName: 'product_category',
    modelName: 'productCategory'
})

module.exports = productCategory;