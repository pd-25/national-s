<!DOCTYPE html>
<html>
<head>
    <title>Event Registration Confirmation</title>
</head>
<body>
    <h1>Thank you for registering!</h1>
    <p>Dear {{ $eventRegister->name }},</p>
    <p>You have successfully registered for the event.</p>
    <p><strong>Event ID:</strong> {{ $eventRegister->event_id }}</p>
    <p><strong>Date:</strong> {{ $eventRegister->date }}</p>
    <p><strong>School Name:</strong> {{ $eventRegister->school_name }}</p>
    <p><strong>Class:</strong> {{ $eventRegister->class }}</p>
    <p><strong>Father's Name:</strong> {{ $eventRegister->father_name }}</p>
    <p><strong>Contact Number:</strong> {{ $eventRegister->contact_number }}</p>
    <p><strong>Amount:</strong> {{ $eventRegister->amount }}</p>
    <p>Thank you for your registration!</p>
</body>
</html>