import React, {useEffect, useState, useContext} from 'react'
import { useParams } from 'react-router'

import { MyContext } from '../context/MyContext'
import {getProduct} from '../services/products'

const Product = () => {
    const {productId} = useParams()
    const [isloaded, setIsLoaded] = useState(false)
    const [product, setProduct] = useState({})
    const [qty, setQty] = useState(1)
    const {test, setTest} = useContext(MyContext);

    useEffect(() => {
        const fetchData = async () => {
            const product = await getProduct(productId)
            setProduct(product)
            setIsLoaded(true)

            // setTest({...productId, test:'tutu'});
            return true
        };

        fetchData();
    }, [productId])

    const handlerOnChange = (e) => {
        setQty(e.target.value)
    }

    const handlerOnSubmit = (e) => {
        e.preventDefault()
        console.log(qty, product)
    }

    return ( <div className="container">
        { !isloaded && <>Chargement ...</>}

        <>context: {test.test}</>

        { isloaded && <div className="row">
            <div className="col">
                <img className="img-fluid" src={`${process.env.REACT_APP_API_URL}${product.picture}`} alt={product.name} />
            </div>
            <div className="col">
                <h1 className="titleProduct">{product.name}</h1>
                <div className="description">{product.description}</div>
                <div className="price">{product.price} €</div>
                
                <form onSubmit={handlerOnSubmit} className="row">
                    <div className="col">
                        <input onChange={handlerOnChange} type="number" className="form-control" name="qte" value={qty} />
                    </div>
                    <div className="col">
                        <button type='submit' className="btn btn-success" name="send" value="Ajoter au panier"><i className="fas fa-cart-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>}
    </div>)
}

export default Product
