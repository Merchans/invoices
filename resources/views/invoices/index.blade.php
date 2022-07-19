<x-layout>

    <div class="overflow-x-auto relative sm:rounded-lg">
        <div class="flex justify-end">
        <a href="{{route('invoice.create')}}"
            class="inline-block text-center	 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 m-4 border border-blue-500 hover:border-transparent rounded mx-1">{{__('Create invoice')}}</a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 shadow-md">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        {{__('Receiver')}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{__('Supplier')}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{__('Amount')}}
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        {{__('Action')}}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $invoice->receiver }}
                        </th>
                        <td class="py-4 px-6">
                            {{ $invoice->supplier }}
                        </td>
                        <td class="py-4 px-6">
                            @foreach ($invoice->items as $item)
                                @php
                                    $multiple = $item->quantity * $item->price;
                                    $sum[] = $multiple;
                                @endphp
                            @endforeach
                            {{ array_sum($sum) }} Kč
                            @php
                                unset($sum);
                            @endphp
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('invoice.show', ['id' => $invoice->id]) }}" class="font-medium text-green-600 dark:text-green-500 hover:underline">{{__('Print')}}</a> |
                            <a href="{{ route('invoice.edit', ['id' => $invoice->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Edit')}}</a> |
                            <form action="{{route('invoice.destroy', ['id' => $invoice->id] )}}" method="POST" class="inline-block" onSubmit="return confirm('{{__('Are you sure?')}}')" >
                                @csrf
                                @method('DELETE')
                                <button class="font-medium text-red-600 dark:text-red-500 hover:underline" >{{__('Delete')}}</button>
                            </form>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>   

</x-layout>