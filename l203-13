<script src=" http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="dist/jquery.validate.js"></script>
<script>
 $().ready(function() {
 $("#commentForm").validate();
 });
</script>
<style>
 #commentForm {
 width: 800px;
 }
 #commentForm label {
 width: 250px;
 }
 #commentForm label.error {
 color: red;
 font-style: italic;
 }
 #commentForm label.error, #commentForm input.submit {
 margin-left: 10px;
 }
</style>

----------------------------------------------------------

<form id="commentForm" method="post" action="">
 <p>
 <label>Name (required, at least 2 characters)</label><br />
 <input id="username" name="username" minlength="2" type="text" required>
 </p>
 <p>
 <label>E-Mail (required)</label><br />
 <input id="email" type="email" name="email" required>
 </p>
 <p>
 <label>URL (optional)</label><br />
 <input id="url" type="url" name="url">
 </p>
 <p>
 <label>Your comment (required)</label><br />
 <textarea id="comment" name="comment" required></textarea>
 </p>
 <p>
 <input class="submit" type="submit" value="Submit">
 </p>
</form>
