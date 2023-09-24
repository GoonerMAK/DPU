<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Home Page</title>
</head>
<body>

<h1>Database of Project Information</h1>   

<div class="container">

@if (Route::has('login'))               

@auth

<script>
    (function goToDashboard() {
        window.location.href = "/dashboard";    // If User is logged in, goes straight to the dashboard
    })();
</script>

@else

<form action="{{ route('login') }}" method="get">
<input type="Submit" value="Login"/>
</form>

<form action="{{ route('register') }}" method="get">
<input type="Submit" value="Register"/>
</form>

@endauth

@endif

</div>

</body>
</html>