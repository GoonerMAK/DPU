<html>
<head>
    <title>Add a Project</title>
    <link rel="stylesheet" href="multi-select-tag.css">
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

<h1>Add a Project</h1>

<form action="{{ route('addProject') }}" method="post" onsubmit="return validateForm()">
@csrf
<table>
<tr>
    <td>Project Code</td>
    <td><input type="text" name="projectCode" oninput="handleProjectCodeInput(this)" autocomplete=off required /></td>
</tr>

<tr>
    <td>Project Name (English)</td>
    <td><input type="text" name="projectNameEn" required/></td>
</tr>

<tr>
    <td>Project Name (Bengali)</td>
    <td><input type="text" name="projectNameBn" /></td>
</tr>

<tr>
    <td>Project Type</td>
    <td>
        <select name="projectType" required>
            <option value="" disabled selected>Select</option>
            <!-- Generate dropdown options for project types -->
            @isset($projectTypes)
            @foreach($projectTypes as $projectType)
            <option value="{{ $projectType->type }}">{{ $projectType->type }}</option>
            @endforeach
            @endisset

        </select>
    </td>
</tr>
    
<tr>
    <td>Start Date</td>
    <td><input type="date" name="startDate" required></td>
</tr>

<tr>
    <td>End Date</td>
    <td><input type="date" name="endDate" required></td>
</tr>

<tr>
    <td>Total Cost</td>
    <td><input type="number" name="totalCost" step="0.001" pattern="\d+(\.\d{1,3})?" min="0" required/></td>
</tr>

<tr>
    <td>Objective</td>
    <td><input type="text" name="objective"/></td>
</tr>

<tr>
    <td>Activities</td>
    <td><input type="text" name="activities" /></td>
</tr>

<tr>
    <td>Status</td>
    <td>
        <select name="status" required>
            <option value="" disabled selected>Select</option>
            <!-- Generate dropdown options for status : Ongoing, Complete or unapproved -->
            @isset($statusOptions)
            @foreach ($statusOptions as $statusOption)
                <option value="{{ $statusOption }}">{{ $statusOption }}</option>
            @endforeach
            @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Project Area</td>
    <td><input type="text" name="area" /></td>
</tr>

<tr>
    <td>Achievement</td>
    <td>
        <select name="achievement[]" id="achievement" multiple required>            
        <!-- Generate dropdown options for achievements where user can select multiple options -->
        @isset($achievements)
        @foreach($achievements as $achievement)
            <option value="{{ $achievement->achievement }}">{{ $achievement->achievement }}</option>
        @endforeach
        @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Funding Source</td>
    <td>
        <select name="fundingSource[]" id="fundingSource" multiple required>
            @isset($fundingSources)
            @foreach($fundingSources as $fundingSource)
                <option value="{{ $fundingSource-> source }}">{{ $fundingSource-> source }}</option>
            @endforeach
            @endisset
        </select>
    </td>
</tr>

<tr>
    <td>Climate Relevance Criteria (CRC)</td>
    <td>
        <select name="crc" id="crc-select" required>
            <option value="" disabled selected>Select</option>
            @isset($crcs)
            @foreach($crcs as $crc)
            <option value="{{ $crc ->crc_id }}">{{ $crc ->crc_id }}. {{ $crc ->crc_name }}</option>
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
            window.location.href = '/AddProject'; 
        };
    </script>
@endif

</div>

</x-app-layout>

    <script>

        function handleProjectCodeInput(inputField) 
        {
            // Replace any non-numeric characters with an empty string
            inputField.value = inputField.value.replace(/[^0-9]/g, '');

            // Limit the input to a maximum of 11 digits
            if (inputField.value.length > 11) 
            {
                inputField.value = inputField.value.slice(0, 11);
            }
        }

    </script>

    <script src="multi-select-tag.js"></script>

    <script>
    new MultiSelectTag('achievement')    // id = 'achievement'
    </script>

    <script>
    new MultiSelectTag('fundingSource')  // id = 'fundingSource'
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


<script>
    function validateForm() {
        const projectNameEn = document.getElementsByName('projectNameEn')[0].value;
        const projectType = document.getElementsByName('projectType')[0].value;
        const startDate = document.getElementsByName('startDate')[0].value;
        const endDate = document.getElementsByName('endDate')[0].value;
        const totalCost = document.getElementsByName('totalCost')[0].value;
        const status = document.getElementsByName('status')[0].value;
        const crc = document.getElementsByName('crc')[0].value;
        const subcrc = document.getElementsByName('subcrc')[0].value;
        const achievements = document.getElementsByName('achievement[]');
        const fundingSources = document.getElementsByName('fundingSource[]');

        if (
            projectNameEn === '' ||
            projectType === '' ||
            startDate === '' ||
            endDate === '' ||
            totalCost === '' ||
            status === '' ||
            crc === '' ||
            subcrc === '' ||
            achievements.length === 0 ||
            fundingSources.length === 0
        ) {
            alert('Fill All the Required Fields');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>


</body>
</html>