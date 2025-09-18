<!doctype html><html><head><meta charset="utf-8"><title>Edit Plan</title></head><body>
  <h2>Edit Plan</h2>
  <form method="POST" action="{{ route('admin.plans.update', $plan->id) }}">
    @csrf @method('PUT')
    <label>Name</label><input name="name" required value="{{ old('name', $plan->name) }}">
    <label>Price</label><input name="price" required type="number" step="0.01" value="{{ old('price', $plan->price) }}">
    <label>Duration (minutes)</label><input name="duration_minutes" required type="number" value="{{ old('duration_minutes', $plan->duration_minutes) }}">
    <label>Speed limit (kbps) optional</label><input name="speed_limit" type="number" value="{{ old('speed_limit', $plan->speed_limit) }}">
    <div><button type="submit">Save</button> <a href="{{ route('admin.plans.index') }}">Cancel</a></div>
  </form>
</body></html>
