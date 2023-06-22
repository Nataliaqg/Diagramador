<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="width: 90%">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <!-- Contenido del diagrama de JointJS -->
                        <div id="myholder"></div>
                        <button id="btnAgregarRelacion">Agregar Relación</button>

                        <div>
                            <input type="text" id="inputTableName" placeholder="Nombre de la tabla">
                            <input type="text" id="inputAttributes" placeholder="Atributos separados por comas">
                            <button id="btnAgregarTabla">Agregar Tabla</button>

                            <!-- ... código HTML anterior ... -->
{{-- 
                            <button wire:click="crearTabla" wire:target="crearTabla">
                                Agregar Persona</button> --}}
                                <!-- ... código HTML anterior ... -->

{{-- <button wire:click="crearTabla('Nueva Persona', ['atributo1: Tipo1', 'atributo2: Tipo2'])">Agregar Persona</button> --}}

<!-- ... código HTML posterior ... -->

                            

                            <!-- ... código HTML posterior ... -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ... código HTML anterior ... -->

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.1/backbone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jointjs/3.7.2/joint.js"></script>

<!-- Styles -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jointjs/3.7.2/joint.css" />

<!-- Vista de tu componente Livewire -->
<script type="text/javascript">
    var namespace = joint.shapes;
    var graph = new joint.dia.Graph({}, {
        cellNamespace: namespace
    });
    var paper = new joint.dia.Paper({
        el: document.getElementById('myholder')
        , model: graph
        , width: 600
        , height: 400
        , gridSize: 1
        , cellViewNamespace: namespace
    });

    // Array para almacenar la información de las tablas
    var tablasInformacion = [];

    @if(isset($tablas))
    @foreach(json_decode($tablas) as $persona)
        var persona = @json($persona);
        var personaShape = new joint.shapes.uml.Class(persona);
        personaShape.addTo(graph);

        // Guardar la información de la tabla en el array
        tablasInformacion.push({
            id: personaShape.id, // o cualquier identificador único de la tabla
            position: personaShape.position(),
            name: personaShape.get('name'),
            attributes: personaShape.get('attributes')
        });
    @endforeach
    @endif

    // Array para almacenar la información de las relaciones
    var relacionesInformacion = [];

    // Agrega el código JavaScript para manejar el evento de Livewire
    document.getElementById('btnAgregarTabla').addEventListener('click', function() {
        var tableName = document.getElementById('inputTableName').value;
        var attributeString = document.getElementById('inputAttributes').value;

        if (tableName.trim() !== '' && attributeString.trim() !== '') {
            var attributes = attributeString.split(',');
            var nuevaTabla = new joint.shapes.uml.Class({
                position: {
                    x: 200
                    , y: 200
                }
                , size: {
                    width: 120
                    , height: 80
                }
                , name: tableName
                , attributes: attributes
                , methods: ['metodo1()', 'metodo2()']
            });

            nuevaTabla.addTo(graph);

            // Guardar la información de la tabla en el array
            tablasInformacion.push({
                id: nuevaTabla.id, // o cualquier identificador único de la tabla
                position: nuevaTabla.position(),
                name: nuevaTabla.get('name'),
                attributes: nuevaTabla.get('attributes')
            });

            // Llamar a la función de Livewire para crear la nueva tabla
            Livewire.emit('crearTabla', tableName, attributes);
        }
    });

    // Obtener todos los elementos del grafo
    var cells = graph.getCells();

    // Array para almacenar la información de posición, nombre y atributos de las tablas
    var elementosInformacion = [];

    // Iterar sobre los elementos para obtener su información
    cells.forEach(function(cell) {
        // Verificar si el elemento es una tabla
        if (cell instanceof joint.shapes.uml.Class) {
            // Guardar la información de la tabla en el array
            elementosInformacion.push({
                id: cell.id, // o cualquier identificador único de la tabla
                position: cell.position(),
                name: cell.get('name'),
                attributes: cell.get('attributes')
            });
        }
    });

    // Mostrar la información de las tablas en la consola
    console.log('Información de las tablas:', elementosInformacion);

    // Agregar evento para capturar los movimientos de los elementos
    paper.on('cell:pointerup', function(cellView) {
        // Obtener el elemento movido
        var elementoMovido = cellView.model;

        // Buscar el elemento en el array de información
        var elementoInformacion = elementosInformacion.find(function(item) {
            return item.id === elementoMovido.id;
        });

        // Actualizar la posición del elemento en el array
        if (elementoInformacion) {
            elementoInformacion.position = elementoMovido.position();
        }

        // Mostrar la información actualizada en la consola
        console.log('Información actualizada:', elementosInformacion);
    });

    // Variables para almacenar las tablas seleccionadas
    var tablaFuenteSeleccionada = null;
    var tablaDestinoSeleccionada = null;

    // Evento para seleccionar una tabla como tabla fuente
    paper.on('element:pointerup', function(cellView) {
        if (tablaFuenteSeleccionada === null) {
            // Seleccionar la tabla como tabla fuente
            tablaFuenteSeleccionada = cellView.model;
            tablaFuenteSeleccionada.attr('body/stroke', 'red'); // Cambiar el color de la tabla seleccionada
        } else if (tablaDestinoSeleccionada === null) {
            // Seleccionar la tabla como tabla destino
            tablaDestinoSeleccionada = cellView.model;
            tablaDestinoSeleccionada.attr('body/stroke', 'blue'); // Cambiar el color de la tabla seleccionada
        }
    });

    // Evento para agregar una relación entre las tablas seleccionadas
document.getElementById('btnAgregarRelacion').addEventListener('click', function() {
    if (tablaFuenteSeleccionada !== null && tablaDestinoSeleccionada !== null) {
        // Crear objeto de relación
        var relacion = {
            source: tablaFuenteSeleccionada.id,
            target: tablaDestinoSeleccionada.id
        };

        // Agregar la relación al array de relaciones o realizar cualquier otra acción que desees
        relacionesInformacion.push(relacion);

        // Dibujar la relación en el gráfico
        var relacionLink = new joint.shapes.standard.Link({
            source: { id: tablaFuenteSeleccionada.id },
            target: { id: tablaDestinoSeleccionada.id },
            router: { name: 'metro' },
            connector: { name: 'rounded' },
            attrs: {
                '.connection': { stroke: 'black', 'stroke-width': 2 },
                '.marker-target': { fill: 'black', d: 'M 10 0 L 0 5 L 10 10 z' }
            }
        });

        graph.addCell(relacionLink);

        // Restablecer las tablas seleccionadas
        tablaFuenteSeleccionada.attr('body/stroke', 'black'); // Restablecer el color de la tabla fuente
        tablaDestinoSeleccionada.attr('body/stroke', 'black'); // Restablecer el color de la tabla destino
        tablaFuenteSeleccionada = null;
        tablaDestinoSeleccionada = null;

        // Actualizar la vista de relaciones
        actualizarRelaciones();

        // Mostrar las relaciones actualizadas en la consola
        console.log('Relaciones actualizadas:', relacionesInformacion);
    }
});


    // Función para actualizar la vista de relaciones
    function actualizarRelaciones() {
        // ... código para actualizar la vista de relaciones ...
    }
</script>
</div>

    
</div>
