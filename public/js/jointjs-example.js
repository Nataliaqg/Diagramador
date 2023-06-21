import * as joint from 'jointjs';

// Crear un nuevo lienzo de JointJS
const graph = new joint.dia.Graph();


// Crear elementos
const rect = new joint.shapes.basic.Rect({
  position: { x: 100, y: 30 },
  size: { width: 100, height: 50 },
  attrs: { rect: { fill: 'blue' }, text: { text: 'Rect', fill: 'white' } }
});

const circle = new joint.shapes.basic.Circle({
  position: { x: 250, y: 30 },
  size: { width: 50, height: 50 },
  attrs: { circle: { fill: 'red' }, text: { text: 'Circle', fill: 'white' } }
});

// Conectar los elementos
const link = new joint.dia.Link({
  source: { id: rect.id },
  target: { id: circle.id }
});

// Agregar elementos y enlaces al lienzo
graph.addCells([rect, circle, link]);

// Obtener la representación en JSON del lienzo
const json = graph.toJSON();

// Imprimir el JSON resultante
console.log(json);
