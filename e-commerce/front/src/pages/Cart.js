import React, {useEffect, useState, useContext} from 'react'
import {Link} from 'react-router-dom'

import { CartContext } from '../context/CartContext'

const Cart = () => {
    const {cart, setCart} = useContext(CartContext)
    const [totalHT, setTotalHT] = useState(0)
    const [totalTVA, setTotalTVA] = useState(0)
    const [totalTTC, setTotalTTC] = useState(0)

    useEffect(() => {
        let totalHT_tmp = totalHT
        cart.forEach(item => {
            totalHT_tmp = totalHT_tmp + (item.qty * parseInt(item.product.price))
        })

        let totalTVA_tmp = totalHT_tmp*20/100
        let totalTTC_tmp = totalHT_tmp+totalTVA_tmp

        setTotalHT(totalHT_tmp)
        setTotalTVA(totalTVA_tmp)
        setTotalTTC(totalTTC_tmp+totalTVA)
    }, [])

    return (
        <div className="container">
            <h1>Page du panier</h1>
            { cart.length !== 0 && <>
                <div>
                    <table className="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {cart.map((item, index) => <tr key={`cart-${index}`}>
                                <td>{item.product.name}</td>
                                <td className="text-center">{item.qty}</td>
                                <td className="text-end">{parseInt(item.qty) * parseInt(item.product.price)} €</td>
                            </tr>)}
                            <tr>
                                <td></td>
                                <td className="text-end">Total HT:</td>
                                <td className="text-end">{totalHT} €</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td className="text-end">Total TVA:</td>
                                <td className="text-end">{totalTVA} €</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td className="text-end">Total TTC:</td>
                                <td className="text-end">{totalTTC} €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div className="text-end">
                        <Link class="btn btn-success" to='/cart_success'>Paiment</Link>
                    </div>
                </div>
            </>}

            { cart.length === 0 && <>
                <div className="mt-5 alert alert-danger">
                    Il n'y a aucun produit dans votre panier !
                </div>
                <div className="mt-5 text-center">
                     <Link className="btn btn-danger" to="/">Ajouter des produits</Link>    
                </div>
            </>}
        </div>
    )
}

export default Cart
