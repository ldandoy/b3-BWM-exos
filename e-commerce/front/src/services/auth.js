import axios from 'axios'

export const register = async (user) => {
    const res = await axios.post(`http://localhost:5000/api/register`, user)
    return res.data
}

export const login = async (user) => {
    const res = await axios.post(`http://localhost:5000/api/login`, user)
    return res.data
}
