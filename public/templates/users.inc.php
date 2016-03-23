<!-- Included file in frontpage temlpate-->
<div id="users">
    <div class="page-header">
        <h1>Grid <small>System users</small></h1>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <form id="insertuser">
                                <th><input type="hidden" name="_METHOD" value="PUT"></th>
                                <th><input type="text" class="form-control" name="insfname" id="insfname" placeholder="Name"></th>
                                <th><input type="text" class="form-control" name="inslname" id="inslname" placeholder="Last name"></th>
                                <th><input type="text" class="form-control" name="institle" id="institle" placeholder="Title"></th>
                                <th><input type="text" class="form-control" name="insusername" id="insusername" placeholder="User name"></th>
                                <th><input type="password" class="form-control" name="inspassword" id="inspassword" placeholder="Password"></th>
                                <th><input type="text" class="form-control" name="insemail" id="insemail" placeholder="email"></th>
                                <th><input type="checkbox" class="form-control" name="insstatus" id="insstatus"></th>
                                <th><button type="submit" name="usersubmit" id="usersubmit" class="btn btn-primary" onclick="UserInsertSubmit()">Insert</button></th>
                            </form>
                        </tr>
                    </thead>
                    <tbody id="userstable"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>