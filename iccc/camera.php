<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>무제 문서</title>
<meta name="viewport" content="width=320; user-scalable=no" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>Camera</title>
<script src="/jquery/jquery.js"></script>
 
<script>
$(document).ready(function(){
    if (!('url' in window) && ('webkitURL' in window)) {
        window.URL = window.webkitURL;
    }
 
    $('#camera').change(function(e){
        $('#pic').attr('src', URL.createObjectURL(e.target.files[0]));
    });
});
</script>

</head>

<body>
	<h4>Button Onclick</h4>
    <input type="file" id="camera" name="camera" capture="camera" accept="image/*" />
<br />
 
<img id="pic" style="width:100%;" />

</body>
</html>

