<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
  <title>summernote</title>
  <!-- include jquery -->
  <script src="//code.jquery.com/jquery-1.9.1.min.js"></script> 

  <!-- include libraries BS3 -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
  <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

  <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/blackboard.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css">
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.min.js"></script>

  <!-- include summernote -->
  <link rel="stylesheet" href="../dist/summernote.css">
  <script type="text/javascript" src="../dist/summernote.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
       
        height: 200,
        tabsize: 2,
        codemirror: {
          theme: 'monokai'
        }
      });
    });
  </script>
</head>
<body>
<textarea class="summernote"><p>Votre <b>message</b></p></textarea>
</body>
</html>
