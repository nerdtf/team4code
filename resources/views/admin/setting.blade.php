@include('layouts.embed.admin-nav')
@include('layouts.embed.errors')


    <form  action="/admin/setting" method="post">

        {{csrf_field()}}

        <legend><h1 class="text-lg-center display-3">Set up admin's name, email  and password</h1></legend>

        <div class=" form-group col-md-3 mb-3" style="margin-left: 30%">
            <label for="name">Name </label>
            <input class="form-control" value="admin" type="text" name="name" id="name">
        </div>

        <div style="margin-left: 30%" class="form-group col-md-3 mb-3">
            <label for="email">Email</label>
            <input class="form-control " value="admin" type="text" name="email" id="email">
        </div>
        <div style="margin-left: 30%" class="form-group col-md-3 mb-3">
            <label for="password">Password</label>
            <input class="form-control" value="admin" type="text" name="password" id="password">
        </div>

        <div style="margin-left: 35%" class="form-group">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
