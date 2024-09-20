import React from "react";

function Prodbox({ data }) {
    const handleCheckboxChange = (e) => {
        e.currentTarget.classList.toggle('selected');
    };

    return (
        <div className="product-wrapper">
            <input type="checkbox" className="delete-checkbox" id={data.sku} onChange={handleCheckboxChange} />
            <p>{data.sku}</p>
            <p>{data.name}</p>
            <p>{data.price} $</p>
            <p>{data.type}: {data.value + (data.type === 'Size' ? ' MB' : data.type === 'Weight' ? ' KG' : '')}</p>
        </div>
    );
}

export default Prodbox;