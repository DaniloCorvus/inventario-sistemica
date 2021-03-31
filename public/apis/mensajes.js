async function cargarBody() {

    select = document.getElementById('selectSms').value;

    const resp = await axios.get(`/messages/${select}/edit`)
    switch (resp.status) {
        case 200:
            document.getElementById('bodyMessage').innerText += resp.data.body;
            break;
        default:
            console.log(resp);
            break;
    }
}

async function deleteBody() {
    document.getElementById('bodyMessage').innerText = '';
}

async function getMessage() {

    const resp = await axios.get('/messages-carga')
    switch (resp.status) {
        case 200:
            html = resp.data.map(message => {
                return ` <option value="${message.id}">${message.descripcion}</option>`
            })
            document.getElementById('selectSms').innerHTML = html;
            break;
    }
}

getMessage();

