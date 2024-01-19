"use client"

import * as React from 'react';
import { DataGrid } from '@mui/x-data-grid';
import { ContainerContext, useContainerContext } from "@/context/ContainerContext";
import Loader from "@/components/Loader";
import {Button} from "@mui/material";
import Link from 'next/link';

const columns = [
    { field: 'id', headerName: 'ID', width: 70 },
    { field: 'name', headerName: 'Name', width: 130 },
    { field: 'tag', headerName: 'Tag', width: 130 },
    {
        field: 'status',
        headerName: 'Status',
        type: 'number',
        width: 90,
    },
    {
        field: 'active',
        headerName: 'Active',
        type: 'boolean',
        width: 90,
    },
];

const DataTable = ({ data }) => {
    const { containers, loading } = useContainerContext(ContainerContext);
    return (
        <>
            {
                loading ?
                    <Loader/> :
                    <div style={{height: 400, width: '100%'}}>
                        <DataGrid
                            rows={containers}
                            columns={columns}
                            initialState={{
                                pagination: {
                                    paginationModel: {page: 0, pageSize: 5},
                                },
                            }}
                            pageSizeOptions={[5, 10]}
                            checkboxSelection
                        />
                        <Link style={{ padding: '10px', border: '1px solid black', marginTop: '10px', display: 'inline-block' }} href={'containers/new'}>Create new</Link>
                    </div>
            }

        </>
    )
};

export default DataTable;