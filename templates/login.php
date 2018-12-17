<?php
include 'navigation.php';
?>

<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            email: {
              identifier  : 'email',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your e-mail'
                },
                {
                  type   : 'email',
                  prompt : 'Please enter a valid e-mail'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            },
            charactertype: {
              identifier  : 'charactertype',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please select your role'
                }
              ]
            }
          }
        })
      ;
    });
  </script>

    <style>
        .ui.grid {
            display:grid;
        }
    </style>
</head>
<body>

<div class="ui middle center aligned grid" style="padding:100px; margin-left: -20rem;">
  <div class="aligned column" style="width:200%; height:100%">
    <h2 class="image header">
      <div class="content">
        Log-in to your account
      </div>
    </h2>
    <form class="ui medium form" method="post">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="login" placeholder="E-mail address">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Password" autocomplete='off'>
          </div>
        </div>

        <div class="field">
        <div class="ui selection dropdown">
            <input type="hidden" name="charactertype">
            <i class="dropdown icon"></i>
            <div class="default text">Select role</div>
            <div class="menu">
                    <div class="item" data-value="1"><i class="fas fa-child"></i>  Student</div>
                    <div class="item" data-value="2"><i class="fas fa-chalkboard-teacher"></i>  Trainer</div>
                    <div class="item" data-value="0"><i class="fas fa-user-cog"></i>  Ionic</div>
                    <div class="item" data-value="3"><i class="fas fa-university"></i>  School</div>
            </div>
        </div>
        </div>
        
        <div>
        <input id="submitBtn" type="submit" class="ui fluid large teal submit button" style="background-color:#2185d0" name="submit" value="Login" ></input>
        </div>
      </div>

      <div class="ui error message"></div>
    </form>
  </div>
</div>
</body>
<script>
    $('.ui.dropdown')
        .dropdown()
    ;
</script>

</html>