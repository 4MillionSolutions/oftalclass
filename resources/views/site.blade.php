<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OftalClass</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #ffffff;
      color: #333;
    }
    .navbar {
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .navbar-brand {
      color: #005a9c;
      font-weight: bold;
    }
    .navbar-brand span {
      color: #f7931e;
    }
    .hero {
      padding: 60px 0;
      text-align: center;
    }
    .hero h1 {
      color: #005a9c;
      font-weight: bold;
    }
    .btn-orange {
      background-color: #f7931e;
      border: none;
      color: white;
    }

    .btn-orange:hover {
      background-color: #be6c0d;
      border: none;
      color: white;
    }

    .products {
      padding: 60px 0;
    }
    .products h2, .indications h2 {
      color: #005a9c;
      font-weight: bold;
    }
    .product-card {
      border: 1px solid #eee;
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .product-card img {
      max-width: 100%;
      height: 150px;
      object-fit: contain;
    }
    .indications {
      background-color: #f8f9fa;
      padding: 40px 0;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <img src="{{ asset('img/img_logo.png')}}" alt="Logo" style="width: 34px; height: 31px;">
      <a class="navbar-brand" href="#">Oftal<span>Class</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-primary" href="/indicacoes">Indicações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-orange text-white ms-2" href="/login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="hero">
    <div class="container">
      <h1>Encontre seus Óculos Ideais</h1>
      <p class="lead">Estilo e conforto para sua visão.</p>
      <img src="{{ asset('img/logo.png')}}" alt="Óculos" class="img-fluid">
    </div>
  </section>

  <section class="products text-center" id="produtos">
    <div class="container">
      <h2>Nossos Óculos</h2>
      <div class="row mt-4">
        <div class="col-md-4">
          <div class="product-card">
            <img src="{{asset('img/oculos_elegance.png')}}" alt="Óculos Elegance">
            <h5>Óculos Elegance</h5>
            <p>Design moderno e alta qualidade.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product-card">
            <img src="{{asset('img/oculos_classic.png')}}" alt="Óculos classic">
            <h5>Óculos Classic</h5>
            <p>Conforto e estilo para o dia a dia.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product-card">
            <img src="{{asset('img/oculos_sport.png')}}" alt="Óculos Sport">
            <h5>Óculos Sport</h5>
            <p>Resistência para práticas esportivas.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="indications text-center" id="indicacoes">
    <div class="container">
      <h2>Indicações</h2>
      <ul class="list-unstyled">
        <li>Cadastre-se, nos indique e ganhe cashback!</li>   
        <a href="/indicacoes" class="btn btn-orange text-white mt-3">Indicar</a>  

      </ul>
    </div>
  </section>

  <section class="hero" id="login">
    <div class="container">
      <h2>Entre em contato!</h2>
      <p class="lead">Estamos na rua </p>
      <p class="lead">Telefones:(11) 3549-5622 </p>
      <p class="lead">Telefones:(11) 99858-1585 
      {{-- Link do whatssApp  --}}
      <a href="https://api.whatsapp.com/send?phone=5511999999999" target="_blank"><i class="fab fa-whatsapp text-success"></i> </a>
        
      </p> 

      
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>