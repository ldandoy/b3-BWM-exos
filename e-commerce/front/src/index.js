import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import {
    BrowserRouter as Router,
} from "react-router-dom";

import { Route, Routes } from "react-router";

import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import Category from './pages/Category';
import Product from './pages/Product';
import Cart from './pages/Cart';
import CartSuccess from './pages/CartSuccess'
import Navbar from './components/Navbar';

import { CartContext } from './context/CartContext';

import './index.css';

const App = () => {
    const [cart, setCart] = useState([])
    
    return <Router>
        <CartContext.Provider value={{ cart, setCart }}>
            <div>
                <Navbar />

                <Routes>
                    <Route path="/" element={<Home />}></Route>
                    <Route path="/login" element={<Login />}></Route>
                    <Route path="/register" element={<Register />}></Route>
                    <Route path="/category/:categoryId" element={<Category />}></Route>
                    <Route path="/product/:productId" element={<Product />}></Route>
                    <Route path="/cart_success" element={<CartSuccess />}></Route>
                    <Route path="/cart" element={<Cart />}></Route>
                </Routes>
            </div>
        </CartContext.Provider>
    </Router>
}

ReactDOM.render(
    <App />,
    document.getElementById('root')
)