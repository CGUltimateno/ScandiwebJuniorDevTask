import React from "react";

function Prodbox({ data }) {
    const handleCheckboxChange = (e) => {
        if (e.target.getAttribute('type') !== 'checkbox') {
            e.currentTarget.classList.toggle('selected');
            const checkbox = e.currentTarget.querySelector('.delete-checkbox');
            checkbox.checked = !checkbox.checked;
        }    };

    return (
        <div className="product-wrapper" onClick={handleCheckboxChange}>
            <input type="checkbox" className="delete-checkbox" id={data.sku}/>
            <p>{data.sku}</p>
            <p>{data.name}</p>
            <p>{data.price} $</p>
            <p>{data.type}: {data.value + (data.type === 'Size' ? ' MB' : data.type === 'Weight' ? ' KG' : '')}</p>
        </div>
    );
}

export default Prodbox;