'use client'

import {Button} from "@mui/material";
import {useEffect, useState} from "react";
import Loader from "../../../components/Loader";

const OrderDetailPage = ({ params }) => {
    const [order, setOrder] = useState(null);
    const [allowedActions, setAllowedActions] = useState([]);
    const [loading, setLoading] = useState(false);
    const [filteredButtons, setFilteredButtons] = useState([]);

    const fetchData = async () => {
        try {
            setLoading(true);
            const orderResponse = await fetch(`http://127.0.0.1:8000/api/order/${params.id}`);
            const orderResponseJson = await orderResponse.json();
            const allowedActionsResponse = await fetch(`http://127.0.0.1:8000/api/order/${params.id}/allowedActions`);
            const allowedActionsResponseJson = await allowedActionsResponse.json();

            setLoading(false);
            setOrder(orderResponseJson?.data);
            setAllowedActions(allowedActionsResponseJson?.data);

            // setFilteredButtons(orderStateButtons.filter(obj => allowedActionsResponseJson?.data?.includes(obj.state)));
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    useEffect(() => {
        fetchData();
    }, []);

    const updateOrderStatus = async (link) => {
        setLoading(true);
        const res = await fetch(`http://127.0.0.1:8000/api/order/${params.id}${link}`, {
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
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            <tr>
                                <td>{order?.id}</td>
                                <td>{order?.description}</td>
                                <td>{order?.status}</td>
                                <td>{order?.amount}</td>
                            </tr>
                        }
                        </tbody>
                    </table>
                    <div>
                        {
                            filteredButtons?.map((button, index) => (
                                <Button key={index} sx={{ marginRight: '20px' }} onClick={() => updateOrderStatus(button.link)} variant={'outlined'}>{ button?.text }</Button>
                            ))
                        }
                    </div>
                </div>
            }
        </>
)
};

export default OrderDetailPage;