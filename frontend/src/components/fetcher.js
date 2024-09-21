export default function fetcher(method = 'GET', data = {}, endpoint = '') {
    const url = `http://localhost:8000/${endpoint}`;

    const param = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
        },
    };

    if (method === 'POST' || method === 'DELETE') {
        param.body = JSON.stringify(data);
    }

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