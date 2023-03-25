@extends('layout')

@push('styles')
@endpush

@section('content')
    <div class="relative">
        <input class="border-2 border-gray-300 p-2 w-full rounded" type="text" placeholder="Seleccionar fecha">
        <svg class="absolute top-0 right-0 w-6 h-6 m-2 pointer-events-none" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M19.95 4.95a9 9 0 1 1-13.44 11.7L3 17.88l1.06-3.6A9 9 0 0 1 19.95 4.95zM11 9h2v7h-2V9zm4 0h2v7h-2V9z" />
        </svg>
    </div>
@endsection

@push('scripts')
@endpush
