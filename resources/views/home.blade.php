@extends('layouts.app')

@section('content')
<div class="d-flex">
    <div id="app" >
      <!-- Mostra i componenti che ho registrato su app.js  -->
        <app-component></app-component>
     </div>
     <div class="w-100">
      <!-- Mostra tutti i componenti vue che aggiungo alle rotte lato js -->
        <router-view></router-view>
     </div>
</div>
@endsection
