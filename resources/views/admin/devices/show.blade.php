<!doctype html><html><head><meta charset="utf-8"><title>Device #{{ $device->id }}</title></head><body>
  <h2>Device {{ $device->mac_address }}</h2>
  <p>Name: {{ $device->device_name }}</p>

  <h3>Subscriptions</h3>
  @foreach($device->subscriptions as $s)
    <div style="padding:8px;border:1px solid #ddd;margin-bottom:8px">
      <strong>{{ $s->plan->name ?? '—' }}</strong><br>
      Status: {{ $s->status }}<br>
      {{ $s->start_time }} → {{ $s->end_time }}
    </div>
  @endforeach

  <form method="POST" action="{{ route('admin.devices.block', $device->id) }}">
    @csrf
    <button>Block (expire)</button>
  </form>

  <a href="{{ route('admin.devices.index') }}">Back</a>
</body></html>
