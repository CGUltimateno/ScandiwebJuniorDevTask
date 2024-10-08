import React, { useEffect, useState } from 'react';
import Footer from '../components/Footer';
import Header from '../components/Header';
import '../styles/products.scss';
import fetcher from '../components/fetcher';
import Prodbox from '../components/Prodbox';

function Products() {
    const [dataLoaded, setDataLoaded] = useState(false);
    const [productList, setProductList] = useState([]);
    const [error, setError] = useState(false);

    const massDelete = () => {
        const selectedSkus = productList
            .filter(product => document.getElementById(product.sku).checked)
            .map(product => product.sku);

        if (selectedSkus.length === 0) {
            alert('Please select at least one product to delete.');
            return;
        }

        fetcher('DELETE', { skus: selectedSkus }, 'api/delete')
            .then(response => {
                if (response.success) {
                    setProductList(productList.filter(product => !selectedSkus.includes(product.sku)));
                } else {
                    alert('Failed to delete products');
                    setError(true);
                }
            })
            .catch(() => {
                alert('An error occurred while deleting products');
                setError(true);
            });
    };

    useEffect(() => {
        fetcher('GET', {}, 'api/products')
            .then(response => {
                if (response.success) {
                    setProductList(response.data);
                    setDataLoaded(true);
                } else {
                    setError(true);
                }
            })
            .catch(() => setError(true));
    }, []);

    return (
        <section className='p-container'>
            <Header onMassDelete={massDelete} />
            <div className="p-body">
                {dataLoaded ? (
                    productList.length ? (
                        productList.map(product => (
                            <Prodbox data={product} key={product.sku} />
                        ))
                    ) : (
                        <p className='p-message'>No data</p>
                    )
                ) : error ? (
                    <div className="p-message">Oops, something went wrong.</div>
                ) : null}
            </div>
            <Footer />
        </section>
    );
}

export default Products;
