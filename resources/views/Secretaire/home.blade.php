@extends('layouts.app')

@section('content')
    <h1>Bienvenus {{  auth()->user()->role }}</h1>
            <h4>Ici se trouve la liste des Dossier </h4>


@endsection
