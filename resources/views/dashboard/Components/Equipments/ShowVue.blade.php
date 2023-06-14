@extends('layout')

@push('html_style')
    class="h-full bg-gray-100"
@endpush

@push('body_style')
    class="h-full"
@endpush

@push('styles')
    {{-- <link rel="stylesheet" href="{{ url('/css/main.ad49aa9b.css.map') }}" /> --}}
@endpush

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--
                    This example requires updating your template:

                    ```
                    <html class="h-full bg-gray-100">
                    <body class="h-full">
                    ```
                  -->
    <div id="vueApp">
        <div>
            {{-- <show-equipments logo="{{ url('/images/John_Deere_Logo.png') }}" /> --}}
            <practice-table-etbsa-rent />
        </div>
    </div>
@endsection
