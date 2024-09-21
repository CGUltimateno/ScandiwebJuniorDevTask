import React from "react";

function Prodbox({ data }) {
    const handleCheckboxChange = (e) => {
        e.currentTarget.classList.toggle('selected');
    };

    const TypeHandler = (type) => {
        if (type === 'DVD') {
            return 'Size';
        } else if (type === 'Book') {
            return 'Weight';
        } else {
            return 'Dimensions';
        }
    };

    const transformedType = TypeHandler(data.type);

    return (
        <div className="product-wrapper">
            <input type="checkbox" className="delete-checkbox" id={data.sku} onChange={handleCheckboxChange} />
            <p>{data.sku}</p>
            <p>{data.name}</p>
            <p>{data.price} $</p>
            <p>{transformedType}: {data.value + (data.type === 'DVD' ? ' MB' : data.type === 'Book' ? ' KG' : '')}</p>
        </div>
    );
}

export default Prodbox;