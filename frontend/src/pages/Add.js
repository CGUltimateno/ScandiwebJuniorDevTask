import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Footer from '../components/Footer';
import Header from '../components/Header';
import '../styles/add.scss';
import fetcher from '../components/fetcher';

function AddProduct() {
    const [productType, setProductType] = useState('');
    const [formData, setFormData] = useState({
        sku: '',
        name: '',
        price: '',
        value: ''
    });
    const [furnitureDimensions, setFurnitureDimensions] = useState({
        length: '',
        width: '',
        height: ''
    });
    const [errors, setErrors] = useState({
        sku: '',
        name: '',
        price: '',
        value: '',
        dimensions: ''
    });

    const navigate = useNavigate();

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });

        if (name === 'sku' && value.trim() === '') {
            setErrors(prevErrors => ({ ...prevErrors, sku: 'SKU is required' }));
        } else {
            setErrors(prevErrors => ({ ...prevErrors, sku: '' }));
        }

        if (name === 'name' && value.trim() === '') {
            setErrors(prevErrors => ({ ...prevErrors, name: 'Name is required' }));
        } else {
            setErrors(prevErrors => ({ ...prevErrors, name: '' }));
        }

        if (name === 'price' && (value.trim() === '' || isNaN(value))) {
            setErrors(prevErrors => ({ ...prevErrors, price: 'Price must be a number' }));
        } else {
            setErrors(prevErrors => ({ ...prevErrors, price: '' }));
        }

        if (name === 'value' && value.trim() === '') {
            setErrors(prevErrors => ({ ...prevErrors, value: 'Value is required' }));
        } else {
            setErrors(prevErrors => ({ ...prevErrors, value: '' }));
        }
    };

    const handleTypeChange = (e) => {
        setProductType(e.target.value);
        setFormData({ ...formData, value: '' });
        setFurnitureDimensions({ length: '', width: '', height: '' });
        setErrors({ ...errors, value: '', dimensions: '' });
    };

    const handleDimensionChange = (e) => {
        const { name, value } = e.target;
        setFurnitureDimensions({ ...furnitureDimensions, [name]: value });
    };

    const saveProduct = async () => {
        let formattedData = {
            sku: formData.sku,
            name: formData.name,
            price: parseFloat(formData.price),
            type: productType,
            value: ''
        };

        if (formData.sku.trim() === '' || formData.name.trim() === '' || isNaN(formData.price)) {
            alert('Please fill all required fields with valid data.');
            return;
        }

        if (productType === 'Book') {
            const parsedValue = parseFloat(formData.value);
            if (!isNaN(parsedValue)) {
                formattedData.value = formData.value;
            } else {
                alert('Please enter a valid weight (KG) for the Book');
                return;
            }
        } else if (productType === 'Furniture') {
            const { length, width, height } = furnitureDimensions;
            if (length.trim() === '' || width.trim() === '' || height.trim() === '' || isNaN(length) || isNaN(width) || isNaN(height)) {
                alert('Please enter valid dimensions (length, width, height)');
                return;
            } else {
                formattedData.value = `${length}x${width}x${height}`;
            }
        } else if (productType === 'DVD') {
            const parsedValue = parseFloat(formData.value);
            if (!isNaN(parsedValue)) {
                formattedData.value = formData.value;
            } else {
                alert('Please enter a valid size (MB) for the DVD');
                return;
            }
        } else {
            alert('Please select a valid product type');
            return;
        }

        try {
            const existingProduct = await fetcher('GET', {}, `api/products/${formData.sku}`);
            if (existingProduct && existingProduct.data && existingProduct.data.sku) {
                await fetcher('DELETE', { skus: [formData.sku] }, 'api/delete');
                console.log('Product deleted:', formData.sku);
            } else {
                console.log('Product does not exist:', formData.sku);
            }

            const response = await fetcher('POST', formattedData, 'api/add');
            if (response.success) {
                navigate('/');
            } else {
                alert('Failed to save product.');
            }
        } catch (err) {
            console.error('Error during saveProduct:', err);
            alert('An error occurred while saving the product.');
        }
    };

    return (
        <section className='ap-container'>
            <Header onSave={saveProduct} />
            <div className="ap-body">
                <form id="product_form">
                    <div className="input-wrapper">
                        <label htmlFor="sku">SKU:</label>
                        <input type="text" id="sku" name="sku" value={formData.sku} onChange={handleInputChange} />
                        {errors.sku && <small className="error-text">{errors.sku}</small>}
                    </div>

                    <div className="input-wrapper">
                        <label htmlFor="name">Name:</label>
                        <input type="text" id="name" name="name" value={formData.name} onChange={handleInputChange} />
                        {errors.name && <small className="error-text">{errors.name}</small>}
                    </div>

                    <div className="input-wrapper">
                        <label htmlFor="price">Price ($):</label>
                        <input type="text" id="price" name="price" value={formData.price} onChange={handleInputChange} />
                        {errors.price && <small className="error-text">{errors.price}</small>}
                    </div>

                    <div className="input-wrapper">
                        <label htmlFor="productType">Type:</label>
                        <select id="productType" name="type" value={productType} onChange={handleTypeChange}>
                            <option value="">Select Type</option>
                            <option value="DVD">DVD</option>
                            <option value="Book">Book</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>
                    {productType === 'DVD' && (
                        <>
                            <div className="input-wrapper">
                                <label htmlFor="size">Size (MB):</label>
                                <input type="text" id="size" name="value" value={formData.value} onChange={handleInputChange} />
                                {errors.value && <small className="error-text">{errors.value}</small>}
                            </div>
                            <small className="form-text text-muted">Please provide the size in MB.</small>
                        </>
                    )}

                    {productType === 'Book' && (
                        <>
                            <div className="input-wrapper">
                                <label htmlFor="weight">Weight (KG):</label>
                                <input type="text" id="weight" name="value" value={formData.value} onChange={handleInputChange} />
                                {errors.value && <small className="error-text">{errors.value}</small>}
                            </div>
                            <small className="form-text text-muted">Please provide the weight in KG.</small>
                        </>
                    )}

                    {productType === 'Furniture' && (
                        <>
                            <div className="input-wrapper">
                                <label htmlFor="length">Length (CM):</label>
                                <input type="text" id="length" name="length" value={furnitureDimensions.length} onChange={handleDimensionChange} />
                            </div>
                            <div className="input-wrapper">
                                <label htmlFor="width">Width (CM):</label>
                                <input type="text" id="width" name="width" value={furnitureDimensions.width} onChange={handleDimensionChange} />
                            </div>
                            <div className="input-wrapper">
                                <label htmlFor="height">Height (CM):</label>
                                <input type="text" id="height" name="height" value={furnitureDimensions.height} onChange={handleDimensionChange} />
                                {errors.dimensions && <small className="error-text">{errors.dimensions}</small>}
                            </div>
                            <small className="form-text text-muted">Please provide the dimensions in HxWxL format.</small>
                        </>
                    )}
                </form>
            </div>
            <Footer />
        </section>
    );
}

export default AddProduct;
