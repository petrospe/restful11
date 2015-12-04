<!DOCTYPE html>
<html>
	<head>
		<title>RESTful Client</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="userstable">
						<thead>
							<tr>
								<th>ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Title</th>
								<th colspan="2">Username</th>
								<th>Email</th>
								<th colspan="2">Action</th>
							</tr>
							<tr>
								<form id="insertuser" method="post">
								<th></th>
								<th><input type="text" class="form-control" name="fname" id="fname" placeholder="Name"></th>
								<th><input type="text" class="form-control" name="lname" id="lname" placeholder="Last name"></th>
								<th><input type="text" class="form-control" name="title" id="title" placeholder="Title"></th>
								<th><input type="text" class="form-control" name="username" id="username" placeholder="User name"></th>
								<th><input type="password" class="form-control" name="password" id="password" placeholder="Password"></th>
								<th><input type="text" class="form-control" name="email" id="email" placeholder="email"></th>
								<th colspan="2"><button type="submit" name="usersubmit" id="usersubmit" class="btn btn-primary">Insert</button></th>
								</form>
							</tr>
						</thead>
						<tbody id="userstable"></tbody>
					</table>
				</div>
			</div>
		</div>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		function DeleteUser(d) {
			//confirm('Delete '+d+' ?')
			var _url = "http://localhost/restful11/index.php/user/"+d;
			$.ajax({
				url: _url,
				type: "DELETE",
				async: false,
				success:function(data){
					alert('Delete '+d+' ?');
					$("#"+d).remove();

				},	
			})
		}
		</script>
		
		<script type="text/javascript">
			var url = "http://localhost/restful11/index.php/users";
			$.ajax({
			    url: url,
			    type: 'GET',
			    success: function (response) {
			        var trHTML = '';
			        $.each(response, function (i, item) {
			            trHTML += '<tr id='+item.id+'><td>' + item.id + '</td><td>' + item.fname + '</td><td>' + item.lname + '</td><td>' + item.title + '</td><td colspan="2">' + item.username + '</td><td>' + item.email + '</td><td><button type="button" class="btn btn-warning">Edit</button></td><td><button type="button" class="btn btn-danger" onclick="DeleteUser('+item.id+')">Delete</button></td></tr>';
			        });
			        $('#userstable').append(trHTML);
			    }
			});
		</script>
		<script>
			$(document).ready(function(){
				$("#usersubmit").click(function(){
				var fname = $("#fname").val();
				var lname = $("#lname").val();
				var title = $("#title").val();
				var username = $("#username").val();
				var password = $("#password").val();
				var email = $("#email").val();
				var status = $("#status").val();
				if(username=='' && email=='')
					{
					alert("Please fill out the form");
					}
				else if(username=='' && email!==''){alert('Username field is required')}
				else if(email=='' && username!==''){alert('Email field is required')}
				else{
					$.post("http://localhost/restful11/index.php/user", //Required URL of the page on server
						{ // Data Sending With Request To Server
						fname:fname,
						lname:lname,
						title:title,
						username:username,
						password:password,
						email:email,
						status:status
						},
					function(response,status){ // Required Callback Function
						alert("*----Received Data----*\n\nResponse : " + response+"\n\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
						$("#insertuser")[0].reset();
					});
					}
				});
			});
		</script>
	</body>
</html>