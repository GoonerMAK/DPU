<html>
<head>
    <title>Add an Expenditure</title>
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
            width: 150px;
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

<h1>Add an Expenditure</h1>

<form action="" method="get">
<table>
<tr>
    <td>Expenditure Code</td>
    <td><input type="number" name="economicCode" min="3000" max="9999" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required /></td>
</tr>

<tr>
    <td>Expenditure Name (English)</td>
    <td><input type="text" name="expNameEn" required/></td>
</tr>
<tr>
    <td>Expenditure Name (Bengali)</td>
    <td><input type="text" name="expNameBn" /></td>
</tr>

<tr>
    <td>Budget Type</td>
    <td>
        <select name="budgetType" required>
            <option value="" disabled selected>Select</option>
            @isset($budgetTypes)
            @foreach ($budgetTypes as $budgetType)
                <option value="{{ $budgetType }}">{{ $budgetType }}</option>
            @endforeach
            @endisset
        </select>
    </td>
</tr>


</table>
    
    <input type="submit" value="Add"/>
    
</form>

<form action="/ExpenditureInformation" method="get">

        <input type="submit" value="Back"/>
              
</form>

</div>

</x-app-layout>

</body>
</html>