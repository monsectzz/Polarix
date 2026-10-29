<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Polarix - First Functional Flow</title>
    <style>
        body{font-family:Arial,sans-serif;max-width:760px;margin:40px auto;padding:0 20px;background:#f4f7fb;color:#172033}
        main{background:white;padding:28px;border-radius:14px;box-shadow:0 8px 30px #17203318} form{display:grid;gap:12px;max-width:420px}
        input,button{padding:11px;border:1px solid #ccd5e3;border-radius:7px;font-size:1rem} button{background:#2563eb;color:white;border:0;cursor:pointer}
        #sale-panel{display:none;margin-top:28px;border-top:1px solid #e3e8f0;padding-top:22px}.message{margin-top:15px;padding:10px;border-radius:7px;background:#eef5ff}
    </style>
</head>
<body>
<main>
    <h1>Polarix</h1>
    <p>First functional flow: sign in, register a sale, and update inventory.</p>
    <section id="login-panel">
        <h2>Sign in</h2>
        <form id="login-form">
            <input name="email" type="email" placeholder="Email" value="employee@polarix.test" required>
            <input name="password" type="password" placeholder="Password" value="Polarix123!" required>
            <button>Sign in</button>
        </form>
    </section>
    <section id="sale-panel">
        <h2>Register sale</h2>
        <form id="sale-form">
            <input name="product_id" type="number" min="1" value="1" placeholder="Product ID" required>
            <input name="quantity" type="number" min="1" value="1" placeholder="Quantity" required>
            <input name="payment" type="number" min="0" step="0.01" value="20.00" placeholder="Payment received" required>
            <button>Confirm sale</button>
        </form>
    </section>
    <div id="message" class="message" role="status">Use the demo credentials to begin.</div>
</main>
<script>
const message = document.querySelector('#message');
const show = value => message.textContent = value;
document.querySelector('#login-form').addEventListener('submit', async event => {
    event.preventDefault(); const data = Object.fromEntries(new FormData(event.target));
    const response = await fetch('api/login.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data)});
    const result = await response.json(); if (!response.ok) return show(result.error);
    document.querySelector('#login-panel').style.display = 'none'; document.querySelector('#sale-panel').style.display = 'block'; show(`Signed in as ${result.user.name}.`);
});
document.querySelector('#sale-form').addEventListener('submit', async event => {
    event.preventDefault(); const data = Object.fromEntries(new FormData(event.target));
    const response = await fetch('api/sales.php', {method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify({items:[{product_id:Number(data.product_id),quantity:Number(data.quantity)}],payment:Number(data.payment)})});
    const result = await response.json(); show(response.ok ? `Sale #${result.sale_id} saved and stock updated.` : result.error);
});
</script>
</body>
</html>
