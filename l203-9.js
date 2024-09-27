<script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
 function showMsg() {
 $.ajax({
 type: "POST",
 url: "systematic.php",
 data: "name=John&location=Hong Kong",
 error: function() {
 alert("Ajax request Error!");
 },
 success: function(response) {
 $("#msg").html(response);
 }
 }); 
}
 $(document).ready(function(){
 $('#btn').click(showMsg);
 });
</script>

-----------------------------------------

<? echo "$name lives in $location"; ?>
