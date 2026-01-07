<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Signed PDF Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            margin: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1d72b8;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello {{ $recipientName }},</h2>

        <p>The PDF document has been signed and is attached to this email.</p>

        <a href="{{ $pdfPath }}" target="_blank">Download Signed PDF</a>

        <p>Thank you!</p>
    </div>
</body>

</html>
