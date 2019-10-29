<script>
 $(document).ready(function(){
	 window .setTimeout (function () {
		 $(".alert").fadeTo(3000, 0).slideUp(3000, function(){
			 $(this).remove(); 
		 });
	 },4000);
 });
</script>
