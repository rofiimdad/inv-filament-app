@extends('layout')

@section('content')
<div class="grid grid-cols-8 gap-2">
    <div class=" col-span-6  lg:col-span-4 ">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-3xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Asset Spesifications
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Details Informations
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            Nomor Asset
                        </th>
                        <td class="px-6 py-4">
                            {{$data['asset_number']}}
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            Brand / Merek
                        </th>
                        <td class="px-6 py-4">
                            {{$data['brand_name']}}
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            Seri/Model/Type
                        </th>
                        <td class="px-6 py-4">
                            {{$data['model_number']}}
                        </td>

                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            PIC Assets
                        </th>
                        <td class="px-6 py-4">
                            Gray
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            Apple Watch 5
                        </th>
                        <td class="px-6 py-4">
                            Red
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

