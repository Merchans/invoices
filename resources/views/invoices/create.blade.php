<x-layout>
  
<form class="p-8" method="POST" action="{{{route('invoice.store')}}}" name="create_invoice">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="receiver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Receiver')}}</label>
            <input type="text" minlength="8" maxlength="8" id="receiver" name="receiver" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="IČO: 45274649" autofocus value="{{old('receiver')}}" onchange="get_receiver_ICO()">
            <p id="status" class="text-green-500 text-xs mt-1"></p>
            @error('receiver')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Supplier')}}</label>
            <input type="text" minlength="8" maxlength="8" id="supplier" name="supplier" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="IČO: 00177041"  value="{{old('supplier')}}" onchange="get_supplier_ICO()" >
            @error('supplier')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

    </div>
    <div class="mb-6">
        <label for="issue_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Date of Issue')}}
            <input  type="date" name="issue_date" id="issue_date" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{date('Y-m-d')}}" placeholder="Select date">
        </label>
        @error('issue_date')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="terms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Terms')}}</label>
        <input type="number" min="1" id="terms" name="terms" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000 Kč"  
        value="15">
        @error('terms')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
    </div>
    <div id="invoice-items">
        @if (old('descriptions') || old('quantities') || old('price_per_units'))
            @for ($i = 0; $i < count(old('descriptions')); $i++)
            <div class="grid gap-6 mb-6 md:grid-cols-8" id="invoice-item">
                <div class="col-span-3">
                    
                    @if ($description = old('descriptions')[$i])
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Description')}}
                                <input type="text" name="descriptions[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{__('Cleaning of apartment complexes')}}" autofocus value="{{$description}}">
                            </label>
                    @else
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Description')}}
                        <input type="text" name="descriptions[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{__('Cleaning of apartment complexes')}}">
                    </label>
                    @error($description)
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    @endif
                </div>
                <div class="col-span-2">
                    @if ($quantity = old('quantities')[$i])
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Quantity')}}
                                <input type="number" min="1" name="quantities[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="50 h"  
                                value="{{$quantity}}">
                            </label>
                    @else
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Quantity')}}
                            <input type="number" min="1" name="quantities[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="50 h">
                        </label>
                        @error($quantity)
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    @endif
                </div>
                <div class="col-span-2">
                    @if ($price_per_unit = old('price_per_units')[$i])
                            <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Price per unit')}}
                                <input type="number" min="1" name="price_per_units[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000 Kč" 
                                value="{{ $price_per_unit }}" >
                            </label>
                    @else
                    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Price per unit')}}
                        <input type="number" min="1" name="price_per_units[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000 Kč" >
                    </label>
                    @error($price_per_unit)
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    @endif
                </div>
                <div class="col-span-1 flex justify-end items-center mt-5">
                        <span class="remove" onclick="remove(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                <path strokeLinecap="round" strokeLinejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            </span>
                </div>
        </div>
            @endfor
        @else
        <div class="grid gap-6 mb-6 md:grid-cols-8" id="invoice-item">
            <div class="col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Description')}}
                            <input type="text" name="descriptions[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{__('Cleaning of apartment complexes')}}" >
                        </label>
                
            </div>
            <div class="col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Number')}}
                        <input type="number" min="1" name="quantities[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="50 h">
                    </label>
            </div>
            <div class="col-span-2">
                <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Price per unit')}}
                    <input type="number" min="1" name="price_per_units[]" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000 Kč" >
                </label>

            </div>
            <div class="col-span-1 flex justify-end items-center mt-5">
                <span class="remove" onclick="remove(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    </span>
            </div>
        </div>
        @endif
    </div>
    <span class="add" onclick="addRow()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
    </span>
    <div class="flex flex-row-reverse">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{__('Make invoice')}}</button>
    </div>
</form>

