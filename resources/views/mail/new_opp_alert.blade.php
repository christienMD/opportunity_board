<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Opportunity Alert</title>
</head>
<body>
    <h2>New Opportunity Alert!</h2>
    <p>Hello <span class="text-xl text-indigo-600">{{ $mailData['studentName'] }}</span>,</p>
    <div class="text-base">
        <p>An opportunity titled "{{ $mailData['opportunityTitle'] }}" that matches your registered category is now available. Here are some details:</p>
        <p>{{ $mailData['opportunityDetails'] }}</p>
        <p>Please take a look and consider applying if it interests you.</p>
        <p>Thank you!</p>
    </div>
</body>
</html>
