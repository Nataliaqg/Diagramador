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
                            <button id="guardarPizarra">Guardar Pizarra</button>
                            <button id="enviarId">Enviar id</button>
                            <label for="tipoRelacion">Tipo de Relación:</label>
                            <select id="tipoRelacion">
                                <option value="composicion">Composición</option>
                                <option value="agregacion">Agregación</option>
                                <option value="asociacion">Asociación</option>
                                <option value="generalizacion">Generalización</option>
                            </select>


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
            el: document.getElementById('myholder'),
            model: graph,
            width: 600,
            height: 400,
            gridSize: 1,
            cellViewNamespace: namespace
        });

        // Array para almacenar la información de las tablas
        var tablasInformacion = [];
        var relacionesInformacion = [];

        @if (isset($tablas))
            @php
                $data = json_decode($tablas, true);
                $tablasArray = $data['tablas'];
            @endphp
            @foreach ($tablasArray as $persona)
                var persona = {
                    id: "{{ $persona['id'] }}",
                    position: {
                        x: {{ $persona['position']['x'] }},
                        y: {{ $persona['position']['y'] }}
                    },
                    name: "{{ $persona['name'] }}",
                    attributes: {!! json_encode($persona['attributes']) !!}
                };
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

        @if (isset($tablas))
            @php
                $data = json_decode($tablas, true);
                $relacionesArray = $data['relaciones'] ?? [];
            @endphp
            @foreach ($relacionesArray as $relacion)
                var sourceId = "{{ $relacion['source'] }}";
                var targetId = "{{ $relacion['target'] }}";
                var tipoRelacion = "{{ $relacion['type'] }}";

                // Obtener los objetos de tabla correspondientes a los IDs de origen y destino
                var tablaFuente = tablasInformacion.find(function(tabla) {
                    return tabla.id === sourceId;
                });

                var tablaDestino = tablasInformacion.find(function(tabla) {
                    return tabla.id === targetId;
                });

                if (tablaFuente && tablaDestino) {
                    // Crear la relación en el gráfico
                    var relacionLink = new joint.shapes.standard.Link();
                    relacionLink.source(tablaFuente);
                    relacionLink.target(tablaDestino);
                    relacionLink.attr({
                        line: {
                            stroke: '#000000'
                        },
                        '.marker-target': {
                            fill: '#000000',
                            d: 'M 10 0 L 0 5 L 10 10 z'
                        }
                    });
                    relacionLink.addTo(graph);

                    // Guardar la información de la relación en el array
                    relacionesInformacion.push({
                        source: sourceId,
                        target: targetId,
                        type: tipoRelacion
                    });
                }
            @endforeach
        @endif



        // Array para almacenar la información de las relaciones

        var elementosInformacion = [];

        // Agrega el código JavaScript para manejar el evento de Livewire
        document.getElementById('btnAgregarTabla').addEventListener('click', function() {
            var tableName = document.getElementById('inputTableName').value;
            var attributeString = document.getElementById('inputAttributes').value;

            if (tableName.trim() !== '' && attributeString.trim() !== '') {
                var attributes = attributeString.split(',');
                var nuevaTabla = new joint.shapes.uml.Class({
                    position: {
                        x: 200,
                        y: 200
                    },
                    size: {
                        width: 120,
                        height: 80
                    },
                    name: tableName,
                    attributes: attributes,
                    methods: ['metodo1()', 'metodo2()']
                });

                nuevaTabla.addTo(graph);

                // Guardar la información de la tabla en el array
                elementosInformacion.push({
                    id: nuevaTabla.id, // o cualquier identificador único de la tabla
                    position: nuevaTabla.position(),
                    name: nuevaTabla.get('name'),
                    attributes: nuevaTabla.get('attributes')
                });
                console.log('Información melanie:', elementosInformacion);

                // Llamar a la función de Livewire para crear la nueva tabla
                // Livewire.emit('crearTabla', tableName, attributes);
            }
        });


        // Obtener todos los elementos del grafo
        var cells = graph.getCells();

        // Array para almacenar la información de posición, nombre y atributos de las tablas


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
            document.getElementById('enviarId').addEventListener('click', function() {
                // Emitir el ID al controlador Livewire
                // Obtener el ID de la tabla seleccionada
                var tablaId = cellView.model.id;
               // console.log('entra');
                Livewire.emit('actualizarTablaSeleccionada', tablaId);
               //console.log(tablaId);
            });

        });

        // Evento para agregar una relación entre las tablas seleccionadas
        document.getElementById('btnAgregarRelacion').addEventListener('click', function() {
            if (tablaFuenteSeleccionada !== null && tablaDestinoSeleccionada !== null) {
                var tipoRelacion = document.getElementById('tipoRelacion').value;

                // Crear objeto de relación
                var relacion = {
                    source: tablaFuenteSeleccionada.id,
                    target: tablaDestinoSeleccionada.id,
                    type: tipoRelacion
                };

                // Agregar la relación al array de relaciones o realizar cualquier otra acción que desees
                relacionesInformacion.push(relacion);

                // Dibujar la relación en el gráfico
                var relacionLink;

                // Seleccionar el tipo de flecha según el tipo de relación
                if (relacion.type === 'composicion') {
                    relacionLink = new joint.shapes.standard.Link({
                        source: {
                            id: tablaFuenteSeleccionada.id
                        },
                        target: {
                            id: tablaDestinoSeleccionada.id
                        },
                        router: {
                            name: 'metro'
                        },
                        connector: {
                            name: 'rounded'
                        },
                        attrs: {
                            '.connection': {
                                stroke: 'black',
                                'stroke-width': 2
                            },
                            '.marker-target': {
                                d: 'M 10 0 L 0 5 L 10 10 z',
                                fill: 'black'
                            }
                        }
                    });
                } else if (relacion.type === 'agregacion') {
                    relacionLink = new joint.shapes.standard.Link({
                        source: {
                            id: tablaFuenteSeleccionada.id
                        },
                        target: {
                            id: tablaDestinoSeleccionada.id
                        },
                        router: {
                            name: 'metro'
                        },
                        connector: {
                            name: 'rounded'
                        },
                        attrs: {
                            '.connection': {
                                stroke: 'black',
                                'stroke-width': 2
                            },
                            '.marker-target': {
                                d: 'M 10 0 L 0 5 L 10 10 z'
                            }
                        }
                    });
                } else if (relacion.type === 'asociacion') {
                    relacionLink = new joint.shapes.standard.Link({
                        source: {
                            id: tablaFuenteSeleccionada.id
                        },
                        target: {
                            id: tablaDestinoSeleccionada.id
                        },
                        router: {
                            name: 'metro'
                        },
                        connector: {
                            name: 'rounded'
                        },
                        attrs: {
                            '.connection': {
                                stroke: 'black',
                                'stroke-width': 2
                            },
                            '.marker-target': {
                                d: 'M 10 0 L 0 5 L 10 10 z'
                            }
                        }
                    });
                } else if (relacion.type === 'generalizacion') {
                    relacionLink = new joint.shapes.standard.Link({
                        source: {
                            id: tablaFuenteSeleccionada.id
                        },
                        target: {
                            id: tablaDestinoSeleccionada.id
                        },
                        router: {
                            name: 'metro'
                        },
                        connector: {
                            name: 'rounded'
                        },
                        attrs: {
                            '.connection': {
                                stroke: 'black',
                                'stroke-width': 2
                            },
                            '.marker-target': {
                                d: 'M 10 0 L 0 5 L 10 10 z',
                                fill: 'white'
                            }
                        }
                    });
                }

                graph.addCell(relacionLink);

                // Restablecer las tablas seleccionadas
                tablaFuenteSeleccionada.attr('body/stroke', 'black'); // Restablecer el color de la tabla fuente
                tablaDestinoSeleccionada.attr('body/stroke', 'black'); // Restablecer el color de la tabla destino
                tablaFuenteSeleccionada = null;
                tablaDestinoSeleccionada = null;

                // Mostrar las relaciones actualizadas en la consola
                console.log('Relaciones actualizadas:', relacionesInformacion);
            }
        });


        document.getElementById('guardarPizarra').addEventListener('click', function() {
            console.log('Información melanie:', elementosInformacion);
            // Llamar a la función de Livewire para crear la nueva tabla
            Livewire.emit('crearTabla', elementosInformacion, relacionesInformacion);

        });
    </script>
</div>


</div>
