// components/Header.js
import React from 'react';
import { useLocation, Link } from 'react-router-dom';

function Header({ onSave, onMassDelete }) {
    const location = useLocation();
    let title = '';
    let leftBtn = null;
    let rightBtn = null;

    if (location.pathname === '/add-product') {
        title = 'Add Product';
        leftBtn = (
            <button className="btn btn-primary" id="add-product-btn" onClick={onSave}>
                Save
            </button>
        );
        rightBtn = (
            <Link to="/">
                <button className="btn btn-secondary">Cancel</button>
            </Link>
        );
    } else if (location.pathname === '/') {
        rightBtn = (
            <button className="btn btn-danger" id="delete-product-btn" onClick={onMassDelete}>
                Mass Delete
            </button>
        );
        leftBtn = (
            <Link to="/add-product">
                <button className="btn btn-primary">Add</button>
            </Link>
        );
    }

    return (
        <div className="header">
            <h2>{title}</h2>
            <div className="buttons-wrapper">
                {leftBtn}
                {rightBtn}
            </div>
        </div>
    );
}

export default Header;
