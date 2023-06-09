{{-- <x-layout title="Login"> 
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-primary mt-3">
            Entrar
        </button>
        <a href="{{ route('users.create') }}" class="btn btn-secondary mt-3">
            Registrar
       </a>
    </form>
</x-layout> --}}

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página de Login - Séries</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->


            <!-- Login Form -->
            <form method="post">
                @csrf
                <input type="text" id="login" class="fadeIn second" name="email" placeholder="login">
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Log In">
              
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">

                <a class="underlineHover" href="#">Esqueceu a Senha ?</a>
                <a id="forgot" href="{{ route('users.create') }}" class="underlineHover">
                    Cadastre-se
                </a>
            </div>

        </div>

    </div>

</body>

</html>
