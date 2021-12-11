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


navigator.serviceWorker.getRegistration('/').then(function(registration) {
  if(registration){
    console.log("ys");
  } else {
    alert("no");
  }
});


</script>

</body>
</html>