<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Peralatan</title>
</head>
<body>
    <form id="Login" action="{{ route('petugas_peralatan.login.submit') }}" method="POST">
        @csrf
    <div class="box">
        <div class="form">
            <h2>Login</h2>
            <div class="inputBox">
                <input type="text" name="username" required="required" value="{{ old('username') }}">
                <span>Username</span>
                <i></i>
                @IF ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @ENDIF
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
                @IF ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @ENDIF
            </div>
            <div class="invalid" role="alert">
                {{session('error_message')}}
            </div>
            <input type="submit" value="Login">
        </div>
    </div>
    </form>
</body>

<style >
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #23242a;
    }

    .invalid{
        color: red;
        padding-top: 15px;
        font-size: 12px;
    }

    .box{
        position: relative;
        width: 380px;
        height: 420px;
        background: #1c1c1c;
        border-radius: 8px;
        overflow: hidden;
    }

    .box::before{
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 380px;
        height: 420px;
        background: linear-gradient(0deg, transparent, #09ff00);
        transform-origin: bottom right;
        animation: animate 6s linear infinite;
    }

    .box::after{
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 380px;
        height: 420px;
        background: linear-gradient(0deg, transparent, #09ff00);
        transform-origin: bottom right;
        animation: animate 6s linear infinite;
        animation-delay: -3s;
    }

    .form{
        position: absolute;
        inset: 2px;
        border-radius: 8px;
        background: #1c1c1c;
        z-index: 10;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
    }

    .form h2{
        color: rgb(0, 255, 21);
        font-weight: 600;
        text-align: center;
        letter-spacing: 0.1em;
        font-size: 1.8em;
    }

    .inputBox
    {
        position: relative;
        width: 300px;
        margin-top: 35px;
    }

    .inputBox input{
        position: relative;
        width: 100%;
        padding: 20px 10px 10px;
        background: transparent;
        border: none;
        outline: none;
        color: rgb(0, 0, 0);
        font-size: 1em;
        letter-spacing: 0.05em;
        z-index: 10;
    }

    .inputBox span{
        position: absolute;
        left: 0;
        padding: 20px 0px 10px;
        font-size: 1em;
        color: #fff;
        pointer-events: none;
        letter-spacing: 0.05em;
        transition: 0.5s;
    }

    .inputBox input:valid ~ span,
    .inputBox input:focus ~ span{
        color: #09ff00;
        transform: translateX(0px) translateY(-34px);
        font-size: 0.75em;
    }

    .inputBox i{
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background: #caffd7;
        border-radius: 4px;
        transition: 0.5s;
        pointer-events: none;
        z-index: 9;
    }

    .inputBox input:valid ~ i,
    .inputBox input:focus ~ i{
        height: 44px;
    }

    input[type="submit"]
    {
        border: none;
        outline: none;
        background: #09ff00;
        padding: 11px 25px;
        width: 100px;
        margin-top: 30px;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
    }

    input[type="submit"]:active{
        opacity: 0.8;
    }


    @keyframes animate
    {
        0%{
            transform: rotate(0deg);
        }

        100%{
            transform: rotate(360deg);
        }
    }
</style>
