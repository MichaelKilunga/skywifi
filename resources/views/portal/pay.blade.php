<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pay & Connect</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:sans-serif;padding:20px;background:#0f172a;color:#e6eef8}
    .card{max-width:720px;margin:24px auto;padding:18px;border-radius:12px;background:#081227}
    .btn{display:inline-block;padding:10px 14px;border-radius:8px;background:#22c55e;color:#042014;text-decoration:none;font-weight:700}
    input,select{width:100%;padding:10px;border-radius:8px;margin:8px 0;background:#071726;color:#fff;border:1px solid #123041}
  </style>
</head>
<body>
  <div class="card">
    <h2>Confirm payment for subscription</h2>

    <p><strong>Plan:</strong> {{ $subscription->plan->name ?? '—' }} — {{ number_format($subscription->plan->price, 2) }} TZS</p>
    <p><strong>Device MAC:</strong> {{ $subscription->device->mac_address ?? '—' }}</p>

    <form method="POST" action="{{ url('/api/payments/checkout') }}" id="payForm">
      @csrf
      <input type="hidden" name="plan_id" value="{{ $subscription->internet_plan_id }}">
      <input type="hidden" name="client_mac" value="{{ $subscription->device->mac_address }}">
      <label>Phone (M-Pesa/TigoPesa/Airtel)</label>
      <input name="phone" placeholder="07XXXXXXXX" required>
      <label>Payment provider</label>
      <select name="provider">
        <option value="mpesa">M-Pesa</option>
        <option value="tigopesa">TigoPesa</option>
        <option value="airtel">Airtel Money</option>
      </select>

      <div style="margin-top:14px">
        <button type="submit" class="btn">Start payment</button>
      </div>
    </form>

    <div id="status" style="margin-top:12px;color:#9fb4d0"></div>
  </div>

  <script>
    document.getElementById('payForm').addEventListener('submit', async function (e) {
      e.preventDefault();
      const form = e.target;
      const body = {
        plan_id: form.plan_id.value,
        client_mac: form.client_mac.value,
        phone: form.phone.value,
        provider: form.provider.value
      };
      document.getElementById('status').textContent = 'Starting checkout...';

      const res = await fetch('/api/payments/checkout', {
        method: 'POST', headers: {'Content-Type': 'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
        body: JSON.stringify(body)
      });

      if (!res.ok) {
        document.getElementById('status').textContent = 'Checkout failed.';
        return;
      }

      const j = await res.json();
      document.getElementById('status').textContent = 'Checkout started. Waiting for payment confirmation...';

      // poll
      const tick = async () => {
        const s = await fetch('/api/payments/checkout/' + j.checkout_id);
        if (!s.ok) return setTimeout(tick, 1500);
        const meta = await s.json();
        if (meta.status === 'successful') return window.location = meta.redir || '/portal/success';
        if (meta.status === 'failed') return document.getElementById('status').textContent = 'Payment failed';
        setTimeout(tick, 1500);
      };
      tick();
    });
  </script>
</body>
</html>
