<!-- <!DOCTYPE html>
<html>
<head>
    <title>Account Details</title>
</head>
<body>
    <h1>Hello, {{ $user}}</h1>
    <p>Your email: <strong>{{ $user }}</strong></p>
    <p>Your password: <strong>{{ $password }}</strong></p>
    <p>You can log in to our website here: <a href="https://yourwebsite.com">https://yourwebsite.com</a></p>
</body>
</html> -->
<!DOCTYPE html>
<html>
<head>
    <title>Account Details</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 24px;
            /* color: #333; */
        }
        p {
            margin: 10px 0;
        }
        ul {
            padding-left: 20px;
        }
        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            /* color: #fff; */
            background-color: #7C9C32;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #7C9C32;
        }
        .highlight {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to Kerala Health Portal!</h1>
        </header>
        <p>Dear <span class="highlight">{{ $fullname }}</span>,</p>
        <p>We are pleased to inform you that your account has been successfully created. As instructed by the Additional Chief Secretary, Health and Ayush, you are requested to upload the photos and videos of best practices and priority projects of your department/organisation on or before <strong>1 January 2025</strong>. The username and password for the same are as follows:</p> -->
        <p><strong>Login URL:</strong> <a href="https://keralahealth.cditproject.org/" alt="Kerala Health Login URL">https://keralahealth.cditproject.org/</a></p>
        <p><strong>Email:</strong> <span class="highlight">{{ $user }}</span></p>
        <p><strong>Password:</strong> <span class="">{{ $password }}</span></p>
        <p>Please follow these steps to log in for the first time:</p>
        <ul>
            <li>Click on the login link above.</li>
            <li>Enter your username and password.</li>
        </ul>
        <p>If you encounter any issues while uploading the content or need assistance, feel free to reach out to us at 8921926295.</p>
        <p>Important: For security purposes, do not share these credentials with anyone.</p>
        <p style="text-align: center;">
            <a href="https://keralahealth.cditproject.org/login" class="btn text-white" style="color: white;">Login</a>
        </p>
  
        <p><strong>The Team at Kerala Health Portal</strong></p>
    </div>
</body>
</html>


