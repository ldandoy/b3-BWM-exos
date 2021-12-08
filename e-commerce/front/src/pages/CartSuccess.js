import React, {useContext, useEffect} from 'react'
import { CartContext } from '../context/CartContext'

const CartSuccess = () => {
    const {cart, setCart} = useContext(CartContext)

    useEffect(() => {
        setCart([])
    }, [])

    return (
        <div className="container">
            Page après paiment réussi
        </div>
    )
}

export default CartSuccess
