
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="chosen.css"/>
    <title>Add a DPP</title>
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
            padding: 5px ;
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

<h1>Add DPP Information</h1>

<form>
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
    <td>Description</td>
    <td><input type="text" name="description"/></td>
</tr>
    

<tr>
    <td>Climate Relevance Criteria (CRC)</td>
    <td>
        <select name="crc" required>
            <option value="" disabled selected>Select</option>
            @isset($crcs)
            @foreach($crcs as $crc)
            <option value="{{ $crc ->crc_id }}">{{ $crc ->crc_id }}.&nbsp; {{ $crc ->crc_name }}</option>
            @endforeach
            @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Sub CRC</td>
    <td>
        <select name="subcrc" id="subcrc-select" required>
            <option value="" disabled selected>Select a CRC first</option>
            <!--The options pf this dropdown will Dynamically changed based on what CRC was selected in the previous dropdown thing. According to the database the crc_id must match for both of these dropdowns  -->
        
        </select>
    </td>
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

<script>
    // Function to fetch and update Sub CRC options based on selected CRC
    function updateSubCRCOptions() 
    {
        const selectedCRCId = document.querySelector('select[name="crc"]').value;

        // Make an AJAX request to the server to fetch Sub CRC options
        fetch(`/getSubCRCOptions?crc_id=${selectedCRCId}`)
            .then((response) => response.json())
            .then((data) => {
                // Get the Sub CRC dropdown element
                const subCRCSelect = document.getElementById('subcrc-select');

                // Clear existing options
                subCRCSelect.innerHTML = '<option value="" disabled selected>Select a CRC first</option>';

                // Add new options based on the data received from the server
                data.forEach((subCRC) => {
                    const option = document.createElement('option');
                    option.value = subCRC.sub_crc_id;
                    option.textContent = `${subCRC.sub_crc_id}. ${subCRC.sub_crc_name}`;
                    subCRCSelect.appendChild(option);
                });
            })
            .catch((error) => {
                console.error('Error fetching Sub CRC options:', error);
            });
    }

    // Attach the event listener to the "CRC" dropdown
    document.querySelector('select[name="crc"]').addEventListener('change', updateSubCRCOptions);
</script>


</body>
</html>


