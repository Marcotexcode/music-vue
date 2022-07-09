@extends('layouts.app')

@section('content')
<div class="d-flex">
    <div id="app" >
        <app-component></app-component>
     </div>
     <div class="w-100">
        <router-view></router-view>
     </div>
</div>
@endsection
