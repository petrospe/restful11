<!DOCTYPE html>
<html>
	<head>
		<title>RESTful Client</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Title</th>
								<th>Username</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
							<tr>
								<form id="insertuser" method="POST" action="#">
								<th></th>
								<th><input type="text" class="form-control" name="fname" placeholder="Name"></th>
								<th><input type="text" class="form-control" name="lname" placeholder="Last name"></th>
								<th><input type="text" class="form-control" name="title" placeholder="Title"></th>
								<th><input type="text" class="form-control" name="username" placeholder="User name"><input type="password" class="form-control" name="password" placeholder="Password"></th>
								<th><input type="text" class="form-control" name="email" placeholder="email"></th>
								<th><button type="submit" name="usersubmit" class="btn btn-default">Insert</button></th>
								</form>
							</tr>
						</thead>
						<tbody id="userstable"></tbody>
					</table>
				</div>
			</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			var url = "http://localhost/restful11/index.php/show";
			$.get(url,function(data){
				data = $.parseJSON(data);
				var _html = "";
				$.each(data,function(i,v){
					_html += "<tr>";
						_html += "<td>"+v.id+"</td>";
						_html += "<td>"+v.fname+"</td>";
						_html += "<td>"+v.lname+"</td>";
						_html += "<td>"+v.title+"</td>";
						_html += "<td>"+v.username+"</td>";
						_html += "<td>"+v.email+"</td>";
						_html += "<td>";
							_html += "<a href=''>Edit</a> || ";
							_html += "<a href='' onclick=DeleteData(\""+v.id+"\")>Delete</a>";
						_html += "</td>";
					_html += "</tr>"
				});
				$("#userstable").html(_html);
			});
		});
		function DeleteData(d) {
			//confirm('Delete '+d+' ?')
			var _url = "http://localhost/restful11/index.php/delete/"+d;
			jQuery.ajax({
				url: _url,
				type: "DELETE",
				async: false,
				success:function(data){
					alert('Delete '+d+' ?');
				},	
			})
		}
		</script>
		<script type="text/javascript">
		$(document).ready(function(){
			var url = "http://localhost/restful11/index.php/insert";
			/*$("#insertuser").submit(function(e){
				alert('Inserted')
				e.preventDefault();
			})*/
		})
		</script>
	</body>
</html>