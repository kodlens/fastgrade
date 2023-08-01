@extends('layouts.faculty-layout')

@section('content')

<section class="section">

    <div class="columns is-centered">
        <div class="column is-6">
            <div class="box">
                <faculty-student-list 
                    prop-schedule-id="{{ $sid }}"
                    prop-faculty-id="{{ $fid }}"></faculty-student-list>
            </div>
        </div>
    </div>
</section>


@endsection
