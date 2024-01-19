'use client'

import Box from "@mui/material/Box";
import {Input, InputLabel, FormControl, FormHelperText, Checkbox, FormControlLabel, Button} from "@mui/material";
import {useState} from "react";
import Loader from "@/components/Loader";

const CreateNewContainer = () => {
    const [name, setName] = useState('');
    const [tag, setTag] = useState('');
    const [active, setActive] = useState(false);
    const [loading, setLoading] = useState(false);
    const handleSubmit = async () => {
        setLoading(true);
        const data = {
            name: name,
            tag: tag,
            active: active
        }
        const res = await fetch('http://127.0.0.1:8000/api/containers', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data)
        })
            .then((response) => {
                console.log(response)
            })
            .catch(error => {
                console.log(error)
            })
        setLoading(false);
    }
    return (
        <Box sx={{ display: 'flex', flexDirection: 'column', margin: '100px' }}>
            <h2>Create new container</h2>
            <InputLabel sx={{ marginTop: '10px' }} htmlFor="container-name">Name</InputLabel>
            <Input value={name} onChange={(e) => setName(e.target.value)} id="container-name" />
            <InputLabel sx={{ marginTop: '10px' }} htmlFor="container-tag">Tag</InputLabel>
            <Input value={tag} onChange={(e) => setTag(e.target.value)} id="container-tag" />
            <FormControlLabel
                label="Active"
                control={<Checkbox value={active} onChange={() => setActive(!active)} />}
            />
            <Button variant={'outlined'} onClick={handleSubmit}>Submit</Button>
            {loading && <Loader />}
        </Box>
    )
}

export default CreateNewContainer;