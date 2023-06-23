@extends('layouts.app')
@section('content')


@livewire('pizarra.creartabla', ['pizarra' => $pizarra])



@livewire('generar-vistas')



@endsection
