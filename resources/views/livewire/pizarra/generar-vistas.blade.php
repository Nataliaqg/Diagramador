<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <h1>Generar Vista HTML</h1>
    
    {{-- <button wire:click="generarPlantillaHTML">Generar Script PSQL</button> --}}
    <button wire:click="generarPlantillaHTML('Usuarios', ['Nombre', 'Edad', 'Correo'])">Generar Plantilla HTML</button>

    <textarea id="resultadoScript" readonly style="width: 500px; height: 200px;" wire:model="scriptResultado"></textarea>

    <div>
        <?php echo $scriptResultado; ?>
    </div>
</div>