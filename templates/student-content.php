<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link href="semantic/dist/semantic.min.css" rel="stylesheet">
<script src="semantic/dist/semantic.min.js"></script>
<link href="css/style.css" rel="stylesheet">

</head>
<body >

<script>
    $(function () {
        $('#menu a').on('click', function (e) {
            e.preventDefault();
            var page = $(this).attr('href');
            $('#content').load("../templates/"+page);
        });
    });

    $(function () {
        var redirect = <?php echo (!empty($redirect) ? json_encode($redirect) : '"e"'); ?>;
        if (redirect !== "e" && redirect.length > 2) {
          $('#content').load("../templates/"+redirect+".php");
        }
    });
</script>

<div class="ui horizontal menu">

<div class="content" id="content" style="width:100em; font-size: 1rem; text-align:center; padding: 60px;"> </div>
</div>
</body>
</html>