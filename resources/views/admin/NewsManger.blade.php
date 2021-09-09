@extends('layouts.admin')


@section('content')

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










        <!-- Table News -->
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">News Tabel
                        <a href="{{route("AddNews")}}">
                            <button type="button" class="btn btn-warning" style="float: right;"><i class="zmdi zmdi-plus-circle zmdi-hc-fw" style="
                                                                                color: #fff;
                                                                                font-size: 1.7em;
                                                                            "></i></button>
                        </a>
                        <button onclick="loadData();return false" type="button" class="btn btn-warning" style="float: right; margin-right: 2%;"><i class="zmdi zmdi-refresh-alt zmdi-hc-fw" style="
                                                                                color: #fff;
                                                                                font-size: 1.7em;
                                                                            "></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="recent-transaction-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="recent-transaction-table_length">
                                            <select id="SectionsIDForLoad" class="form-control">
                                                <option>Default select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_filter" id="recent-transaction-table_filterr">
                                            <button onclick="loadDataSection();return false" type="button" class="btn btn-primary">Load</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="recent-transaction-table" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="recent-transaction-table_info">
                                            <thead>
                                            <tr role="row">
                                                <th tabindex="0" colspan="1" style="width: 10px;">ID</th>
                                                <th tabindex="0" aria-controls="recent-transaction-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="TRANSACTION ID: activate to sort column descending" style="width: 150px;">Title</th>
                                                <th tabindex="0" aria-controls="recent-transaction-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="TRANSACTION ID: activate to sort column descending" style="width: 150px;">Section name</th>
                                                <th tabindex="0" aria-controls="recent-transaction-table" rowspan="1" colspan="1" aria-label="STATUS: activate to sort column ascending" style="width: 10px;">Option</th>
                                                <th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="RECEIPT" style="width: 55px;">Date add</th>
                                            </tr>
                                            </thead>
                                            <tbody id="NewsDataTbody">


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
        <!-- End Table News -->






        {{--    Model Delete  News    --}}
        <div class="modal fade" id="DeleteNewsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete News</h5>

                    </div>
                    <form onsubmit="Delete();return false">
                        <div class="modal-body">
                            <input type="hidden" id="DeleteNewsID" value=""/>
                            <p>Do u want Delete this News? <code id="DeleteNewsName"></code></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-outline">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{--    Model Disactive  News    --}}
        <div class="modal fade" id="DisactiveModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Disactive News</h5>

                    </div>
                    <form onsubmit="Disactive();return false">
                        <div class="modal-body">
                            <input type="hidden" id="DisactiveID" value=""/>
                            <p>Do u want Disactive this News? <code id="DisactiveName"></code></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-outline">Disactive</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{--    Model Active  News    --}}
        <div class="modal fade" id="ActiveModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Active News</h5>

                    </div>
                    <form onsubmit="Active();return false">
                        <div class="modal-body">
                            <input type="hidden" id="ActiveID" value=""/>
                            <p>Do u want Active this News? <code id="ActiveName"></code></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-outline">Active</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>








    </section>
    <!--END PAGE CONTENT -->


    <script>
        setTimeout(function(){
            loadData();
            loadSections();
            $(document).on("click",".DataOptioneDelete", function () {
                var itemID = $(this).data('id');
                var itemName = $(this).data('name');
                $("#DeleteNewsID").val(itemID);
                $("#DeleteNewsName").text(itemName);

            });

            $(document).on("click",".DataOptioneActive", function () {
                var itemID = $(this).data('id');
                var itemName = $(this).data('name');
                $("#ActiveID").val(itemID);
                $("#ActiveName").text(itemName);
            });

            $(document).on("click",".DataOptioneDisactive", function () {
                var itemID = $(this).data('id');
                var itemName = $(this).data('name');
                $("#DisactiveID").val(itemID);
                $("#DisactiveName").text(itemName);

            });
        }, 1000);

        //.DataOptioneDisactive, .DataOptioneActive, .DataOptioneDelete
        //data-toggle="modal" data-name="'+va.Name+'" data-id="'+va.id+'" data-target="#ActiveModel"

        function loadData(){
            var token = "{{ csrf_token() }}";
            $("#NewsDataTbody").empty();
            $.post("{{route('LoadAllNews') }}",{'_token':token},function(c){
                var data = c.LoadAllNews.data;
                $.each(data, function (i, va) {
                    if(va.PublishStatus == 1){
                        var ActiveRes = '<a class="DataOptioneActive" data-toggle="modal" data-name="'+va.Title+'" data-id="'+va.id+'" data-target="#ActiveModel"> <i class="zmdi zmdi-eye-off zmdi-hc-fw"></i> </a>';
                    }else{
                        var ActiveRes = '<a class="DataOptioneDisactive" data-toggle="modal" data-name="'+va.Title+'" data-id="'+va.id+'" data-target="#DisactiveModel"> <i class="zmdi zmdi-eye zmdi-hc-fw"></i> </a>';
                    }

                    var x = '<tr role="row" class=""> <td>'+(i+1)+'</td> <td class="sorting_1">'+va.Title+'</td> <td class="sorting_1">'+va.Name+'</td> <td> <a href="{{route("EditNews")}}?id='+va.id+'"> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a> <a class="DataOptioneDelete" data-toggle="modal" data-name="'+va.Title+'" data-id="'+va.id+'" data-target="#DeleteNewsModel"> <i class="zmdi zmdi-delete zmdi-hc-fw"></i> </a> '+ActiveRes+' <td> '+va.created_at+' </td> </tr>';
                    $('#NewsDataTbody').append(x);
                }); // End each ..
            },'json');
        }

        function loadSections() {
            var token = "{{ csrf_token() }}";
            $("#SectionsIDForLoad").empty();
            $.post("{{route('LoadAllTypeNews') }}",{'_token':token},function(c){
                var data = c.LoadAllTypeNews.data;
                $.each(data, function (i, va) {
                    var id = va.id, name = va.Name;
                    var i = '<option value="'+id+'">'+name+'</option>';
                    $('#SectionsIDForLoad').append(i);
                }); // End each ..
            },'json');
        }




        function loadDataSection() {
            var id = $("#SectionsIDForLoad").val();
            var token = "{{ csrf_token() }}";
            $("#NewsDataTbody").empty();
            $.post("{{route('LoadAllNewsFromSection') }}",{'_token':token,'LoadAllNewsFromSectionID':id},function(c){
                var data = c.LoadAllNewsFromSection.data;
                $.each(data, function (i, va) {
                    if(va.PublishStatus == 1){
                        var ActiveRes = '<a class="DataOptioneActive" data-toggle="modal" data-name="'+va.Title+'" data-id="'+va.id+'" data-target="#ActiveModel"> <i class="zmdi zmdi-eye-off zmdi-hc-fw"></i> </a>';
                    }else{
                        var ActiveRes = '<a class="DataOptioneDisactive" data-toggle="modal" data-name="'+va.Title+'" data-id="'+va.id+'" data-target="#DisactiveModel"> <i class="zmdi zmdi-eye zmdi-hc-fw"></i> </a>';
                    }

                    var x = '<tr role="row" class=""> <td>'+(i+1)+'</td> <td class="sorting_1">'+va.Title+'</td> <td class="sorting_1">'+va.Name+'</td> <td> <a href="{{route("EditNews")}}?id='+va.id+'"> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a> <a class="DataOptioneDelete" data-toggle="modal" data-name="'+va.Title+'" data-id="'+va.id+'" data-target="#DeleteNewsModel"> <i class="zmdi zmdi-delete zmdi-hc-fw"></i> </a> '+ActiveRes+' <td> '+va.created_at+' </td> </tr>';
                    $('#NewsDataTbody').append(x);
                }); // End each ..
            },'json');
        }




        function Disactive() {
            var id = $("#DisactiveID").val();
            var token = "{{ csrf_token() }}";
            $.post("{{route('PublishNewsOff') }}",
                {
                    '_token':token,
                    'PublishNewsOffID':id
                }
                ,function(c){
                    if(c.PublishNewsOff.stauts == 'ok'){
                        Swal.fire({
                            'position': 'top-end',
                            'title':'News is Disactive.',
                            'text':'',
                            'icon':'success'
                        });
                        loadData();
                        $("#DisactiveModel").modal("hide");
                    }else{
                        alert('has error, #058');
                    }
                },'json');
        }

        function Active() {
            var id = $("#ActiveID").val();
            var token = "{{ csrf_token() }}";
            $.post("{{route('PublishNewsOn') }}",
                {
                    '_token':token,
                    'PublishNewsOnID':id
                }
                ,function(c){
                    if(c.PublishNewsOn.stauts == 'ok'){
                        Swal.fire({
                            'position': 'top-end',
                            'title':'News is active.',
                            'text':'',
                            'icon':'success'
                        });
                        loadData();
                        $("#ActiveModel").modal("hide");
                    }else{
                        alert('has error, #059');
                    }
                },'json');
        }


        function Delete() {
            var id = $("#DeleteNewsID").val(),
                token = "{{ csrf_token() }}";
            if (id !== ''){
                $.post("{{route('DeleteNews') }}",{'_token':token,'DeleteNewsID':id},function(c){
                    if(c.DeleteNews.stauts == 'ok'){
                        $("#DeleteScetion").modal("hide");
                        Swal.fire(
                            'Deletion successful',
                            '',
                            'success'
                        );
                        $("#DeleteNewsModel").modal("hide");
                        loadData();
                    }else{
                        alert('Some is waring');
                    }
                },'json');

            }else{
                alert('The id is empty');
            }
            return false;

        }
        
        
        
        

    </script>
@endsection