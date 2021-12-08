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

import Navbar from './components/Navbar';
import { MyContext } from './context/MyContext';

import './index.css';

const App = () => {
    const [test, setTest] = useState({
        test: 'bye'
    })
    
    return <Router>
        <MyContext.Provider value={{ test, setTest }}>
            <div>
                <Navbar />

                <Routes>
                    <Route path="/" element={<Home />}></Route>
                    <Route path="/login" element={<Login />}></Route>
                    <Route path="/register" element={<Register />}></Route>
                    <Route path="/category/:categoryId" element={<Category />}></Route>
                    <Route path="/product/:productId" element={<Product />}></Route>
                </Routes>
            </div>
        </MyContext.Provider>
    </Router>
}

ReactDOM.render(
    <App />,
    document.getElementById('root')
)