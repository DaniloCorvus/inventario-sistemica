<?php

use App\Cliente;
use App\Comentario;
use App\Marca;
use App\Models\Categoria;
use App\Models\Venta;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Rutas de Autentificacion
Auth::routes();
Route::get('/tecnico/myservices', 'TecnicoServiceController@index');

Route::get('/home', 'EstadisticaController@query')->name('home');
Route::get('/', 'EstadisticaController@query');

Route::get('/minihistoria', 'EquipoController@minihistoria');

//Campañas
Route::get('/campanas', 'CampanaController@index')->name('campañas.index');
Route::post('/campanas/sendmessage', 'CampanaController@sendMessage')->name('sendmessage');
Route::get('/campanas/clientes', 'CampanaController@filtro')->name('filtrar.clientes');

//verifys 
Route::get('/verify', 'VerifyController@verify');
Route::get('/verifyequipo', 'VerifyController@verifyEquipo');

// Busqueda de servicio
Route::get('/equipos/consultar/query/{equipo}', 'EquipoController@query');
Route::get('/service', 'ServiceController@query')->name('service.buscar');

// Estadisticas
Route::get('/estadistica/consultar', 'EstadisticaController@query')->name('estadistica.tecnico');

//Users
Route::resource('/users', 'UserController', ['except' => 'update']);
Route::get('/user/roles/{key}', 'UserController@show');
Route::patch('/users/update', 'UserController@update')->name('users.update');
Route::get('/users/perfil/{user}', 'UserController@perfil')->name('users.perfil');

//Roles
Route::resource('/rols', 'RoleController', ['except' => 'update']);
Route::patch('/rols/update', 'RoleController@update')->name('rols.update');
Route::post('/rols/asignar-rol', 'RoleController@asignarRole')->name('rols.asignarRole');
Route::get('/user/roles/eliminar-rol/{rolkey}/{userkey}', 'RoleController@eliminarRole');

//Clientes
Route::resource('/clientes', 'ClienteController', ['except' => 'update']);
Route::patch('/clientes/update', 'ClienteController@update')->name('clientes.update');
Route::get('/clientes/servicios/{cliente}', 'ClienteController@servicios');


// Informes
Route::get('/services/informe/informeServicios/', 'InformesController@entrefechas');
Route::get('/informes/informeServicios',  function () {
    $marcas = Marca::all();
    $users = User::all();
    return view('informes.entrefechas.front', compact('users', 'marcas'));
})->name('informe.informeServicios');


Route::get('/services/informe/filter/', 'InformesController@informe');
Route::get('/informes',  function () {
    $users = User::all();
    return view('informes.produccion.front', compact('users'));
})->name('informe.index');


Route::get('/services/informe/salida/', 'InformesController@salida');
Route::get('/informes/salida',  function () {
    $marcas = Marca::all();
    return view('informes.salidas.front', compact('marcas'));
})->name('informe.salida');

Route::get('/services/informe/dineros/', 'InformesController@dineros');
Route::get('/informes/dineros',  function () {
    $users = User::all();
    return view('informes.dineros.front', compact('users'));
})->name('informe.dineros');

// Graficas
Route::get('/charts/servicechart', 'ServiceChartController@index')->name('charts.services');
Route::get('/charts/charts', 'ServiceChartController@charts')->name('serviceChar');

Route::get('/services/informe/corte/', 'InformesController@Corte');
Route::get('/informes/cortes',  function () {
    $users = User::all();
    $marcas = Marca::all();
    return view('informes.corte.front', compact('users', 'marcas'));
})->name('informes.corte');



//Proveedores
Route::resource('/proveedors', 'ProveedorController', ['except' => 'update']);
Route::patch('/proveedors/update', 'ProveedorController@update')->name('proveedors.update');

//Gasto
Route::resource('/gastos', 'GastoController', ['except' => 'update', 'index']);
Route::patch('/gastos/update', 'GastoController@update')->name('gastos.update');
Route::get('/gastos/{service}/index', 'GastoController@index')->name('gastos.index');

//Adicional
Route::resource('/adicionales', 'AdicionalController', ['except' => 'update', 'index']);
Route::patch('/adicionales/update', 'AdicionalController@update')->name('adicionales.update');
Route::get('/adicionales/{service}/index', 'AdicionalController@index')->name('adicionales.index');

