import React from 'react';
import Link from "next/link";

const ProductPage = async () => {
    const res = await fetch('http://127.0.0.1:8000/api/product', { cache: "no-cache" });
    const products = await res.json();

    return (
        <div className={'table-container'}>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {
                    products?.data?.map((product, index) => (
                        <tr>
                            <td>{product?.id}</td>
                            <td>{product?.name}</td>
                            <td>{product?.description}</td>
                            <td>
                                <Link className={'button-link'} href={`/products/${product?.id}`}>Edit</Link>
                            </td>
                        </tr>
                    ))
                }
                </tbody>
            </table>
        </div>
    )
}

export default ProductPage;