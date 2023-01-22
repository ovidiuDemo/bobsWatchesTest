<?php include_once  './config.php';?>
<?php include_once  './constants.php';?>
<?php include_once  './mock-data.php';?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BobsWatches - Demo</title>
        <base href="/">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <link href="./assets/css/style.css" rel="stylesheet"></script>
    </head>
    <body>
        <?php include_once './messages.php';?>
        <section class="intro">
            <?php include_once './mailing-form.php';?>
        </section>
        <script type="text/javascript">
            var uspsEndpoint = "<?= USPS_ENDPOINT ?>";
            var uspsUserID = "<?= USPS_USER_ID ?>";
            var apiEndpoint = "<?= API_ENDPOINT ?>";
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" type="text/javascript"></script>

        <script src="./assets/js/usps-api.js" type="text/javascript"></script>
        <script src="./assets/js/form.js" type="text/javascript"></script>
    </body>
</head>