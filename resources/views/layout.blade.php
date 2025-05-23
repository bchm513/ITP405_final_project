<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>@yield('title')</title>
  <style>
    body {
      margin: 0;
      padding-top: 60px; /* Space for fixed navbar */
    }
    .form-control {
      margin-top: 1rem;
    }
    button {
      margin-top: 1rem;
    }
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: #333;
      color: white;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      z-index: 1000;
    }
    .navbar-links a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="navbar-title">ITP 405 Final Project</div>
    <div class="navbar-links">
      <a href={{ route('recipe-home') }}>All Recipes</a>
      <a href={{ route('categoryList') }}>Categories</a> 
      <a href={{ route('chefList') }}>Chefs</a> 
      @if (!Auth::user()) 
        <a href={{ route('signup') }}>Sign up</a>
        <a href={{ route('login') }}>Login</a>
      @else 
        <a href={{ route('profile') }}>Profile</a>
      @endif
    </div>
  </nav>
  <div>
    @yield('main')
  </div>
</body>
</html>