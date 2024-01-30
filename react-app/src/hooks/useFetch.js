"use client"
import { useState } from 'react';

const useFetch = (params, baseUrl = "") => {
    const [response, setResponse] = useState();
    const [error, setError] = useState();
    const [loading, setLoading] = useState(false)
    const baseURL = baseUrl || 'http://127.0.0.1:8000/api';

    const fetchDataMethod = async (params) => {
        setLoading(true)
        try {
            const result = await fetch(baseURL + params?.url, {
                method: params?.method,
                headers: params?.headers
            })
            const resultJson = await result.json();
            setResponse(resultJson)
        } catch( err ) {
            setError(err)
        } finally {
            setLoading(false)
        }
    }

    const fetchData = () => {
        fetchDataMethod(params)
    }

    return {
        response,
        setResponse,
        error,
        setError,
        loading,
        fetchData,
    }
}

export default useFetch;