//Services
Route::resource('/services', 'ServiceController', ['except' => 'update']);
Route::resource('/detalle-venta', 'DetalleVentaController', ['except' => 'update']);
Route::patch('/services/update', 'ServiceController@update')->name('services.update');
Route::get('/services/filter/{finicio}/{ffin}', 'ServiceController@filtro');
Route::post('/services/printservice/', 'ServiceController@printservice')->name('services.printservice');
Route::get('/totalesgastosyadicionales/service/{service}', 'ServiceController@totalesgastosyadicionales');
Route::get('/totalesdinero/{service}', 'ServiceController@totalesdinero');


//Estados
Route::resource('/estados', 'EstadoController', ['except' => 'update']);
Route::patch('/estados/update', 'EstadoController@update')->name('estados.update');

//Adicional
Route::resource('/dineros', 'DineroController', ['except' => 'update', 'index']);
Route::patch('/dineros/update', 'DineroController@update')->name('dineros.update');
Route::get('/dineros/{service}/index', 'DineroController@index')->name('dineros.index');



//Adicional Venta
Route::resource('/dineros-venta', 'DinerosVentaController', ['except' => 'update', 'index']);
Route::get('/dineros-venta/{service}/index', 'DinerosVentaController@index')->name('dinerosventa.index');
Route::patch('/dineros-venta/update', 'DinerosVentaController@update')->name('dinerosventa.update');

//Estados
Route::resource('/tiporeparacions', 'ReparacionController', ['except' => 'update']);
Route::patch('/tiporeparacions/update', 'ReparacionController@update')->name('tiporeparacions.update');

//Estados
Route::resource('/clausulas', 'ClausulaController', ['except' => 'update']);
Route::patch('/clausulas/update', 'ClausulaController@update')->name('clausulas.update');

//Modos
Route::resource('/modos', 'ModoController', ['except' => 'update']);
Route::patch('/modos/update', 'ModoController@update')->name('modos.update');

//HappyCallEstados
Route::resource('/happycallestados', 'HappycallEstadoController', ['except' => 'update']);
Route::patch('/happycallestados/update', 'HappycallEstadoController@update')->name('happycallestados.update');

//Marcas
Route::resource('/marcas', 'MarcaController', ['except' => 'update']);
Route::patch('/marcas/update', 'MarcaController@update')->name('marcas.update');

//Productos
Route::resource('/productos', 'ProductoController', ['except' => 'update']);
Route::patch('/productos/update', 'ProductoController@update')->name('productos.update');

//Razons
Route::resource('/razons', 'RazonController', ['except' => 'update']);
Route::patch('/razons/update', 'RazonController@update')->name('razons.update');

//Tipos
Route::resource('/tipos', 'TipoController', ['except' => 'update']);
Route::patch('/tipos/update', 'TipoController@update')->name('tipos.update');

//Evidencias
Route::resource('/evidencias', 'EvidenciaController', ['except' => 'update']);
Route::patch('/evidencias/update', 'EvidenciaController@update')->name('evidencias.update');
Route::get('/evidencias/service/{service}', 'ServiceController@evidencias');

//Equipos
Route::resource('/equipos', 'EquipoController', ['except' => 'update']);
Route::patch('/equipos/update', 'EquipoController@update')->name('equipos.update');
Route::get('/equipos/servicios/{equipo}', 'EquipoController@serviciosEquipo');

//EquipoResource
Route::resource('/equiposervicio', 'EquipoServicioController');
Route::get('/accesorios/{service}', 'AccesorioController@service');

//Repuesto
Route::resource('/repuestos', 'RepuestoController', ['except' => 'update']);
Route::patch('/repuestos/update', 'RepuestoController@update')->name('repuestos.update');
Route::post('/repuestos/carga', 'RepuestoController@carga')->name('repuestos.carga');
Route::get('/repuestos/eliminar/{accesorio}/{service}', 'RepuestoController@eliminar')->name('repuestos.eliminar');

//Historias
Route::resource('/historias', 'HistoriaController', ['except' => ['update', 'index']]);
Route::get('/gethistorias/{service}', 'HistoriaController@index');
Route::patch('/historias/update', 'HistoriaController@update')->name('historias.update');

Route::resource('/historias-venta', 'HistoriaVentaController', ['except' => ['update', 'index']]);
Route::get('/gethistorias-venta/{venta}', 'HistoriaVentaController@index');

