"use client"

import {createContext, useContext, useEffect, useState} from 'react';

export const ContainerContext = createContext();

export const ContainerProvider = (props) => {
    const [containers, setContainers] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        getContainers();
    }, []);

    const getContainers = async () => {
        setLoading(true);
        const res = await fetch('http://127.0.0.1:8000/api/containers');
        const resJson = await res.json();
        setContainers(resJson.data);
        setLoading(false);
    }

    const values = {
        containers,
        setContainers,
        loading
    }

    return (
        <ContainerContext.Provider value={ values }>
            {props.children}
        </ContainerContext.Provider>
    )
};

export const useContainerContext = () => {
    return useContext(ContainerContext);
};