<div action="" class="grid gap-6 mb-6 md:grid-cols-2">
    <form name="receiver_form">
        <div>
            <label for="receiver_company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Name Ltd.')}}</label>
            <input type="text" id="receiver_company" name="receiver_company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ČEZ, a. s." disabled>
        </div>  
 
        <div>
            <label for="receiver_street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Street')}}</label>
            <input type="text" id="receiver_street" name="receiver_street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Duhová 1444/2" disabled>
        </div>
  
        <div>
            <label for="receiver_village" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Village')}}</label>
            <input type="text" id="receiver_village" name="receiver_village" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mladá Boleslav" disabled>
        </div> 

        <div>
            <label for="receiver_part_of_village" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Part of the village')}}</label>
            <input type="text" id="receiver_part_of_village" name="receiver_part_of_village" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mladá Boleslav II" disabled>
        </div>      

        <div>
            <label for="receiver_zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Zip code')}}</label>
            <input type="text" id="receiver_zipcode" name="receiver_zipcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="14000" disabled>
        </div>

        <div>
            <label for="receiver_tax_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Tax id')}}</label>
            <input type="text" id="receiver_tax_id" name="receiver_tax_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="CZ45274649" disabled>
        </div>

        <div>
            <label for="receiver_village_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Village code')}}</label>
            <input type="text" id="receiver_village_code" name="receiver_village_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="500119" disabled>
        </div>
 
        <div>
            <label for="receiver_district_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('District code')}}</label>
            <input type="text" id="receiver_district_code" name="receiver_district_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="535419" disabled>
        </div>

        <div>
            <label for="receiver_creation_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Date of creation')}}</label>
            <input type="text" id="receiver_creation_date" name="receiver_creation_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1992-05-06" disabled>
        </div>
    </form>
    <form name="supplier_form">
 
    <div>
        <label for="supplier_company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Name Ltd.')}}</label>
        <input type="text" id="supplier_company"  name="supplier_company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ŠKODA AUTO a.s." disabled>
    </div>  

    <div>
        <label for="supplier_street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Street')}}</label>
        <input type="text" id="supplier_street" name="supplier_street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="tř. Václava Klementa 869" disabled >

    <div>
        <label for="supplier_village" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Village')}}</label>
        <input type="text" id="supplier_village" name="supplier_village"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Praha" disabled>
    </div>
     
    <div>
        <label for="supplier_part_of_village" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Part of the village')}}</label>
        <input type="text" id="supplier_part_of_village" name="supplier_part_of_village"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Michle (Praha 4)" disabled>
    </div>

    <div>
        <label for="supplier_zipcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Zip code')}}</label>
        <input type="text" id="supplier_zipcode" name="supplier_zipcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="29301" disabled>
    </div>

    <div>
        <label for="supplier_tax_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Tax id')}}</label>
        <input type="text" id="supplier_tax_id" name="supplier_tax_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="CZ00177041" disabled>
    </div>

    <div>
        <label for="supplier_village_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Village code')}}</label>
        <input type="text" id="supplier_village_code" name="supplier_village_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="535419" disabled>
    </div>

    <div>
        <label for="supplier_district_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('District code')}}</label>
        <input type="text" id="supplier_district_code" name="supplier_district_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="CZ0207" disabled>
    </div>

    <div>
        <label for="supplier_creation_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__('Date of creation')}}</label>
        <input type="text" id="supplier_creation_date" name="supplier_creation_date" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1990-11-13" disabled>
    </div>
    </form>
</div>

<script>

    let firstInvoiceItem = document.getElementById('invoice-item');
    let template = firstInvoiceItem.cloneNode(true);

    function addRow() {
        let copy = template.cloneNode(true);

        document.getElementById('invoice-items').appendChild(copy);
        copy.getElementsByTagName("input")[0].focus();
    }

    function remove(el) {
    let item = el.parentNode.parentNode;
    console.log(item);
    item.parentNode.removeChild(item);
}
</script>
</x-layout>

