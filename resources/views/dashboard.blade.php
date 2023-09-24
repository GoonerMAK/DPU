<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <style>
        .container{
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            color: black;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            padding: 12px 10px;
            background-color: #6875F5;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            width: 300px;
            text-align: center;
            font-size: 1.09rem;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<x-app-layout>

<div class="container">
<h1>Welcome {{ auth()->user()->name }} !</h1>

<form action="/ProjectInformation" method="get">
<input type="submit" value="Add Project Information"/>
</form>

<form action="/ExpenditureInformation" method="get">
<input type="submit" value="Add Expenditure Category"/>
</form>

<form action="/DatabaseInformation" method="get">
<input type="submit" value="Show Database"/>
</form>
</div>

</x-app-layout>

</body>
</html>