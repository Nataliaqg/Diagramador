<div>
    <div>
        <button wire:click="generarScriptTablaspsql">Generar Script PSQL</button>
        <button wire:click="generarScriptTablasSQLSERVVER">Generar Script SQL SERVER</button>
        <button wire:click="generarScriptTablasMYSQL">Generar Script MYSQL</button>
    </div>
    <div>
       
        <textarea id="resultadoScript" readonly style="width: 500px; height: 200px;" wire:model="scriptResultado"></textarea>
    </div>
</div>
