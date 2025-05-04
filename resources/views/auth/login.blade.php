<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Gereja Katedral Merauke</title>
  <style>
    :root {
      --primary-dark: #2d3748;
      --primary-light: #f8f9fa;
      --accent-gold: #d4af37;
      --accent-burgundy: #800020;
      --accent-burgundy-light: #9a1a33;
      --text-dark: #333;
      --text-light: #f8f9fa;
      --bg-light-gold: rgba(212, 175, 55, 0.1);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }

    body, html {
      height: 100%;
      width: 100%;
      overflow: hidden;
      background-color: var(--primary-dark);
    }

    .container {
      position: relative;
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, var(--primary-dark) 0%, #3d4a5c 100%);
    }

    .login-card {
      width: 900px;
      height: 550px;
      background-color: #fff;
      border-radius: 24px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      display: flex;
    }

    .illustration-side {
      width: 55%;
      background-color: var(--primary-light);
      position: relative;
      padding: 30px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .logo {
      width: 160px;
      height: auto;
    }

    .illustration-container {
      position: relative;
      flex-grow: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px 0;
    }

    .blob-bg {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: var(--bg-light-gold);
      border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
      z-index: 1;
    }

    .church-illustration {
      position: relative;
      z-index: 2;
      width: 80%;
      height: auto;
    }

    .copyright {
      font-size: 0.7rem;
      color: var(--text-dark);
      opacity: 0.7;
      margin-top: 20px;
    }

    .form-side {
      width: 45%;
      background-color: var(--primary-dark);
      background: linear-gradient(150deg, var(--primary-dark) 0%, #384454 100%);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-title {
      color: var(--text-light);
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 30px;
      position: relative;
      padding-bottom: 10px;
    }

    .login-title:after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 40px;
      height: 3px;
      background-color: var(--accent-gold);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      color: var(--text-light);
      margin-bottom: 8px;
      font-weight: 500;
    }

    .form-control {
      width: 100%;
      padding: 12px 15px;
      background-color: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      color: var(--text-light);
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }

    .form-control:focus {
      outline: none;
      border-color: var(--accent-gold);
      background-color: rgba(255, 255, 255, 0.15);
    }

    .forgot-link {
      text-align: right;
      margin-top: 5px;
    }

    .forgot-link a {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.8rem;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .forgot-link a:hover {
      color: var(--accent-gold);
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      background-color: var(--accent-burgundy);
      color: var(--text-light);
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(128, 0, 32, 0.2);
    }

    .login-btn:hover {
      background-color: var(--accent-burgundy-light);
      box-shadow: 0 6px 12px rgba(128, 0, 32, 0.3);
      transform: translateY(-1px);
    }

    .register-link {
      margin-top: 30px;
      text-align: center;
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.9rem;
    }

    .register-link a {
      color: var(--accent-gold);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    .terms-link {
      margin-top: 40px;
      text-align: center;
    }

    .terms-link a {
      color: rgba(255, 255, 255, 0.5);
      font-size: 0.75rem;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .terms-link a:hover {
      color: rgba(255, 255, 255, 0.8);
    }

    .support-text {
      color: rgba(255, 255, 255, 0.5);
      font-size: 0.75rem;
      text-align: center;
      margin-top: 10px;
    }

    @media (max-width: 900px) {
      .login-card {
        width: 95%;
        height: auto;
        flex-direction: column;
      }

      .illustration-side {
        width: 100%;
        padding: 20px;
        order: 1;
      }

      .form-side {
        width: 100%;
        padding: 30px;
        order: 2;
      }

      .illustration-container {
        height: 220px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-card">
      <!-- Illustration Side -->
      <div class="illustration-side">
      
        
        <div class="illustration-container">
          <div class="blob-bg"></div>
          <svg class="church-illustration" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
            <!-- Church Building -->
            <rect x="150" y="130" width="100" height="130" fill="#2d3748" />
            <rect x="145" y="120" width="110" height="10" fill="#2d3748" />
            
            <!-- Cross -->
            <rect x="195" y="30" width="10" height="90" fill="#d4af37" />
            <rect x="175" y="50" width="50" height="10" fill="#d4af37" />
            
            <!-- Tower -->
            <rect x="170" y="90" width="60" height="30" fill="#2d3748" />
            <polygon points="170,90 200,60 230,90" fill="#2d3748" />
            
            <!-- Door -->
            <rect x="185" y="200" width="30" height="60" fill="#800020" rx="15" ry="15" />
            
            <!-- Windows -->
            <rect x="170" y="150" width="20" height="30" fill="#d4af37" rx="10" ry="10" />
            <rect x="210" y="150" width="20" height="30" fill="#d4af37" rx="10" ry="10" />
            <circle cx="200" cy="170" r="15" fill="#d4af37" />
            
            <!-- Holy Spirit -->
            <circle cx="200" cy="110" r="12" fill="#f8f9fa" />
            <path d="M190,105 L200,90 L210,105 L200,120 Z" fill="#f8f9fa" />
            
            <!-- People -->
            <circle cx="160" cy="240" r="10" fill="#333" />
            <rect x="155" y="250" width="10" height="20" fill="#333" />
            
            <circle cx="240" cy="240" r="10" fill="#333" />
            <rect x="235" y="250" width="10" height="20" fill="#333" />
            
            <!-- Additional decorative elements -->
            <circle cx="140" cy="100" r="5" fill="#d4af37" opacity="0.5" />
            <circle cx="260" cy="80" r="8" fill="#d4af37" opacity="0.5" />
            <circle cx="120" cy="200" r="6" fill="#d4af37" opacity="0.5" />
            <circle cx="280" cy="160" r="7" fill="#d4af37" opacity="0.5" />
          </svg>
        </div>
        
        
      </div>
      
      <!-- Form Side -->
      <div class="form-side">
        <h1 class="login-title">Login</h1>
        
        <form method="POST" action="{{ route('login') }}">
          @csrf
          
          <div class="form-group">
            <label for="email" class="form-label">Username</label>
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan username" />
            <x-input-error :messages="$errors->get('email')" class="text-red-500 text-sm mt-1" />
          </div>
          
          <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password" />
            <x-input-error :messages="$errors->get('password')" class="text-red-500 text-sm mt-1" />
          </div>
          
          <div class="forgot-link">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">Forgot Password?</a>
            @endif
          </div>
          
          <button type="submit" class="login-btn">Login</button>
          
        
        </form>
      </div>
    </div>
  </div>
</body>
</html>