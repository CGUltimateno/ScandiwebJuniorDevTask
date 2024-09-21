import React from "react";

function Prodbox({ data }) {
    const handleCheckboxChange = (e) => {
        e.currentTarget.classList.toggle('selected');
    };

    const TypeHandler = (data) => {
        if (data.type === 'DVD') {
            return data.type = 'Size';
        } else if (data.type === 'Book') {
            return data.type = 'Weight';
        } else {
            return data.type = 'Dimensions';
        }
    };

    return (
        <div className="product-wrapper">
            <input type="checkbox" className="delete-checkbox" id={data.sku} onChange={handleCheckboxChange} />
            <p>{data.sku}</p>
            <p>{data.name}</p>
            <p>{data.price} $</p>
            <p>{data.type}: {data.value + (data.type === 'DVD' ? ' MB' : data.type === 'Book' ? ' KG' : '')}</p>
        </div>
    );
}

export default Prodbox;