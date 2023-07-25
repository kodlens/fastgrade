@extends('layouts.admin-layout')

@section('content')
    <faculty-load prop-user='@json($user)'></faculty-load>
@endsection