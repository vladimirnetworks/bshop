<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>Change_me</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
</head>

<body>
  
<div class="container">
  
</div>

<script>





if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('/scripts/sw.js').then(function(registration) {
      // Registration was successful
      console.log(registration);

      registration.pushManager.subscribe({

        userVisibleOnly : true

      }).then(function(sub) {
        console.log(sub);
      });

     // alert('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
      // registration failed :(
      //alert('ServiceWorker registration failed: ', err);
    });
  });
}


</script>

</body>
</html>