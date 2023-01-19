<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Job FInder</title>
</head>
<body>
    <div class="container">
        <h1>You Application Status</h1>
        <p>Hey <b>{{ $user->name }}</b> Applicant your application in job with an Title of <b>{{ $job->title }}</b> was reviewing by Employeer of this Company
            <b>{{ $job->company->name }}</b>.</p>
        <p>and your status was under <b>{{ $status }}</b></p>
        @if ($status == "review")
          <p><b>{{ $user->name }}</b> please standby by next status of your application. employeer was already considering you application. we will notify you if your application 
                was candidate to another round.
            </p>  
        @endif

        @if ($status == "select")
            <p><b>{{ $user->name }}</b> please standby by next status of your application. employeer was already considering you application. we will notify you if your application 
                was candidate to another round.
            </p>  
        @endif

        @if ($status == "accept")
            <p><b>{{ $user->name }}</b> good news your application for this was chosen to interview. please standby by email of employeer
                for interview invitation. and good luck.
            </p>  
        @endif

        @if ($status == "reject")
          <p><b>{{ $user->name }}</b> am sorry to say that you application was rejected by employeer. thank you for using our system and apply again.
            </p>  
        @endif
        
        <p>Thank you</p>
        <label>dont reply in this email this is system generated</label>
    </div>
</body>
</html>