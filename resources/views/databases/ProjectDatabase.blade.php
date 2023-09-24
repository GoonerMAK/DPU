<html>
<head>
    <title>Project Database</title>
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
            font-size: 2rem !important;
            font-weight: bold !important;
            margin-bottom: 20px !important;
        }

        span {
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width:100%;
            border: 1px solid #ccc; 
        }

        td {
            padding: 6px;
            border: 1px solid #ccc; 
            text-align: center; 
        }

        th {
            padding: 6px;
            border: 1px solid #ccc; 
            text-align: center;
            white-space: nowrap; 
        }

        th.actions-header {
            text-align: center;
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
            padding: 6px 12px;
            background-color: #6875F5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
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

<h1>Project Database</h1>

<span>

<table>
<tr>
    <th>Project Code</th>
    <th>Project Name</th>
    <th>Achievement</th>
    <th>Sub CRC</th>
    <th>Status</th>
    <th class="actions-header" colspan="3">Actions</th> 
</tr>

@foreach($projects as $project)
<tr>
    <td>{{ $project->project_id }}</td>
    <td>{{ $project->project_name }}</td>
    <td>{{ $project->achievement }}</td>
    <td>{{ $project->sub_crc_id }}</td>
    <td>{{ $project->status }}</td>
    
    <td>
        <form action="{{ route('viewProject', ['id' => $project->project_id]) }}" method="get">
            <input type="submit" value="View" />
        </form>
    </td>
    
    <td>
        <form action="{{ route('editProject', ['id' => $project->project_id]) }}" method="get">
            <input type="submit" value="Edit" />
        </form>
    </td>

    <td>
        <form action="{{ route('deleteProject', ['id' => $project->project_id]) }}" method="post" onsubmit="return confirmDelete();">
        @csrf
        @method('delete')
            <input type="submit" value="Delete" />
        </form>
    </td>

</tr>
@endforeach

</table>
    
</span>

<form action="/DatabaseInformation" method="get">
    <input type="submit" value="Back"/>      
</form>

</div>

</x-app-layout>

<script>
    function confirmDelete() {
        return confirm("Proceed to delete this project?");
    }
</script>

</body>
</html>