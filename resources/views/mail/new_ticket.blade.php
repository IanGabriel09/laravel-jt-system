<!DOCTYPE html>
<html>
<head>
    <title>New Ticket</title>
</head>
<body>
    <h1>Hello Admin,</h1>
    <p>A new ticket was submitted:</p>
    <ul>
        <li><strong>Ticket ID:</strong> {{ $user->ticket_id }}</li>
        <li><strong>Subject:</strong> {{ $user->ticket_subj }}</li>
        <li><strong>Description:</strong> {{ $user->ticket_description }}</li>
        <li><strong>Location:</strong> {{ $user->location }}</li>
        <li><strong>Priority:</strong> {{ $user->priority }}</li>
        <li><strong>Status:</strong> {{ $user->status }}</li>
        <li><strong>Submitted At:</strong> {{ $user->created_at }}</li>
    </ul>

    <a href="{{ route('adminLogin') }}"></a>
</body>
</html>
