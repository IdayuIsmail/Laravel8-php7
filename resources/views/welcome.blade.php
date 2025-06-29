<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="center1"></div>
    <div class="center">
<h1>MyDigitalID SSO Demo</h1>&nbsp;<br> <br> <br>
</div>
        <div class="center">
            <button onclick="window.location.href='{{ route('login') }}'" class="button-1" role="button">Login</button>

        </div>
</body>
</html>

<style>
.center {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100px;
}

.center1 {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 300px;
}


                
/* CSS */
.button-1 {
    display: inline-block;
    outline: none;
    cursor: pointer;
    font-weight: 500;
    border-radius: 3px;
    padding: 0 16px;
    border-radius: 4px;
    color: #fff;
    background: #6200ee;
    line-height: 1.15;
    font-size: 14px;
    height: 36px;
    word-spacing: 0px;
    letter-spacing: .0892857143em;
    text-decoration: none;
    text-transform: uppercase;
    min-width: 64px;
    border: none;
    text-align: center;
    box-shadow: 0px 3px 1px -2px rgb(0 0 0 / 20%), 0px 2px 2px 0px rgb(0 0 0 / 14%), 0px 1px 5px 0px rgb(0 0 0 / 12%);
    transition: box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);
    :hover {
        background: rgb(98, 0, 238);
        box-shadow: 0px 2px 4px -1px rgb(0 0 0 / 20%), 0px 4px 5px 0px rgb(0 0 0 / 14%), 0px 1px 10px 0px rgb(0 0 0 / 12%);
    }
}

</style>

<!-- <a href="{{ route('logout') }}">Logout</a> -->