<!DOCTYPE html>
<html>
<head>
    <title>Favorites</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
  <!-- NAV -->
  <div class="preloader-wrapper">
    <div class="preloader">
    </div>
  </div>

  <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch"
    aria-labelledby="Search">
    <div class="offcanvas-header justify-content-center">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

      <div class="order-md-last">
        <h4 class="text-primary text-uppercase mb-3">
          Search
        </h4>
        <div class="search-bar border rounded-2 border-dark-subtle">
          <form id="search-form" class="text-center d-flex align-items-center" action="" method="">
            <input type="text" class="form-control border-0 bg-transparent" placeholder="Search Here" />
            <iconify-icon icon="tabler:search" class="fs-4 me-3"></iconify-icon>
          </form>
        </div>
      </div>
    </div>
  </div>

  <header>
    <div class="container py-2">
      <div class="row py-4 pb-0 pb-sm-4 align-items-center">

        <div class="col-sm-6 col-lg-4 d-none d-lg-block">
          <div class="search-bar border rounded-2 px-3 border-dark-subtle">
            <form id="search-form" class="text-center d-flex align-items-center" action="" method="">
              <input type="text" class="form-control border-0 bg-transparent"
              placeholder="Your Gateway to Art: Begin Your Search Here." />
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
              </svg>
            </form>
          </div>
        </div>
        
        <div class="col-sm-4 col-lg-4 text-center text-sm-start">
          <div class="main-logo">
            <a href="index.html">
              <img src="{{ asset('image/JISOONlogo.png') }}" alt="logo" class="logo img-fluid">
            </a>
          </div>
        </div>
        <div class="col-sm-4 col-lg-4 text-sm-start">
            <div class="pull-right">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="nav-link header-text float-end">Home</a>
                    </li>
                </ul>
                <!-- @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-3">
                        <p>{{ $message }}</p>
                    </div>
                @endif -->
            </div>
        </div>
                
      </div>
    </div>
  </header>

    <div class="container">
        <h1 class="text-center mb-5">Your Favorites</h1>
        <div class="row">
            @foreach ($favorites as $favorite)
            <div class="col-md-4">
                <div class="card artwork-container">
                    <img src="{{ asset('images/' . $favorite->artwork->image) }}" class="card-img-top" alt="{{ $favorite->artwork->title }}">
                    <div class="artwork-details">
                        <h5 class="card-title">{{ $favorite->artwork->title }}</h5>
                        <p class="card-text">{{ $favorite->artwork->medium }}</p>
                        <p class="card-text">₱{{ number_format($favorite->artwork->price, 2) }}</p>
                        <form action="{{ route('artworks.unfavorite', $favorite->artwork->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Remove from Favorites</button>
                        </form>
                        <form action="{{ route('addToCart', $favorite->artwork->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>