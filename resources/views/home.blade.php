@extends('layouts.app')

@section('content')
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

<script type="text/javascript">
    var namespace = joint.shapes;
    var graph = new joint.dia.Graph({}, { cellNamespace: namespace });

    var paper = new joint.dia.Paper({
        el: document.getElementById('myholder'),
        model: graph,
        width: 1100,
        height: 530,
        gridSize: 1,
        cellViewNamespace: namespace
    });

    // Clase: Persona
    var persona = new joint.shapes.uml.Class({
        position: { x: 100, y: 30 },
        size: { width: 120, height: 60 },
        name: 'Persona',
        attributes: ['id: int', 'nombre: string', 'edad: int'],
        methods: ['guardar()', 'actualizar()', 'eliminar()']
    });
    persona.attr('body/fill', 'lightblue');
    persona.attr('label/fontWeight', 'bold');
    persona.addTo(graph);

    // Clase: Empleado
    var empleado = new joint.shapes.uml.Class({
        position: { x: 400, y: 30 },
        size: { width: 120, height: 60 },
        name: 'Empleado',
        attributes: ['id: int', 'nombre: string', 'edad: int', 'sueldo: float'],
        methods: ['trabajar()', 'cobrarSueldo()']
    });
    empleado.attr('body/fill', 'lightblue');
    empleado.attr('label/fontWeight', 'bold');
    empleado.addTo(graph);

    // Relación de herencia
    var inheritance = new joint.shapes.standard.Inheritance({
        source: { id: persona.id },
        target: { id: empleado.id }
    });
    inheritance.addTo(graph);
</script>
@endsection
