<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My page</title>

    <!-- CSS dependencies -->
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>

    <p>Content here. <a class="show-alert" href=#>Alert!</a></p>

    <!-- JS dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 4 dependency -->
    <script src="popper.min.js"></script>
    <script src="bootstrap.min.js"></script>

    <!-- bootbox code -->
    <script src="bootbox.min.js"></script>
    <script src="bootbox.locales.min.js"></script>
    <script>
        $(document).on("click", ".show-alert", function(e) {
            bootbox.alert("Hello world!", function() {
                console.log("Alert Callback");
            });
        });
    </script>
</body>
</html>