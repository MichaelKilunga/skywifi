<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Plans</title></head>
<body>
  <h2>Internet Plans <a href="{{ route('admin.plans.create') }}">+ New</a></h2>

  @if(session('success')) <div style="color:green">{{ session('success') }}</div> @endif

  <table border="1" cellpadding="8" cellspacing="0">
    <thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Duration (min)</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($plans as $p)
      <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ number_format($p->price,2) }}</td>
        <td>{{ $p->duration_minutes }}</td>
        <td>
          <a href="{{ route('admin.plans.edit', $p->id) }}">Edit</a>
          <form action="{{ route('admin.plans.destroy', $p->id) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Delete?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $plans->links() }}
</body>
</html>
