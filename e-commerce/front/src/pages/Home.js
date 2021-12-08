import React, {useEffect, useState} from 'react'
import { Link } from 'react-router-dom'

import {getLastProducts} from '../services/products'

const Home = () => {
    const [products, setProducts] = useState([])

    useEffect(() => {
        const getData = async () => {
            const Lastproducts = await getLastProducts()
            setProducts(Lastproducts)
        }
        getData()
    }, [])

    return (
        <div className="container">
            <div className="row">
                <h1>Bienvenue sur la Boutique</h1>
            </div>
            <div className="row">
                {products.map(product => <div className="col">
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
                </div>)}
            </div>
        </div>
    )
}

export default Home