Route::get('/addmultiple', 'SettingController@addmultiple');
Route::get('/addSeeder', 'SettingController@addSeeder');
Route::get('/clear-cache', 'SettingController@clearcache');

// otros

Route::get('/getcomen', function () {

    return Comentario::all();
});

Route::get('/getInfoService/{id}', 'ServiceController@getInfoService');
Route::post('/services/addtecnico', 'ServiceController@addTecnicoToService')->name('services.addtecnico');

//sms
Route::post('/sms/send', 'SMSController@sendMensaje')->name('sendMensaje');
Route::get('/sms/getBalance', 'SMSController@getBalance')->name('getBalance');
//Messages

Route::resource('/messages', 'MessageController', ['except' => 'update']);
Route::patch('/messages/update', 'MessageController@update')->name('messages.update');
Route::get('/messages-carga', 'MessageController@getmessages');

//querys
Route::get('/querys', 'ServiceController@busqueda')->name('query.busqueda');
Route::get('/update-masivo', 'UpdateController@index')->name('update.busqueda');

// Route::get('/data', 'OrderController@data')->name('data');

// //Clientes
Route::resource('/productox', 'ProductoxController', ['except' => 'update']);
Route::post('/productox/update', 'ProductoxController@update')->name('productox.update');
Route::post('/productox/import', 'ProductoxController@import')->name('productox.import');

Route::get('productos-bodega/{id}', 'CellarController@verProductos');

//inventario
Route::resource('/inventario', 'InventarioController', ['except' => 'update']);
Route::resource('/cargue-inventario', 'CargueInventarioController', ['only' => 'show']);
Route::post('/cargue-inventario/estado', 'CargueInventarioController@actualizarEstado')->name('cargue.estado');

Route::post('/buscar-cantidades', 'InventarioController@buscarProducto')->name('inventario.inventariocantidades');

//Seguimientos
Route::resource('/pedidos', 'PedidoController', ['except' => 'update', 'index']);
Route::patch('/pedidos', 'PedidoController@index')->name('pedidos.update');

//ventas
Route::resource('/ventas', 'VentaController', ['except' => 'update', 'index']);
Route::patch('/ventas', 'VentaController@update')->name('ventas.update');

Route::post('/buscar-codigo', 'ProductoxController@buscarCodigo')->name('codigo.buscar');

// Route::view('/remision', 'pdfs.remision');

// //Categorias
Route::resource('/categorias', 'CategoriaController', ['except' => 'update']);
Route::patch('/categorias/update', 'CategoriaController@update')->name('categorias.update');

//Cellars
Route::resource('/cellars', 'CellarController', ['except' => 'update']);
Route::patch('/cellars/update', 'CellarController@update')->name('cellars.update');

// //Empresa
Route::resource('/empresa', 'EmpresaController');
Route::patch('/empresa/update', 'EmpresaController@update')->name('empresa.update');


Route::get('/test',  function () {
    $valor = 0;
    $numeroPedidoEsperado = 0;
    $tiempoEsperaPedidos = 0;
    $demandaDiaria = 0;
    $Ganancia = 0;
    /************************************************************** */
    $Demanda = 1200;
    $SOrdenar = 20;
    $SOrdenarx = 0;
    $valorCostoMantener = 0.3;
    $valorCostoMantenerx = 0;
    $diasPeriodo = 240;
    $total = 0;

    if ($Demanda > 0) {
        $DemandaOptima = sqrt((2 * $Demanda * $SOrdenar) / $valorCostoMantener);
        $numeroPedidoEsperado = $Demanda / $DemandaOptima;

        $tiempoEsperaPedidos = $diasPeriodo / $numeroPedidoEsperado;
        $demandaDiaria = ($Demanda / $diasPeriodo) * $tiempoEsperaPedidos;
        $SOrdenarx = ($Demanda / $DemandaOptima) * $SOrdenar;
        $valorCostoMantenerx = ($DemandaOptima * $valorCostoMantener) / 2;
        $total = ($Demanda * $SOrdenarx) + $SOrdenarx + $valorCostoMantenerx;

        dd([
            'Q' => $DemandaOptima,
            'N' => $numeroPedidoEsperado,
            'L' => $tiempoEsperaPedidos,
            'R' => $demandaDiaria,
            'CO' => $SOrdenarx,
            'CM' => $valorCostoMantenerx,
            'CT' => $total
        ]);
    }
})->name('informes.corte');
