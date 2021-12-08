import React from 'react';
import { useParams } from 'react-router';
import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom'

import { getProductsByCategoryId } from '../services/products'

const Category = () => {
    const {categoryId} = useParams();
    const [products, setProducts] = useState([])

    useEffect(() => {
        const fetchData = async () => {
            const products = await getProductsByCategoryId(categoryId);
            setProducts(products);
            return true;
        };

        fetchData();
    }, [categoryId]);

    return (
        <div className="container">
            <h1>Liste des {categoryId}</h1>

            <div className="row row-cols-1 row-cols-md-3 g-4">
                { products.map((product) => <div className="col" key={product.id}>
                    <div className="card">
                        <img src={`${process.env.REACT_APP_API_URL}/images/${product.picture}`} class="card-img-top" alt={product.name} />
                        <div className="card-body">
                            <h5 className="card-title">
                                <Link to={`/product/${product.id}`}>{product.name}</Link>
                            </h5>
                        </div>
                        <div className="card-footer">
                            <small className="text-muted">{product.price} €</small>
                        </div>
                    </div>
                </div>) }
            </div>
        </div>
    )
}

export default Category
