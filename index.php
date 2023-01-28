<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>
<body>
    <div style="text-align: center">
        <h1>
            Please enter your details:
        </h1>
        <div id="result_form"></div>
    </div>
    <form class="m-auto col-4" method="post" id="form" action="">
        <div id="errors_form"></div>
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="firstName" placeholder="John">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="surname" name="lastName" placeholder="Doe">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
            <!--  Зробив type="text" а не type="email" аби показати що валідація працює-->
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="***********">
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                   placeholder="***********">
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</body>
</html>
<script type="text/javascript">

    $(document).ready(function () {
        $("#form").submit(function (event) {
            event.preventDefault();
            let formData = {
                name: $("#name").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                confirmPassword: $("#confirmPassword").val()
            };

            $.ajax({
                type: "POST",
                url: "action_form.php",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {

                if (!data.success) {
                    let result = ""
                    for(let someKey in data.errors) {
                       result += data.errors[someKey]+ '<br>'
                    }
                    $("#result_form").html(result).css("color", "red");

                } else {
                    $("#result_form").remove();
                    $("#form").html(
                        '<div class="alert alert-success">' + data.message + '</div>'
                    );
                }
            });
        });
    });
</script>