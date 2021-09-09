@extends('layouts.admin')


@section('content')

    <!--START PAGE HEADER -->
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>Users Manger</h1>
            </div>

        </div>
    </header>
    <!--END PAGE HEADER -->
    <!--START PAGE CONTENT -->
    <section class="page-content container-fluid">



        <!-- User Table -->
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">Users Tabel
                        <button data-toggle="modal" data-target="#ModelAddUser" type="button" class="btn btn-warning" style="float: right;"><i class="zmdi zmdi-plus-circle zmdi-hc-fw" style="
                                                                                color: #fff;
                                                                                font-size: 1.7em;
                                                                            "></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="recent-transaction-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="recent-transaction-table" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="recent-transaction-table_info">
                                            <thead>
                                            <tr role="row">
                                                <th tabindex="0" colspan="1" style="width: 10px;">ID</th>

                                                <th tabindex="0" aria-controls="recent-transaction-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="TRANSACTION ID: activate to sort column descending" style="width: 150px;">Username</th>

                                                <th tabindex="0" aria-controls="recent-transaction-table" rowspan="1" colspan="1" aria-label="STATUS: activate to sort column ascending" style="width: 10px;">Option</th>



                                            </tr>
                                            </thead>
                                            <tbody id="UserDataTbody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End User Table -->






        {{--    Model Delete  User    --}}
        <div class="modal fade" id="ModelDeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove User</h5>

                    </div>
                    <form onsubmit="DeleteUser();return false">
                        <div class="modal-body">
                            <input type="hidden" id="DeleteUserID" value=""/>
                            <p>Do u want Delete this section? <code id="DeleteUserName"></code></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-outline">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{--    Model Add  User    --}}
        <div class="modal fade" id="ModelAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new User</h5>

                    </div>
                    <form onsubmit="AddUser();return false">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control required" id="AddUserUsername" aria-describedby="emailHelp1" autocomplete="email" placeholder="Enter Username">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="text" class="form-control" id="AddUserPassword" autocomplete="current-password" placeholder="Password">
                            </div>

                        </div>
                        <div class="card-footer bg-light" style="text-align: right">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{--    Model Edit  User    --}}
        <div class="modal fade" id="ModelEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update User Password</h5>

                    </div>
                    <form onsubmit="EditUSer();return false">
                        <div class="card-body">
                            <p>Do you want edit password for <code id="EditUserName"></code> ?</p>
                            <input type="hidden" id="EditUserID">
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>

                                <input type="text" class="form-control" id="EditUserNewPassword" autocomplete="current-password" placeholder="Password">
                            </div>

                        </div>
                        <div class="card-footer bg-light" style="text-align: right">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </section>
    <!--END PAGE CONTENT -->

    <script>
        // #ModelEditUser, #ModelAddUser, #ModelDeleteUser
        setTimeout(function(){

            loadData();

            $(document).on("click",".DataOptionDelete", function () {
                var itemID = $(this).data('id');
                var itemName = $(this).data('name');
                $("#DeleteUserID").val(itemID);
                $("#DeleteUserName").text(itemName);
            });

            $(document).on("click",".DataOptionEdit", function () {
                var itemID = $(this).data('id');
                var itemName = $(this).data('name');
                $("#EditUserID").val(itemID);
                $("#EditUserName").text(itemName);
            });

        }, 1000);


        function loadData() {
            // alert('loadData is working :) ');
            var token = "{{ csrf_token() }}";
            $("#UserDataTbody").empty();
            $.post("{{route('LoadAllUser') }}",{'_token':token},function(c){
                var data = c.LoadAllUser.data;
                $.each(data, function (i, va) {
                    var id = va.id, email = va.email;
                    var i = '<tr role="row" class=""> <td>'+(i+1)+'</td> <td class="sorting_1">'+email+'</td> <td> <a class="DataOptionEdit" style=" cursor: pointer; " data-toggle="modal" data-name="'+email+'" data-id="'+id+'" data-target="#ModelEditUser"> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a> <a class="DataOptionDelete" style=" cursor: pointer; " data-toggle="modal" data-name="'+email+'" data-id="'+id+'" data-target="#ModelDeleteUser"> <i class="zmdi zmdi-delete zmdi-hc-fw"></i> </a> </tr>';
                    $('#UserDataTbody').append(i);
                }); // End each ..
            },'json');
        }

        function EditUSer() {
            var EditUserID = $("#EditUserID").val(),
                EditUserNewPassword = $("#EditUserNewPassword").val(),
                token = "{{ csrf_token() }}";
                if(EditUserID !=='' && EditUserNewPassword !==''){
                    $.post("{{route('UpdateUserPassword') }}",{
                        '_token':token,
                        'UserID':EditUserID,
                        'NewPassword':EditUserNewPassword
                    },function(c){
                        var data = c.UpdateUserPassword;
                        if(data.stauts =='ok'){

                            $("#ModelEditUser").modal("hide");
                            Swal.fire(
                                'Update user password has successfully',
                                '',
                                'success'
                            );
                            $("#EditUserID").val('');
                            $("#EditUserNewPassword").val('');
                            $("#EditUserName").val('');
                            loadData();
                        }else{
                            alert('error #01 EditUSer');
                        }
                    },'json');
                }else{
                    alert('Inputs are empty :( ');
                }
        }

        function DeleteUser() {
            var DeleteUserID = $("#DeleteUserID").val(),
                token = "{{ csrf_token() }}";
                if(DeleteUserID !==''){
                    $.post("{{route('DeleteUser') }}",{
                        '_token':token,
                        'UserID':DeleteUserID
                    },function(c){
                        var data = c.DeleteUser;
                        if(data.stauts =='ok'){

                            $("#ModelDeleteUser").modal("hide");
                            Swal.fire(
                                'Delete user  has successfully',
                                '',
                                'success'
                            );
                            $("#DeleteUserID").val('');
                            $("#DeleteUserName").val('');
                            loadData();
                        }else{
                            alert('error #01 DeleteUser');
                        }
                    },'json');
                }else{
                    alert('Inputs are empty :( ');
                }
        }

        function AddUser() {
            var username = $("#AddUserUsername").val(),
                password = $("#AddUserPassword").val(),
                token = "{{ csrf_token() }}";
            if(username !== '' && password !==''){
                $.post("{{route('AddNewUser') }}",{
                    '_token':token,
                    'email':username,
                    'password':password
                },function(c){
                    var data = c.AddNewUser;
                    if(data.stauts =='ok'){

                        $("#ModelAddUser").modal("hide");
                        Swal.fire(
                            'Add user has successfully',
                            '',
                            'success'
                        );
                        $("#AddUserUsername").val('');
                        $("#AddUserPassword").val('');
                        loadData();
                    }else{
                        alert('error #01 AddUser');
                    }
                },'json');
            }else{
                alert('Inputs are empty :( ');
            }

        }

    </script>

@endsection