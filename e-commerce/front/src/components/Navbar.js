import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import axios from 'axios'

const Navbar = () => {
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        const getProductCategory = async () => {
            const res = await axios.get('http://localhost:5000/api/product-category/')
            setCategories(res.data)
            return true;
        };
        getProductCategory();
    }, [])

    return (
        <nav>
            <Link to='/'>Home</Link>
            {
                categories.map((category) => <Link key={`cat-${category.id}`} to={`/category/${category.id}`}>
                    {category.name}
                </Link>)
            }
            <Link to='/login'>Login</Link>
            <Link to='/register'>Register</Link>
        </nav>
    )
}

export default Navbar
