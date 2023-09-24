<html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="chosen.css"/>
    <title>Add Finance Information</title>
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
            width: 240px;
        }


        input[type="submit"] {
            padding: 8px 15px;
            background-color: #6875F5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 30px auto;
            width: 80px;
            text-align: center;
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

<h1>Add Finance Information</h1>

@if(session('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        }
    </script>
@endif

<form action="{{ route('addFinance') }}" method="post">
@csrf
<table>
<tr>
    <td>Project Code</td>
    <td>
        <select name="projectCode" id="projectCodeSelect" class="jquery" required>
            <option value="" disabled selected></option>
            @isset($projects)
            @foreach($projects as $project)
            <option value="{{ $project->project_id }}">{{ $project->project_id }}</option>
            @endforeach
            @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Economic Code</td>
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
    <td>Sub Economic Code</td>
    <td>
        <select name="subEconomicCode" id="subeconomiccode-select"  required>
            <option value="" disabled selected>Select an Economic Code first</option>
            <!--The options pf this dropdown will be populated Dynamically via JavaScript  -->
        </select>
    </td>
</tr>

<tr>
    <td>Category Code</td>
    <td>
        <select name="categoryCode" id="categorycode-select" required>
            <option value="" disabled selected>Select a Sub Economic Code first</option>
        </select>
    </td>
</tr>

<tr>
    <td>Year</td>
    <td><input type="number" name="year" min="1960" max="2040" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required/></td>
</tr>
    
<tr>
    <td>Month</td>
    <td>
        <select name="month" required>
            <option value="" disabled selected>Select</option>
            <!-- Generate dropdown options for Months -->
            @isset($months)
            @foreach ($months as $month)
                <option value="{{ $month }}">{{ $month }}</option>
            @endforeach
            @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Unit</td>
    <td><input type="number" name="unit" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required/></td>
</tr>

<tr>
    <td>Unit Price</td>
    <td><input type="number" name="unitPrice" min="0"  step="0.1" pattern="\d+(\.\d{2})?"required/></td>
</tr>

<tr>
    <td>Quantity</td>
    <td><input type="number" name="quantity" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required/></td>
</tr>

<tr>
    <td>GOB Cost</td>
    <td><input type="number" name="gobCost" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required/></td>
</tr>

<tr>
    <td>PA Cost</td>
    <td><input type="number" name="paCost" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required/></td>
</tr>

    

</table>
    
    <input type="submit" value="Add"/>
    
</form>

<form action="/ProjectInformation" method="get">

        <input type="submit" value="Back"/>
              
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><p>error</p>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <script>
        window.onload = function() {
            alert('{{ session("success") }}');
            window.location.href = '/FinanceProject'; 
        };
    </script>
@endif

</div>

</x-app-layout>

<script>

    $(document).ready(function() {
        $(".jquery").chosen();

        // Handle change event of the Economic Code dropdown
        $('select[name="economicCode"]').on('change', function() {
            var economicCode = $(this).val();

            // Clear existing options
            $('#subeconomiccode-select').empty();
            $('#categorycode-select').empty();

            $('#subeconomiccode-select').append('<option value="" disabled selected>Loading...</option>');
            $('#categorycode-select').append('<option value="" disabled selected>Select a Sub Economic Code first</option>');

            // Fetch Sub Economic Codes via AJAX
            $.ajax({
                url: '/getSubEconomicCodes',
                method: 'GET',
                data: {
                    economicCode: economicCode
                },
                success: function(response) {
                    // Update the Sub Economic Code dropdown options
                    $('#subeconomiccode-select').empty();
                    $('#subeconomiccode-select').append('<option value="" disabled selected>Select a Sub Economic Code</option>');

                    // Add fetched options
                    response.forEach(function(item) {
                        $('#subeconomiccode-select').append('<option value="' + item.sub_exp_code + '">' + item.sub_exp_code + '</option>');
                    });
                },
                error: function() {
                    // Handle error if necessary
                    $('#subeconomiccode-select').empty();
                    $('#subeconomiccode-select').append('<option value="" disabled selected>Error loading data</option>');
                }
            });
        });
        
        // Handle change event of the Sub Economic Code dropdown
        $('select[name="subEconomicCode"]').on('change', function() {
            var subEconomicCode = $(this).val();

            // Clear existing options
            $('#categorycode-select').empty();
            $('#categorycode-select').append('<option value="" disabled selected>Loading...</option>');

            // Fetch Category Codes via AJAX
            $.ajax({
                url: '/getCategoryCodes',
                method: 'GET',
                data: {
                    subEconomicCode: subEconomicCode
                },
                success: function(response) {
                    // Update the Category Code dropdown options
                    $('#categorycode-select').empty();
                    $('#categorycode-select').append('<option value="" disabled selected>Select a Category Code</option>');

                    // Add fetched options
                    response.forEach(function(item) {
                        $('#categorycode-select').append('<option value="' + item.cat_code + '">' + item.cat_code + '</option>');
                    });
                },
                error: function() {
                    // Handle error if necessary
                    $('#categorycode-select').empty();
                    $('#categorycode-select').append('<option value="" disabled selected>Error loading data</option>');
                }
            });
        });

    });
</script>



</body>
</html>