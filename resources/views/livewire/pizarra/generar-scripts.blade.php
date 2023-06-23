<div >
<div class="text-center">
    <div class="btn-group">
        <button class="btn btn-primary" wire:click="generarScriptTablaspsql">PostgreSql</button>
        <button class="btn btn-primary" wire:click="generarScriptTablasSQLSERVVER">Sql Server</button>
        <button class="btn btn-primary" wire:click="generarScriptTablasMYSQL">MYSQL</button>
    </div>
</div>
<div class="mt-3 mx-auto">
    <textarea id="resultadoScript" readonly class="form-control" style="width: 900px; height: 200px;" wire:model="scriptResultado"></textarea>
</div>
</div>
