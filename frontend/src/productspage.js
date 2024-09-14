import React, { useState, useEffect } from 'react';
import Products from './Products';

const ProductPage = () => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        fetch('/api/products')
            .then(response => response.json())
            .then(data => setProducts(data));
    }, []);

    const handleDelete = () => {
        // Logic to delete selected products
    };

    return (
        <div>
            <Products products={products} onDelete={handleDelete} />
        </div>
    );
};

export default ProductPage;
