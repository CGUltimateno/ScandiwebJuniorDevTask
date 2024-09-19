export default function fetcher(method = 'GET', data = {}, endpoint = '') {
    const url = `http://localhost:8000/${endpoint}`; // Use the endpoint parameter

    const param = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
        },
    };

    if (method === 'POST' || method === 'DELETE') {
        param.body = JSON.stringify(data);
    }

    // Return the fetch promise
    return fetch(url, param)
        .then((response) => {
            if (!response.ok) {
                throw new Error('Connection failed.');
            }
            return response.json();
        })
        .then((res) => {
            if (res.error) {
                return { success: false, error: res.error };
            }
            return { success: true, data: res };
        })
        .catch((err) => {
            return { success: false, error: err.message };
        });
}