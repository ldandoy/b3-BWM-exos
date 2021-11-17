import axios from 'axios'

export const getProductsByCategoryName = async (categoryName) => {
    console.log(categoryName);

    const res = await axios.get('https://jsonplaceholder.typicode.com/posts');

    return res.data;
};