<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $detail->name }}</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
  <main>
    <div class="container mt-3">
      <div class="row">
        <div class="col-12">
          <h1>{{ $detail->name }}</h1>
          <h4 class="text-muted">{{ $detail->keywords }}</h4>
        </div>
      </div>
      <div class="line my-3">&nbsp;</div>
      <div class="row">
        <div class="col-12">
          <h3>Profile</h3>
          <p>{{ $detail->description }}</p>
        </div>
      </div>
      <div class="line mb-3">&nbsp;</div>
      <div class="row">
        <div class="col-6">
          <h3>Info</h3>
          <h5>Email</h5>
          <p>{{ $detail->email }}</p>
          <h5>Phone</h5>
          <p>{{ $detail->phone }}</p>
          <h5>Address</h5>
          <p>{{ $detail->address }}</p>
          <h5>Links</h5>
          <ul>
            @foreach ($detail->links as $link)
              <li><a href="{{ $link }}">{{ $link }}</a></li>
            @endforeach
          </ul>
          <h3>Skills</h3>
          <ul>
            @foreach ($detail->skills as $skill)
              <li>{{ $skill }}</li>
            @endforeach
          </ul>
        </div>
        <div class="col-6">
          <h3>Work Experiences</h3>
          <div>
            <p class="mb-0"><b>Nama Posisi, Nama PT</b></p>
            <p class="mb-0">2021-2025</p>
            <ul>
              <li>Description</li>
              <li>Description</li>
              <li>Description</li>
            </ul>
          </div>
          <div>
            <p class="mb-0"><b>Nama Posisi, Nama PT</b></p>
            <p class="mb-0">2021-2025</p>
            <ul>
              <li>Description</li>
              <li>Description</li>
              <li>Description</li>
            </ul>
          </div>
          <div>
            <p class="mb-0"><b>Nama Posisi, Nama PT</b></p>
            <p class="mb-0">2021-2025</p>
            <ul>
              <li>Description</li>
              <li>Description</li>
              <li>Description</li>
            </ul>
          </div>
          <h3>Education</h3>
          <div>
            <p class="mb-0"><b>Nama Jurusan, Instansi</b></p>
            <p class="mb-0">2021-2025</p>
          </div>
          <div>
            <p class="mb-0"><b>Nama Jurusan, Instansi</b></p>
            <p class="mb-0">2021-2025</p>
          </div>
          <div>
        </div>
      </div>
    </div>
  </main>
  <footer class="text-center fixed-bottom">
    <span class="text-muted">Created using Jobsfree's Resume maker chatbot.</span>
  </footer>

  <script>
    // window.print();
  </script>
</body>
</html>