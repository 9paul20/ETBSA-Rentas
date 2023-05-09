@props(['id', 'statusPaymentRent', 'name', 'description', 'href'])

<a href="{{ $href }}" x-data="{ tooltip: 'Show{{ $id }}' }"
    onclick="event.preventDefault(); show{{ $id }}('{{ $id }}', '{{ $name }}', '{{ $description }}')"
    class="btn-show">

    @if ($statusPaymentRent == 'Pagado')
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6 text-white bg-orange-500 rounded-full">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 text-white bg-green-500 rounded-full">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
    @endif

    </svg>
</a>

<form id="{{ $id }}-form" action="{{ $href }}" method="POST" style="display: none;">
    @csrf
    @if ($statusPaymentRent == 'Pagado')
        <input class="hidden" name="clvEstadoPagoRenta" id="clvEstadoPagoRenta" value="1">
    @else
        <input class="hidden" name="clvEstadoPagoRenta" id="clvEstadoPagoRenta" value="2">
    @endif
    @method('PUT')
</form>

@push('scripts')
    <script>
        function show{{ $id }}(id, name, description) {
            Swal.fire({
                title: `${name}`,
                text: `${description}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#15803D',
                cancelButtonColor: '#CA8A04',
                confirmButtonText: 'Sí, cambiar Estado de Pago',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`${id}-form`).submit();
                }
            })
        }
    </script>
@endpush
