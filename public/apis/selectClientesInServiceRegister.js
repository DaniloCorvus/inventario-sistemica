
new autoComplete({
    data: {
        src: async () => {
            const query = document.querySelector("#selectClientesInServiceRegister").value;
            return clientes;
        },
        key: ["identificacion"],
        cache: true
    },

    placeHolder: "Cliente (Buscar por Documento)",
    selector: "#selectClientesInServiceRegister",

    resultsList: {
        render: true,
        container: source => {
            source.setAttribute("class", "custom-select");
            source.setAttribute("name", "cliente_id");
            source.setAttribute("id", "selectionClientesInServiceRegister");
        },
        destination: document.querySelector("#selectClientesInServiceRegister"),
        position: "afterend",
        element: "select"
    },

    resultItem: {
        content: (data, source) => {
            source.value = data.value.id;
            source.innerHTML = data.value.nombre + ' ' + data.value.apellido;
        },
        element: "option"
    },
});