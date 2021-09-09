@extends('layouts.admin')


@section('content')

    <!--START PAGE HEADER -->
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>My Account</h1>
            </div>

        </div>
    </header>
    <!--END PAGE HEADER -->
    <!--START PAGE CONTENT -->
    <section class="page-content container-fluid">




        <!-- Edit User -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Edit My Password</h5>
                    <form onsubmit="UpdateMyPassword();return false">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="text" class="form-control" id="MyNewPasswordOne" autocomplete="current-password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Retype-Password</label>
                                <input type="text" class="form-control" id="MyNewPasswordTwo" autocomplete="current-password" placeholder="Retype-Password">
                            </div>

                        </div>
                        <div class="card-footer bg-light">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary clear-form">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Edit User -->
    </section>
    <!--END PAGE CONTENT -->

    <script>
    function UpdateMyPassword() {
        var MyNewPassword = $("#MyNewPasswordOne").val(),
            RetypePassword = $("#MyNewPasswordTwo").val(),
            token = "{{ csrf_token() }}";

            if(MyNewPassword !=='' && RetypePassword !==''){
                if(MyNewPassword == RetypePassword){
                    $.post("{{route('UpdateMyPassword') }}",{
                        '_token':token,
                        'NewPassword':MyNewPassword
                    },function(c){
                        var data = c.UpdateMyPassword;
                        if(data.stauts =='ok'){

                            Swal.fire(
                                'Update my password has successfully',
                                '',
                                'success'
                            );
                            $("#MyNewPasswordOne").val('');
                            $("#MyNewPasswordTwo").val('');
                            $("#MyNewPasswordOne").css({'border':'1px solid #839bb3'});
                            $("#MyNewPasswordTwo").css({'border':'1px solid #839bb3'});


                        }else{
                            alert('error #01 UpdateMyPassword');
                        }
                    },'json');
                }else{
                    $("#MyNewPasswordOne").css({'border':'1px solid red'});
                    $("#MyNewPasswordTwo").css({'border':'1px solid red'});
                    alert('Password does not match');
                }
            }else{
                alert('Inputs are Empty');
            }
    }
    </script>
@endsection