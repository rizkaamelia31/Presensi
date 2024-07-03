<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Magang Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .divider:after,
      .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
      }
      .footer-text {
        color: white;
      }
      /* body {
        background-color: blue;
      } */
    </style>
  </head>
  <body class="d-flex flex-column vh-100">
    <section class="flex-grow-1">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-4 pt-3 ps-2">
            <img src="{{ asset('assets/img/LOGO4A.png') }}"
              class="img-fluid" alt="Phone image">
          </div>
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <form action="{{ route('login') }}" method="post">
              @csrf
              <h4 class="mb-4 text-right">Silahkan Masuk Menggunakan Akun Anda 👋</h4>
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form1Example13">Email address</label>
                <input type="email" id="form1Example13" class="form-control form-control-lg" name="email"/>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
    
              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form1Example23">Password</label>
                <input type="password" id="form1Example23" class="form-control form-control-lg" name="password"/>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

              <!-- Submit button -->
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
              </div>
              <div class="d-flex justify-content-around align-items-center mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                  <label class="form-check-label" for="form1Example3"> Ingatkan saya </label>
                {{-- </div>
                <a href="#!">Lupa Kata Sandi</a>
              </div> --}}
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer -->
    <footer class="text-center py-3 bg-primary">
      <div class="container">
        <span class="footer-text">Universitas Alma Ata 2024 Rizka Amelia - 203200117</span>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
