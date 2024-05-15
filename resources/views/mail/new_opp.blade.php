<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>New Application Alert!</h1>
    <div class="bg-gray-100">
        <p>You have received a new application from: <span class="text-base text-indigo-500 capitalize">{{ $mailContent['studentName'] }}</span></p>
        <p>Opportunity: <span class="text-base">{{ $mailContent['opportunityTitle'] }}</span></p>
        <p>Message: {{ $mailContent['message'] }}</p>
    </div>
</body>
</html>