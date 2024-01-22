import {Button} from "@mui/material";
import Link from "next/link";


const OrdersPage = async () => {
    const res = await fetch('http://127.0.0.1:8000/api/order');
    const orders = await res.json();
    return (
        <div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                {
                    orders?.data?.map((order, index) => (
                        <tr>
                            <td>{order.id}</td>
                            <td>{order.description}</td>
                            <td>{order.status}</td>
                            <td>{order.amount}</td>
                            <td>
                                <Link className={'button-link'} href={`/orders/${order.id}`}>Edit</Link>
                            </td>
                        </tr>
                    ))
                }
                </tbody>
            </table>
        </div>
    )
}

export default OrdersPage;