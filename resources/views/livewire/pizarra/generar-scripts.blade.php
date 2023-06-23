<div class="text-center">
    
        <div class="btn-group">
            <button class="btn btn-primary m-3" wire:click="generarScriptTablaspsql">PostgreSql</button>
            <button class="btn btn-primary m-3" wire:click="generarScriptTablasSQLSERVVER">Sql Server</button>
            <button class="btn btn-primary m-3" wire:click="generarScriptTablasMYSQL">MYSQL</button>
            <button class="btn btn-primary m-3" wire:click="generarScriptTablasOracle">Oracle</button>


        </div>
   
    <div class="mt-3 mx-auto">
        <textarea id="resultadoScript" readonly class="form-control" style="width: 1300px; height: 200px;"
            wire:model="scriptResultado"></textarea>
    </div>
</div>
