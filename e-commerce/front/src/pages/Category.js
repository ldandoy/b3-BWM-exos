import React from 'react';
import { useParams } from 'react-router';
import { useEffect, useState } from 'react';

import { getProductsByCategoryName } from '../services/products'

const Category = () => {
    const {categoryName} = useParams();
    const [products, setProducts] = useState([])

    const fetchData = async () => {
        const products = await getProductsByCategoryName(categoryName);
        setProducts(products);
    }

    useEffect(() => {
        fetchData()
    
    }, [categoryName]);

    return (
        <div>
            <h1>Liste des {categoryName}</h1>

            { products.map((product) =>
                <p>{product.title}</p>
            ) }
        </div>
    )
}

export default Category
