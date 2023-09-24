
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="chosen.css"/>
    <title>Add ADP Cost</title>
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

<h1>Add ADP Cost Information</h1>

<form action="" method="post">
<table>
<tr>
    <td>Project Code</td>
    <td>
        <select data-placeholder="Select" name="projectCode" id="projectCodeSelect" class="jquery" required>  
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
            <!--The options pf this dropdown will Dynamically changed based on what Sub Economic Code was selected in the previous dropdown thing. According to the database the sub_exp_code must match for both of these dropdowns  -->
       
        </select>
    </td>
</tr>

<tr>
    <td>Year</td>
    <td>
        <select name="year" required>
            <option value="" disabled selected>Select</option>

        </select>
    </td>
</tr>
    
<tr>
    <td>ADP Cost</td>
    <td><input type="number" name="adpCost" min="0"  step="0.01" pattern="\d+(\.\d{2})?"required/></td>
</tr>
    

</table>

    <input type="submit" value="Add"/>

</form>

<form action="/ProjectInformation" method="get">

    <input type="submit" value="Back"/>
              
</form>

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