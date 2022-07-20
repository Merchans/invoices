let firstInvoiceItem = document.getElementById('invoice-item');
let template = firstInvoiceItem.cloneNode(true);

function addRow() {
    let copy = template.cloneNode(true);
    let input = copy.getElementsByTagName("input")

    document.getElementById('invoice-items').appendChild(copy);
    input[0].value = "";
    input[1].value = "";
    input[2].value = "";
    input[0].focus();

    input.forEach(removeValue);
}

function remove(el) {
    let item = el.parentNode.parentNode;
    console.log(item);
    item.parentNode.removeChild(item);
}