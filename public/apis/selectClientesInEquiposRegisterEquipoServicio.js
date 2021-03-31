
new autoComplete({
    data: {
        src: async () => {
            const query = document.querySelector("#selectClientesInEquiposRegisterEquipoServicio").value;
            return clientes;
        },
        key: ["identificacion"],
        cache: true
    },

    placeHolder: "Cliente (Buscar por Documento)",
    selector: "#selectClientesInEquiposRegisterEquipoServicio",

    resultsList: {
        render: true,
        container: source => {
            source.setAttribute("class", "custom-select");
            source.setAttribute("name", "cliente_id");
        },
        destination: document.querySelector("#selectClientesInEquiposRegisterEquipoServicio"),
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