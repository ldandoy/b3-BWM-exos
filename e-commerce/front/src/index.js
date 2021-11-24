import React from 'react';
import ReactDOM from 'react-dom';
import {
    BrowserRouter as Router,
    Link
} from "react-router-dom";

import { Route, Routes } from "react-router";

import Home from './pages/Home';
import Category from './pages/Category';

import Navbar from './components/Navbar';

import './index.css';

const App = () => {
    return <Router>
        <div>
            <Navbar />

            <Routes>
                <Route path="/" element={<Home />}></Route>
                <Route path="/category/:categoryName" element={<Category />}></Route>
            </Routes>
        </div>
    </Router>
}

ReactDOM.render(
    <App />,
    document.getElementById('root')
)