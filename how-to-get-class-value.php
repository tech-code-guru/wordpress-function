<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<html>
<head>
  <title>jQuery test</title>
  <!-- script that inserts jquery goes here -->
  <script type='text/javascript'>
     $(document).ready(function() { alert($(".item1 span").text()); });
  </script>
</head>
<body>
<div class='item1'>
<span>This is my name</span>
</div>
</body>
</html>