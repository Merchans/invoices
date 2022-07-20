<x-layout>
    <section class="hidden-print max-w-5xl mx-auto bg-white py-4 px-4 w-full flex justify-end">
        <a href="#print"
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mx-1"
            onclick="window.print()" value="Print">Print</a>
    </section>
    <section>
        <div class="max-w-5xl mx-auto bg-white">
            <article class="overflow-hidden">
                <div class="bg-[white] rounded-b-md">
                    <div class="p-9">
                        <div class="space-y-6 text-slate-700 flex">
                            <img class="object-cover h-12"
                                src="https://www.naseandulka.cz/wp-content/uploads/2022/03/andulka-postava-kopie.png" />
                            <p>&nbsp;</p>
                            <p class="text-xl font-extrabold tracking-tight uppercase font-body">
                                {{__('Invoice ' . $invoice->id )}}
                            </p>
                        </div>
                    </div>
                    <div class="p-9">
                        <div class="flex w-full">
                            <div class="grid grid-cols-4 gap-12">
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">
                                        {{ __('Invoice Detail') }}
                                    </p>
                                    <input type="text" id="receiver" name="receiver"
                                        value="{{ $invoice->receiver }}" disabled>
                                    <form name="receiver_form">
                                        <div>
                                            <input type="text" id="receiver_street" name="receiver_street"
                                                class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                disabled value="{{ $receiver['company'] }}">
                                        </div>

                                        <div>
                                            <input type="text" id="receiver_village" name="receiver_village"
                                                class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                disabled value="{{ $receiver['street'] }}">
                                        </div>

                                        <div>
                                            <input type="text" id="receiver_part_of_village"
                                                name="receiver_part_of_village"
                                                class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                disabled value="{{ $receiver['village'] }}">
                                        </div>

                                        <div>
                                            <input type="text" id="receiver_zipcode" name="receiver_zipcode"
                                                class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                disabled value="{{ $receiver['zip_code'] }}">
                                        </div>

                                    </form>

                                </div>
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">Billed To</p>
                                    <input type="text" id="supplier" name="supplier"
                                        value="{{ $invoice->supplier }}">
                                    <form name="supplier_form">

                                        <div>
                                            <input type="text" id="supplier_company" name="supplier_company"
                                                class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="{{$supplier['company']}}">
                                        </div>

                                        <div>
                                            <input type="text" id="supplier_street" name="supplier_street"
                                                class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                disabled value="{{$supplier['street']}}">

                                            <div>
                                                <input type="text" id="supplier_village" name="supplier_village"
                                                    class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    disabled value="{{$supplier['village']}}">
                                            </div>

                                            <div>
                                                <input type="text" id="supplier_part_of_village"
                                                    name="supplier_part_of_village"
                                                    class="dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    disabled value="{{$supplier['zip_code']}}">
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div class="text-sm font-light text-slate-500">
                                <p class="text-sm font-normal text-slate-700">{{ __('Invoice Number') }}</p>
                                <p>{{ $invoice->id }}</p>

                                <p class="mt-2 text-sm font-normal text-slate-700">
                                    {{ __('Date of Issue') }}
                                </p>
                                <p>{{ date('d.m.Y', strtotime($invoice->issue_date)) }}</p>
                            </div>
                            <div class="text-sm font-light text-slate-500">
                                <p class="text-sm font-normal text-slate-700">{{ __('Terms') }}</p>
                                <p>{{ $invoice->terms }} {{__('Days')}}</p>

                                <p class="mt-2 text-sm font-normal text-slate-700">{{ __('Due') }}</p>
                                @php
                                    $date=date_create($invoice->issue_date);
                                    date_add($date,date_interval_create_from_date_string("$invoice->terms days"));
                                @endphp
                                <p>{{  date_format($date, 'd.m.Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-9">
                    <div class="flex flex-col mx-0 mt-8">
                        <table class="min-w-full divide-y divide-slate-500">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0">
                                        {{ __('Description') }}
                                    </th>
                                    <th scope="col"
                                        class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                    </th>
                                    <th scope="col"
                                        class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                        {{ __('Quantity') }}
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-3 pr-4 text-right text-sm font-normal text-slate-700 sm:pr-6 md:pr-0">
                                        {{ __('Amount') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->items as $item)
                                    <tr class="border-b border-slate-200">

                                        <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                            <div class="font-medium text-slate-700">
                                                {{$item->description}}
                                            </div>
                                            <div class="mt-0.5 text-slate-500 sm:hidden">
                                                {{__('1 unit at' . $item->price .' Kč')}}
                                            </div>
                                        </td>
                                        <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                        </td>
                                        <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                            {{$item->quantity}}
                                        </td>
                                        <td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                            {{ $item->price . ' Kč'}}
                                        </td>
                                        @php
                                            $pride_per_row[] = $item->quantity * $item->price;
                                        @endphp
                                    </tr>
                                @endforeach
                                <!-- Here you can write more products/tasks that you want to charge for-->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row" colspan="3"
                                        class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                        {{__('Total')}}
                                    </th>
                                    <th scope="row"
                                        class="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden">
                                        {{__('Total')}}
                                    </th>
                                    <td
                                        class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                        {{collect($pride_per_row)->sum() . ' Kč'}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
        </article>
        </div>
    </section>
</x-layout>
