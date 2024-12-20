<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
  <title>Cập nhật vấn đề</title>
</head>
<body>
  <h1 style="margin: 50px 50px">Cập nhật thông tin Vấn đề</h1>
  <form action="{{ route('issues.update', $issues->id) }}" method="POST" style="margin: 50px 50px">
    @csrf
    @method('PUT')

    <!-- Người báo cáo -->
    <div class="mb-3">
      <label for="reported_by" class="form-label">Người báo cáo</label>
      <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{ $issues->reported_by }}" required>
    </div>

    <!-- Tên máy tính -->
    <div class="mb-3">
      <label for="computer_id" class="form-label">Tên máy tính</label>
      <select class="form-control" id="computer_id" name="computer_id" required>
        @foreach($computers as $computer)
          <option value="{{ $computer->id }}" {{ $computer->id == $issues->computer_id ? 'selected' : '' }}>
            {{ $computer->computer_name }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Mô tả vấn đề -->
    <div class="mb-3">
      <label for="description" class="form-label">Mô tả vấn đề</label>
      <textarea class="form-control" id="description" name="description" rows="3" required>{{ $issues->description }}</textarea>
    </div>

    <!-- Ngày báo cáo -->
    <div class="mb-3">
      <label for="reported_date" class="form-label">Ngày báo cáo</label>
      <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" value="{{ $issues->reported_date }}" required>
    </div>

    <!-- Mức độ ưu tiên -->
    <div class="mb-3">
      <label for="urgency" class="form-label">Mức độ sự cố</label>
      <select class="form-control" id="urgency" name="urgency" required>
        <option value="Low" {{ $issues->urgency == 'Low' ? 'selected' : '' }}>Low</option>
        <option value="Medium" {{ $issues->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="High" {{ $issues->urgency == 'High' ? 'selected' : '' }}>High</option>
      </select>
    </div>

    <!-- Trạng thái -->
    <div class="mb-3">
      <label for="status" class="form-label">Trạng thái</label>
      <select class="form-control" id="status" name="status" required>
        <option value="Open" {{ $issues->status == 'Open' ? 'selected' : '' }}>Open</option>
        <option value="In Progress" {{ $issues->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
        <option value="Resolved" {{ $issues->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
      </select>
    </div>

    <!-- Nút cập nhật -->
    <button type="submit" class="btn btn-primary">Cập nhật</button>
  </form>
</body>
</html>
