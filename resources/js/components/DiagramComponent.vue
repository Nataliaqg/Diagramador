<template>
  <div ref="diagramContainer"></div>
</template>

<script>
export default {
  mounted() {
    const graph = new joint.dia.Graph();
    const paper = new joint.dia.Paper({
      el: this.$refs.diagramContainer,
      model: graph,
      width: 800,
      height: 600,
    });
    
    // Aquí puedes agregar lógica para crear y manipular elementos del diagrama utilizando las
    // funciones proporcionadas por JointJS
  }
}
</script>
