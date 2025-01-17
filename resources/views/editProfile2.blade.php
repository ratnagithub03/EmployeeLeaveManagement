@extends('employeelayout.default')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .edit-profile-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        #message {
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>

    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form id="editProfileForm">
            <table>
                <tr>
                    <th>Photo</th>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role</th>
                </tr>
                <tr>
                    <td><input type="file" id="photo" name="photo"></td>
                    <td><input type="text" id="userid" name="uid" placeholder="User ID" readonly></td>
                    <td><input type="text" id="name" name="name" placeholder="Name"></td>
                    <td><input type="email" id="email" name="email" placeholder="Email"></td>
                    <td><input type="text" id="mobile" name="mobile" placeholder="Mobile"></td>
                    <td>
                        <select id="role" name="role">
                            <option value="Employee">Employee</option>
                            <option value="HR">Hr</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit">Save Changes</button>
        </form>
        <p id="message"></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Simulate fetching data from server to fill the form
            var employeeData = {
                uid: "",
                name: "Johnny Deep",
                email: "johnnydeep@example.com",
                mobile: "9876543210",
                role: "Employee"
            };

            // Fill the form with employee data
            $('#uid').val(employeeData.uid);
            $('#name').val(employeeData.name);
            $('#email').val(employeeData.email);
            $('#mobile').val(employeeData.mobile);
            $('#role').val(employeeData.role);

            // Handle form submission
            $('#editProfileForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                // AJAX request to update employee data
                $.ajax({
                    url: 'updateProfile.php',  // URL to your backend PHP file
                    type: 'POST',
                    data: formData,
                    processData: false,  // Prevent jQuery from automatically processing data
                    contentType: false,  // Prevent jQuery from overriding content type
                    success: function (response) {
                        $('#message').text('Profile updated successfully!');
                    },
                    error: function () {
                        $('#message').text('Error updating profile.');
                    }
                });
            });
        });
    </script>

</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload for photo
    if (!empty($_FILES['photo']['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
    }

    // Get other form data
    $uid = $_POST['userid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];

    // Simulate saving data to the database
    // Here you would update the employee's information in the database
    // For example:
    // $conn = new mysqli("localhost", "username", "password", "database");
    // $sql = "UPDATE employees SET name='$name', email='$email', mobile='$mobile', role='$role' WHERE uid='$uid'";
    // $conn->query($sql);

    // Respond with success message
    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
}
?>
@stop