<!DOCTYPE html>

<html>

<head>

	<title>Laravel Select2 Example</title>

	<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

</head>

<body>

<div class="container">

<h1>Laravel Select2 Example</h1>	


<select name="tags" id="" class="form-control sel-status" multiple="multiple">
    @foreach ($tags as $tag)
        <option value="{{$tag->id}}">{{$tag->skill_name}}</option>
    @endforeach
</select>



</div>

</body>

<script type="text/javascript">

$(document).ready(function() {

  $(".sel-status").select2();

});

</script>

</html>