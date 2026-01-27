<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset ('dist_login/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container login_card">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card">
                    <div class="card-body p-5 padding_card">
                        <div class="text-center mb-4 main-logo">
                            <figure><img src="#" alt="Logo" style="max-width: 100px;"></figure>
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
                                <label for="email" class="form-label">NIPD / Email</label>
                                <div class="input-group username-input">
                                    <span class="input-group-text icon-1"><i class="fas fa-user"></i></span>
                                    
                                    <input value="{{ old('email') }}" type="text" class="form-control input-id" 
                                           placeholder="Masukan NIPD atau Email" id="email" name="email" required>
                                </div>
                            </div>
                            
                            <div class="mb-4 password">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group password-input">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" 
                                           placeholder="Masukan Password" name="password" required>
                                </div>
                            </div>
                            
                            <div class="d-grid mb-3 btn-login">
                                <button type="submit" class="btn btn-primary btn-lg"> <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>
                        </form>        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>