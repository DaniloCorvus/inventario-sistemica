
new autoComplete({
    data: {
        src: async () => {
            const query = document.querySelector("#selectEquiposInServiceRegister").value;
            return equipos;
        },
        key: ["serie"],
        cache: true
    },

    placeHolder: "Equipo (Buscar por Serie)",
    selector: "#selectEquiposInServiceRegister",

    resultsList: {
        render: true,
        container: source => {
            source.setAttribute("class", "custom-select");
            source.setAttribute("name", "equipo_id");
            source.setAttribute("id", "selectionEquiposInServiceRegister");
        },
        destination: document.querySelector("#selectEquiposInServiceRegister"),
        position: "afterend",
        element: "select"
    },

    resultItem: {
        content: (data, source) => {
            source.value = data.value.id;
            source.innerHTML = data.value.serie;
        },
        element: "option"
    },
});