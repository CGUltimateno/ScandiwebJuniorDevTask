import React from 'react';

const Products = ({ products, onDelete }) => {
    return (
        <div>
            <nav className="navbar bg-transparent">
                <div className="container px-auto">
                    <h2 className="navbar-brand my-auto">Products List</h2>
                    <span>
            <a href="/add-product" className="btn btn-outline-success">Add</a>
            <button onClick={onDelete} className="btn btn-outline-danger">Delete</button>
          </span>
                </div>
            </nav>
            <hr />
            <div className="container my-5">
                <div className="row g-4">
                    {products.map((product, index) => (
                        <div className="col-6 col-sm-3" key={product.sku}>
                            <div className="card shadow border-dark">
                                <div className="card-body">
                                    <div className="form-check-inline">
                                        <label className="form-check-label">
                                            <input type="checkbox" className="form-check-input" name={product.sku} />
                                        </label>
                                    </div>
                                    <h5 className="card-text text-center">{product.sku}</h5>
                                    <h5 className="card-text text-center">{product.name}</h5>
                                    <h6 className="card-text text-center">{product.price} $</h6>
                                    <h6 className="card-text text-center">{product.value}</h6>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default Products;
