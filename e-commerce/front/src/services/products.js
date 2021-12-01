import axios from 'axios'

export const getProductsByCategoryId = async (categoryId) => {
    const res = await axios.get(`http://localhost:5000/api/product-category/${categoryId}/products`);
    return res.data;
};

export const getProduct = async (productId) => {
    const res = await axios.get(`http://localhost:5000/api/products/${productId}`);
    return res.data;
}