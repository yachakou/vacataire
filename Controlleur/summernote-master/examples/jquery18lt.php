<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>jquery old</title>
  <script src="http://code.jquery.com/jquery-1.8.3.js"></script>

  <!-- include libraries BS2 -->
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> 
  <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script> 
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">

  <!-- include summernote -->
  <link rel="stylesheet" href="../dist/summernote.css">
  <script type="text/javascript" src="../dist/summernote.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({height: 200});
    });
  </script>
</head>
<body>
<div class="summernote"></div>
</body>
</html>
