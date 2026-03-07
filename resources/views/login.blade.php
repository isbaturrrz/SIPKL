<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset ('dist_login/css/style.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('small-logo.png') }}">
    
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear,
        input[type="text"]::-ms-reveal,
        input[type="text"]::-ms-clear {
            display: none !important;
        }

        input[type="password"]::-webkit-contacts-auto-fill-button,
        input[type="password"]::-webkit-credentials-auto-fill-button,
        input[type="text"]::-webkit-contacts-auto-fill-button,
        input[type="text"]::-webkit-credentials-auto-fill-button {
            visibility: hidden !important;
            display: none !important;
            pointer-events: none !important;
            height: 0 !important;
            width: 0 !important;
            margin: 0 !important;
        }

        .password-input {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            z-index: 10;
            padding: 5px;
            color: #6c757d;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #1e4179;
        }

        .toggle-password:focus {
            outline: none;
            box-shadow: none;
        }

        .password-input .form-control {
            padding-right: 45px;
        }
    </style>
</head>
<body>
    <div class="container login_card">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card">
                    <div class="card-body p-5 padding_card">
                        <div class="text-center mb-4 main-logo">
                            <figure><img src="{{ asset ('dist_login/img/logo.png')}}" alt="Logo"></figure>
                        </div>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login.proses') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3 email">
                                <label for="email" class="form-label">Username atau Email</label>
                                <div class="input-group username-input">
                                    <span class="input-group-text icon-1"><i class="fas fa-user"></i></span>
                                    <input value="{{ old('email') }}" type="text" class="form-control input-id" 
                                        placeholder="Masukan Username atau Email" id="email" name="email" required autofocus>
                                </div>
                            </div>
                            
                            <div class="mb-4 password">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group password-input">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" 
                                        placeholder="Masukan Password" name="password" required>
                                    <button type="button" class="toggle-password" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="d-grid mb-3 btn-login">
                                <button type="submit" class="btn btn-primary btn-lg"> 
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>
                        </form>       
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>