const receiver = document.getElementById('receiver');
const supplier = document.getElementById('supplier');

function get_receiver_ICO() {
    const receiver = document.getElementById('receiver');
    
    console.log(receiver.innerHTML);
    add_ico_script(receiver);
}

function get_supplier_ICO() {    
    const supplier = document.getElementById('supplier');
    console.log(supplier);
    add_ico_script(supplier);
}


function add_ico_script(data) {

    value = data.value;

    if (value.length != 8) console.log('IČO musí mít délku 8 znaků');
    script_url = 'https://data.kurzy.cz/json/subject/' + value.substring(6, 8) + '/' + value.substring(4, 6) + '/' + value + '.js';

    sload(script_url) ;
}

function ico_back(data) {
    
    if (!data || data.count == 0) return message('IČO nebylo nalezeno', 'error');

    form_receiver = document.forms['receiver_form']
    form_supplier = document.forms['supplier_form']


    if(data.id == document.getElementById('receiver').value) {

        for (i = 0; i < form_receiver.length; i++) {
            f = form_receiver[i]
            field_name = f.name        
                field_names = {
                    'receiver': 'id',
                    'receiver_company': 'name',
                    'receiver_street': 'addr_main.street',
                    'receiver_village': 'addr_main.city',
                    'receiver_part_of_village': 'addr_main.citypart',
                    'receiver_zipcode': 'addr_main.zip',
                    'receiver_tax_id': 'vat.id',
                }
            
    
            field_name = field_names[field_name]
    
            sourcevalue = eval('data.' + field_name + '')
    
            if (sourcevalue) {
                f.value = sourcevalue
            }
        }
    }

    if(data.id == document.getElementById('supplier').value) {
        for (i = 0; i < form_supplier.length; i++) {
            f = form_supplier[i]
            field_name = f.name
    
            if (!field_name.includes('supplier')) {
                continue;
            }
            
                field_names = {
                    'supplier': 'id',
                    'supplier_company': 'name',
                    'supplier_street': 'addr_main.street',
                    'supplier_village': 'addr_main.city',
                    'supplier_part_of_village': 'addr_main.citypart',
                    'supplier_zipcode': 'addr_main.zip',
                    'supplier_tax_id': 'vat.id',
                }
            
    
            field_name = field_names[field_name]
    
            sourcevalue = eval('data.' + field_name + '')
    
            if (sourcevalue) {
                f.value = sourcevalue
            }
        }
    }


    message('Načteno ' + data.name + '.')
}


function sload(src) {

    var head = document.getElementsByTagName("head")[0];
    
    var s = document.createElement('script');
    
    s.type = 'text/javascript'; s.src = src; head.appendChild(s);



}


function message(msg, type = null) {
    try {
        document.getElementById('status').innerHTML = msg;
        if (type){
            document.getElementById("status").classList.add('text-red-500');
            document.getElementById("status").classList.remove('text-green-500');
        } else {
            document.getElementById("status").classList.add('text-green-500');
            document.getElementById("status").classList.remove('text-red-500');
        }
    } catch (e) {

    }
}
get_receiver_ICO();
get_supplier_ICO();