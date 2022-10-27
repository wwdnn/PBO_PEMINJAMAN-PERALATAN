<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin Template · Bootstrap v5.2</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    
  <main class="form-signin w-100 m-auto">
    <form action="/login" method="post">
      @csrf
      <div class="form-floating mb-4">
        <input type="text" name="nim-nidn" class="form-control" id="floatingInput" autofocus required>
        <label for="floatingInput">NIM/NIDN</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
    </form>
  </main>
  </body> 
</html>
