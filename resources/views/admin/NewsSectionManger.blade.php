@extends('layouts.admin')


@section('content')

    <!--START PAGE HEADER -->
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>News Sections</h1>
            </div>

        </div>
    </header>
    <!--END PAGE HEADER -->
    <!--START PAGE CONTENT -->
    <section class="page-content container-fluid">


        {{-- load data dev --}}
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">Add new a news section
                        <button type="button" class="btn btn-warning" style="float: right;" data-toggle="modal" data-target="#AddNewScetion">
                            <i class="zmdi zmdi-plus-circle zmdi-hc-fw" style="color: #fff;font-size: 1.7em;"></i>
                        </button>
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
                                                <th tabindex="0" aria-controls="recent-transaction-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="TRANSACTION ID: activate to sort column descending" style="width: 150px;">Section name</th>
                                                <th tabindex="0" aria-controls="recent-transaction-table" rowspan="1" colspan="1" aria-label="STATUS: activate to sort column ascending" style="width: 10px;">Option</th>
                                                <th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="RECEIPT" style="width: 55px;">Date add</th>
                                            </tr>
                                            </thead>
                                            <tbody id="DataTbody">


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









        {{--    Model add new section    --}}
        <div class="modal fade" id="AddNewScetion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new section</h5>

                    </div>
                    <form onsubmit="AddNewScetion();return false">
                        <div class="modal-body">
                            <label class="sr-only" for="inlineFormInput">Name</label>
                            <input type="text" class="form-control mb-2" id="NewSectionName" placeholder="New section name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-outline">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--    Model edit section    --}}
        <div class="modal fade" id="EditScetion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit section</h5>

                    </div>
                    <form onsubmit="EditScetionFuc();return false">
                        <div class="modal-body">
                            <label class="sr-only" for="inlineFormInput">Name</label>
                            <input type="text" class="form-control mb-2" id="EditSectionInputName" placeholder="New section name">
                            <input type="hidden" id="EditSectionInputID" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-outline">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{--    Model Delete  section    --}}
        <div class="modal fade" id="DeleteScetion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new section</h5>

                    </div>
                    <form onsubmit="DeleteSection();return false">
                        <div class="modal-body">
                            <input type="hidden" id="DeleteSectionNameID" value=""/>
                            <p>Do u want Delete this section? <code id="DeleteSectionNameName"></code></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-outline">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>






    </section>
    <script>

            setTimeout(function(){

                loadData();

                $(document).on("click",".DataOptionDelete", function () {
                    var itemID = $(this).data('id');
                    var itemName = $(this).data('name');
                    $("#DeleteSectionNameID").val(itemID);
                    $("#DeleteSectionNameName").text(itemName);
                });

                $(document).on("click",".DataOptionEdit", function () {
                    var itemID = $(this).data('id');
                    var itemName = $(this).data('name');
                    $("#EditSectionInputID").val(itemID);
                    $("#EditSectionInputName").val(itemName);
                });

            }, 1000);




            function loadData(){
                var token = "{{ csrf_token() }}";
                $("#DataTbody").empty();
                $.post("{{route('LoadAllTypeNews') }}",{'_token':token},function(c){
                    var data = c.LoadAllTypeNews.data;
                    $.each(data, function (i, va) {
                        var id = va.id, name = va.Name, DateCreate = va.created_at;
                        var i = '<tr><td>'+(i+1)+'</td> <td class="sorting_1">'+name+'</td> <td> <a class="DataOptionEdit" data-toggle="modal" data-name="'+name+'" data-id="'+id+'" data-target="#EditScetion"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a> <a class="DataOptionDelete" data-toggle="modal" data-name="'+name+'" data-id="'+id+'" data-target="#DeleteScetion"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></td> <td>'+DateCreate+'</td></tr>';
                        $('#DataTbody').append(i);
                    }); // End each ..
                },'json');
            }

            function EditScetionFuc() {
                var name = $("#EditSectionInputName").val(),
                    id = $("#EditSectionInputID").val(),
                    token = "{{ csrf_token() }}";
                if(name !== '' && id !==''){
                    $.post("{{  route('EditTypeNews') }}",
                        {
                        '_token':token,
                        'EditTypeNewsID':id,
                        'EditTypeNewsName':name
                        }
                    ,function(c){
                        if(c.EditTypeNews.stauts == 'ok'){
                            $("#EditSectionInputName").val('');
                            $("#EditSectionInputID").val('');
                            loadData();
                            $("#EditScetion").modal("hide");

                            Swal.fire(
                                'Edited successfully',
                                '',
                                'success'
                            );

                            // alert('Edit section is done');
                        }else{
                            alert('Some is waring');
                        }
                    },'json');
                }else{
                    alert('The input is empty');
                }
                return false;
            }

            function DeleteSection() {
                var id = $("#DeleteSectionNameID").val(),
                    token = "{{ csrf_token() }}";
                if (id !== ''){
                    $.post("{{route('DeleteTypeNews') }}",{'_token':token,'DeleteTypeNewsID':id},function(c){
                        if(c.DeleteTypeNews.stauts == 'ok'){
                            loadData();
                            $("#DeleteScetion").modal("hide");
                            Swal.fire(
                                'Deletion successful',
                                '',
                                'success'
                            );
                            // alert('Remove section is done');
                        }else{
                            alert('Some is waring');
                        }
                    },'json');

                }else{
                    alert('The id is empty');
                }
                return false;
            }

           function AddNewScetion() {
               var name = $("#NewSectionName").val(),
                   token = "{{ csrf_token() }}",
                   res = '';
               if(name !== ''){
                   $.post("{{route('AddTypeNews') }}",{'_token':token,'AddTypeNewsName':name},function(c){
                       if(c.AddTypeNews.stauts == 'ok'){
                           $("#NewSectionName").val('');
                           loadData();
                           $("#AddNewScetion").modal("hide");
                           Swal.fire(
                               'Added successfully',
                               '',
                               'success'
                           )
                           // alert('Add new section is done');
                       }else{
                           alert('Some is waring');
                       }
                   },'json');
               }else{
                   alert('The input is empty');
               }
               return false;
           }

    </script>
    <!--END PAGE CONTENT -->
@endsection