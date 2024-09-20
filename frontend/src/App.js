// App.js
import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Products from './pages/Products';
import Add from './pages/Add';
import Header from './components/Header';
import './App.scss';

const ProductApp = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Products />} />
                <Route path="/add-product" element={<Add />} />
            </Routes>
        </Router>
    );
};

export default ProductApp;
