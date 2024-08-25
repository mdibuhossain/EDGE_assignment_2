<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 250px;
            margin: 0 auto;
            margin-top: 100px;
        }

        input {
            margin-bottom: 10px;
            border-radius: 10px;
            outline: none;
            border: 0.5px solid black;
            padding: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        p {
            margin-top: 5px;
        }

        .error_msg {
            color: white;
            background: red;
            border-radius: 10px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <form id="loginForm">
        {{-- <form action="{{ route('login') }}" method="post"> --}}
        {{-- @csrf --}}
        <h2 align="center">Login</h2>
        <label for="email">Email</label>
        <input type="" name="email" id="email">
        @error('email')
            <p class="error_msg">{{ $message }}</p>
        @enderror
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        @error('password')
            <p class="error_msg">{{ $message }}</p>
        @enderror
        <p>Don't have an account? <a href="{{ route('view.register') }}">Signup</a></p>
        <button id='loginButton' onclick="handleLogin(event)">Login</button>
    </form>

    <script>
        const error_msg = document.querySelectorAll('.error_msg');
        error_msg.forEach((msg) => {
            setTimeout(() => {
                msg.style.display = 'none';
            }, 3000);
        });

        function handleLogin(e) {
            e.preventDefault();
            const form = document.querySelector('#loginForm');
            const email = form.email.value;
            const password = form.password.value;
            if (email === '' || password === '') {
                alert('Please fill all the fields');
                return;
            }
            fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                }).then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = '/dashboard';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => console.log(err));
        }
    </script>
</body>

</html>
