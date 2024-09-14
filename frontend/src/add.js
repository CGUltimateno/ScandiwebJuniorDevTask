import React, { useState } from 'react';

const AddProduct = ({ onSubmit }) => {
    const [formData, setFormData] = useState({
        sku: '',
        name: '',
        price: '',
        type: '',
        // additional product attributes (size, weight, dimensions)
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (onSubmit) onSubmit(formData);
    };

    return (
        <form onSubmit={handleSubmit} className="needs-validation" noValidate>
            {/* SKU Field */}
            <div className="row mb-3 g-3 align-items-center">
                <label htmlFor="sku" className="col-form-label col-sm-2 col-lg-1">SKU</label>
                <div className="col-sm-auto">
                    <input
                        type="text"
                        id="sku"
                        name="sku"
                        value={formData.sku}
                        onChange={handleChange}
                        required
                        className="form-control"
                    />
                    <div className="invalid-feedback">Please enter a SKU.</div>
                </div>
            </div>
            {/* Other form fields follow the same structure */}
        </form>
    );
};

export default AddProduct;
