import orderStateButtons from "@/helpers/orderStateButtons";

const OrderDetailPage = async () => {
    const res = await fetch('http://127.0.0.1:8000/api/order/1');
    const order = await res.json();

    const resAllowedActions = await fetch('http://127.0.0.1:8000/api/order/1/allowedActions');
    const allowedActions = await resAllowedActions.json();

    return (
        <div>
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
                        <td>{order?.data?.id}</td>
                        <td>{order?.data?.description}</td>
                        <td>{order?.data?.status}</td>
                        <td>{order?.data?.amount}</td>
                    </tr>
                }
                </tbody>
            </table>
        </div>
)
};

export default OrderDetailPage;