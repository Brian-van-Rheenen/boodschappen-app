<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verifieer je account</h2>

        <div>
            Verifieer je account door op de link te klikken. Als je dit gedaan hebt, kan je inloggen.
            {{ URL::to('verifieer/' . $confirmation_code) }}.<br/>

        </div>

    </body>
</html>