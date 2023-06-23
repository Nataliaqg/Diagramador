<div>
    
  
    
    <div class="m-5">
       <div class="m-5">
        {{-- <form>
            <input type="text" id="nombrePizarra" placeholder="nombre Pizarra">        
            <button type="submit" class="btn btn-success">crear Pizarra</button>
          
          </form> --}}

          <form wire:submit.prevent="crearPizarra">
            <input type="text" id="nombrePizarra" placeholder="Nombre de la pizarra" wire:model="nombrePizarra" required>
            <button type="submit" class="btn btn-success">crear Pizarra</button>
        </form>
       </div>
          
       <div class="d-flex flex-wrap">
    @foreach ($pizarras as $pizarra)
    <div class="card m-3" style="width: 18rem;">
        
        <div class="card-body">
            <h5 class="card-title">Nombre de la pizarra: </h5>
          <h5 class="card-title">{{$pizarra->nombre}}</h5>
     
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">USUARIOS: </li>   
          <li class="list-group-item">{{$pizarra->user->name}}</li>       
        </ul>
        <div class="card-body">
       
          <a href="{{ url('ShowPizarra/' . $pizarra->id) }}" class="card-link">Ir a la Pizarra</a>

         
          <a href="{{ url('scripts/' . $pizarra->id) }}" class="card-link">Crear Scripts</a>
        </div>
      </div>
      @endforeach
    </div>


    </div>
</div>
