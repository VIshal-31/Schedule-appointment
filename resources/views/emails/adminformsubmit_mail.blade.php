<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header img {
            max-width: 100px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dddddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #888888;
        }
    </style>
</head>

<body>
    <div class="container" style="border:solid 2px #274e8780">
        <header style="background-color:#274e87; padding: 20px;">
            <img src="https://webwideit.solutions/img/logo/webwide-logo-white-small.png" alt="Company Logo">
        </header>

        <p>Hello Admin,</p>

        <p>Here is new enquiry details:</p>

        <p><b>Customer Name:</b>{{ $userName }} </p>
        <p><b>Customer Email:</b><a href="mailto:{{ $userEmail }}"> {{ $userEmail }} </a></p>
        
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $category }}</td>
                    <td>{{ $service_name }}</td>
                    <td>{{ $date }}</td>
                    <td>{{ $service_start_time }} To {{ $service_end_time }} </td>
                </tr>
            </tbody>
        </table>
   
        <footer>
            Best Regards,<br>
            Webwide It Solutions
        </footer>
    </div>
</body>
</html>
