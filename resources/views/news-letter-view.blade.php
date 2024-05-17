<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NewsLetter Application | Automating Mails</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-6 col-md-offset-4">
                <h1>Subscriber Form</h1>

                <br>
                <div class="mb-2">
                    <input type="email" name="subscriber_email"
                        id="subscriber_email" placeholder="Enter Email" style="margin-top:5px; height:30px;" required>
                    <button
                        style=" margin-top:5px; height:30px; background-color:#ddd; border:none; font-family:'Playfair Display',serif; text-center"
                        onclick="addSubscriber();"><b>Subscribe</b></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addSubscriber() {
            // alert("test");
            var subscriber_email = $("#subscriber_email").val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (regex.test(subscriber_email) == false) {
                alert("Please Enter a valid Email..");
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/add-subscriber-email',
                data: {
                    subscriber_email: subscriber_email
                },
                success: function(resp) {
                    if(resp=="exists"){
                        alert("Subscriber email already exists");
                    }else if(resp=="inserted")
                        alert("Thanks for subscribing")
                },
                error: function() {
                    alert("Error");
                }
            });
        }
    </script>

</body>

</html>
