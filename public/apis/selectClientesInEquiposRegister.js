
new autoComplete({
    data: {
        src: async () => {
            const query = document.querySelector("#selectClientesInEquiposRegister").value;
            return clientes;
        },
        key: ["identificacion"],
        cache: true
    },

    placeHolder: "Cliente (Buscar por Documento)",
    selector: "#selectClientesInEquiposRegister",

    resultsList: {
        render: true,
        container: source => {
            source.setAttribute("class", "custom-select");
            source.setAttribute("name", "cliente_id");
        },
        destination: document.querySelector("#selectClientesInEquiposRegister"),
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