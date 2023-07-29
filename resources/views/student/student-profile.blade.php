<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
 --}}

</head>
<body>
    <div id="app">

        <div class="columns is-centered">
            <div class="column is-10">
                <div class="box">

                    <div class="columns">
                        <div class="column">
                            <b-field label="Last Name">
                                <b-input type="text" placeholder="Last Name"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="First Name">
                                <b-input type="text" placeholder="First Name"></b-input>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Middle Name">
                                <b-input type="text" placeholder="Last Name"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="TEST">
                                <b-input type="text" placeholder="TEST"></b-input>
                            </b-field>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


    <div>
    <script>

    </script>
</body>
</html>
