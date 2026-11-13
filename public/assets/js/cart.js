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