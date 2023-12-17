<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>
                        <a href="{{ route('products.index') }}">
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                                Products
                            </span>
                        </a>
                    </p>
                    @php
                        $admin = auth()->user()->is_admin;
                    @endphp


                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                @if($admin)
                                    <th scope="col" class="px-6 py-3">
                                        Customer name
                                    </th>
                                @endif
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Amount
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $sale)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    @if($admin)
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $sale->name }}
                                        </th>
                                    @endif

                                    <td class="px-6 py-4">
                                        {{ $sale->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sale->quantity }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sale->price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sale->quantity * $sale->price }}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

