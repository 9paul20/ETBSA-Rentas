@extends('layout')

@push('styles')
@endpush

@section('content')
    <div class="flex min-h-screen bg-gray-50" style="background-image: linear-gradient(115deg, #9F7AEA, #FEE2FE)">

        <div class="container mx-auto flex-1 h-full mx-auto rounded-lg shadow-xl mt-10">
            <!-- Component Start -->
            <h1 class="text-lg text-gray-800 font-medium text-center">2020 IPL Season - Table</h1>
            <div class="flex flex-col mt-6 ">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full text-sm text-gray-400">
                                <thead class="bg-purple-800 text-xs uppercase font-medium">
                                    <tr>
                                        <th></th>
                                        <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                            Club
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                            MP
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                            W
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                            L
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                            NRR
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                            Pts
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                            Last 5
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr class="bg-black bg-opacity-10">
                                        <td class="pl-4">
                                            1
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <img class="w-5"
                                                src="https://ssl.gstatic.com/onebox/media/sports/logos/JTre94vh6WJeLmIL-Dfc1g_48x48.png"
                                                alt="">
                                            <span class="ml-2 font-medium">MI</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            14
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            9
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            5
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            +1.107
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            18
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <svg class="w-4 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-4">
                                            2
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <img class="w-5"
                                                src="https://ssl.gstatic.com/onebox/media/sports/logos/TjudW-BaNE2HcD_6cOWC7Q_48x48.png"
                                                alt="">
                                            <span class="ml-2 font-medium">DC</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            14
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            9
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            5
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            +1.107
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            18
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <svg class="w-4 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-4">
                                            3
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <img class="w-5"
                                                src="https://ssl.gstatic.com/onebox/media/sports/logos/G9q07ZXPVbPkXOagStz3Yw_48x48.png"
                                                alt="">
                                            <span class="ml-2 font-medium">SRH</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            14
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            9
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            5
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            +1.107
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            18
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-4">
                                            4
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <img class="w-5"
                                                src="https://ssl.gstatic.com/onebox/media/sports/logos/MxXIt0k-eorEn6yOhD-KBA_48x48.png"
                                                alt="">
                                            <span class="ml-2 font-medium">RCB</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            14
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            9
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            5
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            +1.107
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            18
                                        </td>
                                        <td class="flex px-6 py-4 whitespace-nowrap">
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg class="w-4 fill-current text-green-600"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Component End  -->
        </div>
    </div>
@endsection

@push('scripts')
@endpush
