<html>
<head>
<style>
        .container {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: larger !important;
            font-weight: bold !important;
        }

        form {
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type = "date"],
        select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 300px;
        }


        input[type="submit"] {
            padding: 8px 15px;
            background-color: #6875F5;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: block;
            margin: 30px auto;
            text-align: center;
            width: 300px;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container input[type="submit"] {
            background-color: #4CAF50;
        }

        .btn-container input[type="submit"]:hover {
            background-color: #222;
        }
    </style>
</head>
<body>

<x-app-layout>

<div class="container">

<h1>Add Project Information!</h1>

<form action="/AddProject" method="get">
<input type="submit" value="Add a Project"/>
</form>

<form action="/DppInformation" method="get">
<input type="submit" value="Add Project DPP Information"/>
</form>

<form action="/FinanceProject" method="get">
<input type="submit" value="Add Project Finance Information"/>
</form>

<form action="/AdpCostProject" method="get">
<input type="submit" value="Add Project ADP Cost"/>
</form>

<form action="/RadpCostProject" method="get">
<input type="submit" value="Add Project RADP Cost"/>
</form>

<form action="/dashboard" method="get">
<input type="submit" value="Back"/>
</form>

</div>

</x-app-layout>

</body>
</html>