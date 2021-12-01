import React, {useEffect, useState} from 'react'
import { useParams } from 'react-router'

import {getProduct} from '../services/products'

const Product = () => {
    const {productId} = useParams()
    const [isloaded, setIsLoaded] = useState(false)
    const [product, setProduct] = useState({})

    useEffect(() => {
        const fetchData = async () => {
            const product = await getProduct(productId)
            setProduct(product)
            setIsLoaded(true)
            return true
        };

        fetchData();
    }, [productId])

    return ( <div className="container">
        { !isloaded && <>Chargement ...</>}

        { isloaded && <div>
            <div>{product.name}</div>
            <div>{product.price} €</div>
            <div>{product.description}</div>
        </div>}
    </div>)
}

export default Product
