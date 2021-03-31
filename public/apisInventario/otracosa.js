function filtrar() {
    inicio = document.getElementById('min').value;
    fin = document.getElementById('max').value;
    box = document.getElementById('box');

    if (inicio.length == 0 || fin.length == 0) {
        toastr.error('Error', 'Complete los campos')
        box.style.display = 'none';
        dtEquipos.ajax.url(SITEURL + '/orders').load();

    } else {
        document.getElementById('resultTotal').innerHTML = 'Cargando..';
        console.time('Measuring time');
        fetch(SITEURL + '/orders/filter/' + inicio + '/' + fin, {
                method: 'GET',
                mode: "cors",
                headers: {
                    accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(response => {
                response.json().then(async res => {

                    async function sumar(data) {
                        let suma = 0;
                        let index = 0;
                        for (index; index < data.length; index++) {
                            suma = (parseFloat(data[index].total) + suma);
                        }
                        const response = [index, suma];
                        return response;
                    };

                    const carga = await dtEquipos.ajax.url(SITEURL + '/orders/filter/' + inicio + '/' + fin).load();
                    const contar = await sumar(res.data);

                    async function dats() {
                        const [x, c] = await Promise.all([carga, contar]);
                        box.style.display = 'block';
                        document.getElementById('resultTotal').innerHTML =
                            `Ordenes obtenidas : ${c[0]} , valor total : $ ${c[1].toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')}`
                    }

                    dats();

                })
            });

        console.timeEnd('Measuring time');
    }
}

// 1.239990234375ms



function filtrar() {
    inicio = document.getElementById('min').value;
    fin = document.getElementById('max').value;
    box = document.getElementById('box');

    if (inicio.length == 0 || fin.length == 0) {
        toastr.error('Error', 'Complete los campos')
        box.style.display = 'none';
        dtEquipos.ajax.url(SITEURL + '/orders').load();

    } else {
        document.getElementById('resultTotal').innerHTML = 'Cargando..';
        console.time('Measuring time');
        fetch(SITEURL + '/orders/filter/' + inicio + '/' + fin, {
                method: 'GET',
                mode: "cors",
                headers: {
                    accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(response => {
                response.json().then(res => {
                    var suma = 0;
                    let index = 0;
                    data = res.data;

                    for (index; index < data.length; index++) {
                        suma = (parseFloat(data[index].total) + suma)
                    }

                    box.style.display = 'block';
                    document.getElementById('resultTotal').innerHTML = `Ordenes obtenidas ${index}
                    Valor total : $ ${suma.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')} `;
                })
            }).then(() =>
                dtEquipos.ajax.url(SITEURL + '/orders/filter/' + inicio + '/' + fin).load());
        console.timeEnd('Measuring time');
    }
}
