
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="chosen.css"/>
    <title>Add a Sub Expenditure</title>
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

<h1>Add a Sub Expenditure</h1>

<form action="" method="get">
<table>

<tr>
    <td>Expenditure Code</td>
    <td>
        <select data-placeholder="Select" name="economicCode" class="jquery" required>
        <option value="" disabled selected></option> 
            @isset($expenditures)
            @foreach($expenditures as $expenditure)
            <option value="{{ $expenditure-> exp_code }}">{{ $expenditure->exp_code }}</option>
            @endforeach
            @endisset            
        </select>
    </td>
</tr>

<tr>
    <td>Sub Expenditure Code</td>
    <td> <input type="number" name="subExpCode" id="subExpCode" min="0" required />  </td>
</tr>

<tr>
    <td>Sub Expenditure Name (English)</td>
    <td><input type="text" name="subExpNameEn" required/></td>
</tr>

<tr>
    <td>Sub Expenditure Name (Bengali)</td>
    <td><input type="text" name="subExpNameBn" /></td>
</tr>

</table>
    
    <input type="submit" value="Add"/>
    
</form>

<form action="/ExpenditureInformation" method="get">

    <input type="submit" value="Back"/>
              
</form>

</div>

</x-app-layout>


<script>
    $(document).ready(function() {
        $(".jquery").chosen();
        
    });
</script>

</body>
</html>