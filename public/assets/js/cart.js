document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click',async()=> {
        button.disabled = true;
        const response = await fetch('/api/cart.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({action: 'add', product_id: button.dataset.id})
        });
        const data = await response.json();
        if(data.success){
            document.querySelector('#cart-count').textContent = data.cart_count;
        }else{
            alert(data.error);
        }
        button.disabled = false;
    });
})
async function sendCart(body){
    const response = await fetch('/api/cart.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(body)
    });
    return response.json();
}
function showTotals(data){
    const count = document.querySelector('#cart-count');
    if (count) count.textContent = data.cart_count;
    const subtotal = document.querySelector('#cart-subtotal');
    if (subtotal) subtotal.textContent = '$' + Number(data.subtotal).toFixed(2);
    const tax = document.querySelector('#cart-tax');
    if(tax) tax.textContent = '$' + Number(data.tax).toFixed(2);
    const total = document.querySelector('#cart-total');
    if(total) total.textContent = '$' + Number(data.total).toFixed(2);
    if(data.cart_count === 0){
        location.reload();
    }   
}
document.querySelectorAll('.remove-item').forEach(button => {
    button.addEventListener('click',async() => {
        const data = await sendCart({action: 'remove', product_id: button.dataset.id});
        button.closest('tr').remove();
        showTotals(data);
    });
});
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('change', async () => {
        const data = await sendCart({
            action: 'update',
            product_id: input.dataset.id,
            quantity: Number(input.value)
        });

        if (!data.success) {
            alert(data.error);
            return;
        }
        const row = input.closest('tr');
        const lineTotal = row.querySelector('.line-total');
        lineTotal.textContent = '$' + (Number(input.dataset.price) * Number(input.value)).toFixed(2);

        showTotals(data);
    });
});
