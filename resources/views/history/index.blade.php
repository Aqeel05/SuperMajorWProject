<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Session History</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f8f9fa;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .header h1 {
                margin: 0;
                font-size: 2em;
                color: #343a40;
            }
            .search-container {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #fff;
                padding: 5px;
                border-radius: 5px;
                border: 1px solid #ccc;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                margin: 20px 0;
                width: 50%;
                margin-left: auto;
                margin-right: auto;
            }
            .search-container input {
                border: none;
                padding: 10px;
                margin-right: 10px;
                border-radius: 5px;
                outline: none;
                width: 200px;
            }
            .search-container button {
                border: none;
                background-color: #007bff;
                color: white;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .search-container button i {
                font-size: 1.2em;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            th, td {
                border: 1px solid #ddd;
                padding: 15px;
                text-align: left;
            }
            th {
                background-color: #007bff;
                color: white;
            }
            tr {
                position: relative;
                background-color: white;
                transition: background-color 0.3s ease;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            .delete-btn {
                display: none;
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                border-radius: 5px;
            }
            tr:hover .delete-btn {
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>Session History</h1>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Session ID</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                    <tr id="session-{{ $session->id }}">
                        <td>{{ $session->id }}</td>
                        <td>{{ $session->datetimes[0] }}</td>
                        <td>{{ $session->datetimes[1] }}</td>
                        <td>
                            <a href="{{ route('sessions.show', $session->id) }}">View</a>
                            <button class="delete-btn" onclick="deleteSession({{ $session->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function deleteSession(sessionId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/sessions/${sessionId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`session-${sessionId}`).remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your session has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete session.',
                                    'error'
                                );
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the session.',
                                'error'
                            );
                        });
                    }
                });
            }
        </script>
    </body>
</x-app-layout>
