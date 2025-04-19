<!DOCTYPE html>
<html>
<head>
    <title>User Authorized</title>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px; color: #333;">

    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);">

        <h1 style="color: #2c3e50;">Hi {{ $user->fName }},</h1>

        <p style="font-size: 16px; line-height: 1.6;">
            Your job ticket <strong style="color: #2980b9;">#{{ $ticket->ticket_id }}</strong> has been successfully <span style="color: #27ae60;"><strong>resolved</strong></span>.
        </p>

        <div style="margin-top: 20px;">
            <h3 style="color: #34495e; border-bottom: 1px solid #eee; padding-bottom: 5px;">Ticket Details</h3>
            <ul style="list-style: none; padding-left: 0; font-size: 15px; line-height: 1.8;">
                <li><strong>Subject:</strong> {{ $ticket->ticket_subj }}</li>
                <li><strong>Description:</strong> {{ $ticket->ticket_description }}</li>
                <li><strong>Status:</strong> <span style="color: #27ae60;">{{ $ticket->status }}</span></li>
            </ul>
        </div>

        <p style="margin-top: 30px; font-size: 15px;">
            If you have any further questions or concerns, feel free to reach out MIS team at local phone directory 277 or 201.
        </p>

        <p style="margin-top: 40px; font-size: 15px;">
            Thank you,<br>
            <strong>KFCP MIS Team</strong>
        </p>

    </div>

</body>
</html>
