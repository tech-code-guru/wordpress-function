<div class="wrap">
<h2 id="add-new-user"> Update User</h2>


<div id="ajax-response"></div>

<form action="" method="post" name="createuser" id="createuser" class="validate">
<input name="action" type="hidden" value="createuser">
<input type="hidden" id="_wpnonce_create-user" name="_wpnonce_create-user" value="7f28a3e1d9"><input type="hidden" name="_wp_http_referer" value="/wordpress/wp-admin/user-new.php"><table class="form-table">
	<tbody><tr class="form-field form-required">
		<th scope="row"><label for="user_login">Username <span class="description">(required)</span></label></th>
		<td><input name="user_login" type="text" id="user_login" value="admin" aria-required="true"></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="email">E-mail <span class="description">(required)</span></label></th>
		<td><input name="email" type="text" id="email" value="sanjaymm11mm@gmai.com"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="first_name">First Name </label></th>
		<td><input name="first_name" type="text" id="first_name" value="Sanjay singhmm"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="last_name">Last Name </label></th>
		<td><input name="last_name" type="text" id="last_name" value="manralbb"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="user_url">website url </label></th>
		<td><input name="user_url" type="text" id="user_url" value="http://localhost/wordpresns/"></td>
	</tr>
	
	
	
	
	
	</tbody></table>


<p class="submit"><input type="submit" name="user" id="createusersub" class="button button-primary" value="Update User"></p>
</form>
</div>
<!------print code--------->

<div class="print_button_hide"><button onclick="myFunction()">Print this page</button></div>

<script>
function myFunction() {
    window.print();
}
</script>

<style>
 
@media print {
    .print_button_hide {
      display: none;
    }
	@page {
  size: auto;
  margin: 0;
  }
 @page {size: landscape}

	header#masthead {
    display: none;
}
th {
    font-size: 26px;
    padding: 21px;
}
h2#add-new-user {
    display: none;
}

p.submit {
    display: none;
}
table.form-table {
    text-align: center !important;
    margin: 0 auto;
    width: 100%;
}
input {
    border: none;
    background: none;
    color: black;
    font-weight: bold;
    width: 100%;
}
}

</style>