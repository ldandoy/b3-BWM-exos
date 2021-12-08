import React, { useEffect, useState, useContext } from 'react'
import { Link } from 'react-router-dom'
import axios from 'axios'

import { CartContext } from '../context/CartContext'

const Navbar = () => {
    const {cart, setCart} = useContext(CartContext)
    const [categories, setCategories] = useState([]);

    console.log(cart)

    useEffect(() => {
        const getProductCategory = async () => {
            const res = await axios.get('http://localhost:5000/api/product-category/')
            setCategories(res.data)
            return true;
        };
        getProductCategory();
    }, [])

    return (
        <nav className="navbar navbar-expand-lg fixed-top navbar-dark  bg-dark">
            <div className="container-fluid">
                <a className="navbar-brand" href="/">E-commerce</a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                        {
                            categories.map((category) => <li key={`cat-${category.id}`}>
                                <Link className="nav-link" to={`/category/${category.id}`}>
                                    {category.name}
                                </Link>
                            </li>)
                        }
                    </ul>

                    <ul className="navbar-nav ms-auto mb-lg-0">
                        <li><Link className="nav-link" to='/cart'><i className="fas fa-shopping-cart"></i> <span className="badge bg-secondary">{cart.length}</span></Link></li>
                        <li><Link className="nav-link" to='/login'>Login</Link></li>
                        <li><Link className="nav-link" to='/register'>Register</Link></li>
                    </ul>
                </div>
            </div>
        </nav>
    )
}

export default Navbar
