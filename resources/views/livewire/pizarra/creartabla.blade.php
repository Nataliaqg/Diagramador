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
                      
                        <div>
                            <input type="text" id="inputTableName" placeholder="Nombre de la tabla">
                            <input type="text" id="inputAttributes" placeholder="Atributos separados por comas">
                            <button id="btnAgregarTabla">Agregar Tabla</button>

                            <!-- ... código HTML anterior ... -->

<button wire:click="crearTabla('Nueva Persona', ['atributo1: Tipo1', 'atributo2: Tipo2'])">Agregar Persona</button>

<!-- ... código HTML posterior ... -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        // var persona = @json($persona);
        // var personaShape = new joint.shapes.uml.Class(persona);
        // personaShape.addTo(graph);

    //     @foreach ($personas as $persona)
    //     var persona = @json($persona);
    //     var personaShape = new joint.shapes.uml.Class(persona);
    //     personaShape.addTo(graph);
    // @endforeach

//     document.getElementById('btnAgregarTabla').addEventListener('click', function() {
//     var tableName = document.getElementById('inputTableName').value;
//     var attributeString = document.getElementById('inputAttributes').value;
    
//     if (tableName.trim() !== '' && attributeString.trim() !== '') {
//         var attributes = attributeString.split(',');
//         var nuevaTabla = new joint.shapes.uml.Class({
//             position: {
//                 x: 200,
//                 y: 200
//             },
//             size: {
//                 width: 120,
//                 height: 80
//             },
//             name: tableName,
//             attributes: attributes,
//             methods: ['metodo1()', 'metodo2()']
//         });

//         nuevaTabla.addTo(graph);

//         Livewire.emitTo('pizarra.creartabla', 'crearTabla', tableName, attributes);
//     }
// });

// Elimina el código JavaScript anterior que renderizaba las personas

@foreach ($personas as $persona)
    var persona = @json($persona);
    var personaShape = new joint.shapes.uml.Class(persona);
    personaShape.addTo(graph);
@endforeach

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

        // Llamar a la función de Livewire para crear la nueva tabla
        Livewire.emit('crearTabla', tableName, attributes);
    }
});


    </script>
</div>
