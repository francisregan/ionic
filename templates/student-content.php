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

<div class="ui vertical menu left" style="width:15em; font-size: 1.5rem; text-align: left;">

    <div class="item txtsizegrid">
        <div class="ui left icon input">
            <i class="fas fa-info"></i>
            &nbsp;&nbsp; 
            Introducation
        </div> 
        <div class="menu" id="menu">
            <a class="item">Intro</a>
        </div>
    </div>
    <div class="item txtsizegrid">
      <div class="ui left icon input">
        <i class="fas fa-book-open"></i>
        &nbsp;&nbsp; 
        Explanation
      </div> 
      <div class="menu" id="menu">
        <a class="item">Explain</a>
      </div>
    </div>
    <div class="item txtsizegrid">
      <div class="ui left icon input">
        <i class="fas fa-cloud-upload-alt"></i>
        &nbsp;&nbsp; 
        Submission
      </div> 
      <div class="menu" id="menu">
        <a class="item">Explain</a>
      </div>
    </div>
</div>
<div class="content" id="content" style="width:100em; font-size: 1rem; text-align:center;"> </div>
</div>
</body>
</html>