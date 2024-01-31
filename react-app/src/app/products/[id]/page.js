'use client'

import {Button} from "@mui/material";
import {useEffect, useState} from "react";
import Loader from "../../../components/Loader";
import productStateButtons from "../../../helpers/productStateButtons";

const ProductDetailPage = ({ params }) => {
    const [product, setProduct] = useState(null);
    const [allowedActions, setAllowedActions] = useState([]);
    const [loading, setLoading] = useState(false);
    const [filteredButtons, setFilteredButtons] = useState([]);
    const [variants, setVariants] = useState([]);

    const fetchData = async () => {
        try {
            setLoading(true);
            const productResponse = await fetch(`http://127.0.0.1:8000/api/product/${params.id}?includeVariants=true`);
            const productResponseJson = await productResponse.json();
            const allowedActionsResponse = await fetch(`http://127.0.0.1:8000/api/product/${params.id}/allowedActions`);
            const allowedActionsResponseJson = await allowedActionsResponse.json();


            setLoading(false);
            setProduct(productResponseJson?.data);
            setAllowedActions(allowedActionsResponseJson);

            setFilteredButtons(productStateButtons.filter(obj => allowedActionsResponseJson?.includes(obj.action)));
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    useEffect(() => {
        fetchData();
    }, []);

    const updateProductStatus = async (action) => {
        setLoading(true);
        const res = await fetch(`http://127.0.0.1:8000/api/product/${params.id}/${action}`, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json",
            },
        });
        await fetchData();
    }

    return (
        <>
            { loading ?
                <Loader /> :
                <div className={'table-container'}>
                    <p>Product name: { product?.name }</p>
                    <p>Product description: { product?.description }</p>
                    <p>Product status: { product?.status }</p>
                    <h3>Variants: </h3>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            product?.variants?.map((variant, index) => (
                                <tr key={index}>
                                    <td>{variant?.id}</td>
                                    <td>{variant?.name}</td>
                                    <td>{variant?.value}</td>
                                    <td>{variant?.price}</td>
                                </tr>
                            ))
                        }
                        </tbody>
                    </table>
                    <div>
                        {
                            filteredButtons?.map((button, index) => (
                                <Button key={index} sx={{marginRight: '20px' }} onClick={() => updateProductStatus(button.action)} variant={'outlined'}>{ button?.text }</Button>
                            ))
                        }
                    </div>
                </div>
            }
        </>
)
};

export default ProductDetailPage;