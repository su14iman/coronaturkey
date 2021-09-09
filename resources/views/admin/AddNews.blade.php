@extends('layouts.admin')


@section('content')

        <header class="page-header container">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1 class="separator">News Manger</h1>
                </div>

            </div>
        </header>
        <section class="page-content container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5 class="card-header">Add new News
                            <a href="{{route("NewsManger")}}">
                                <button type="button" class="btn btn-warning" style="float: right;"><i class="la la-undo" style="
                                                                                color: #fff;
                                                                                font-size: 1.7em;
                                                                            "></i></button>
                            </a>

                        </h5>
                        <div class="card-body">
{{--                            <form id="vertical-wizard" onsubmit="AddNewNews(); return false;">--}}


                                <!-- Section: Details -->
                                <h3>News details</h3>

                                <section>
                                    <h5 class="card-title">News details</h5>
                                    <div class="form-group">
                                        <label for="">Select News Section *</label>
                                        <select id="NewsSectionSelect" class="form-control required">
                                            <option>Default select</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="demoTextInput1">Title *</label>
                                        <input id="NewsDetailsTitle" type="text" class="form-control required" id="demoTextInput1" placeholder="Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description *</label>
                                        <textarea id="NewsDetailsDescription" class="form-control required" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Text *</label>
                                        <textarea name="editor12" id="editor12" class="cke_wrapper required" rows="10" cols="80">
                                        </textarea>

                                    </div>

                                </section>
                                <!-- End Section -->

                                <!-- Section: Image -->
                                <h3>News Images</h3>

                                <section>
                                    <h5 class="card-title">News Images</h5>

                                    <form id="NewsImageForm">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload Image</span>
                                            </div>
                                            <div class="custom-file">

                                                    @csrf
                                                <input name="NewsImagesPost" id="NewsImagesInput" type="file" class="custom-file-input" id="inputGroupFile01">
                                                <input name="AddNewsImageNewsID" type="hidden" id="NewsID"/>
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                                            </div>
                                        </div>
                                    </form>



                                </section>
                                <!-- End Section -->

                                <!-- Section: Links -->
                                <h3>News Source</h3>

                                <section>
                                    <h5 class="card-title">News Source</h5>


                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Links *</label>
                                        <p><code>Exampel:</code> https://google.com<code>,</code>https://facebook.com</p>

                                        <textarea id="NewsSourceInput" class="form-control required" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                </section>
                                <!-- End Section -->

                                <!-- Section: Keywords -->
                                <h3>News Keywords</h3>

                                <section>
                                    <h5 class="card-title">News Keywords</h5>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Keywords *</label>
                                        <p><code>Exampel:</code> Turkey,Word,sport</p>
                                        <textarea id="NewsKeywordsInput" class="form-control required" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                </section>
                                <!-- End Section -->



                                <!-- Section: Publishing -->
                                <h3>News Publishing</h3>

                                <section>
                                    <h5 class="card-title">News Publishing</h5>

{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-form-label col-lg-12 col-sm-12 ">Date of publication of the news</label>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--                                            <div class="input-group date helper-datepicker">--}}
{{--                                                <input id="NewsPublishingDate" type='text' class="form-control" placeholder="mm/dd/yyyy" />--}}
{{--                                                <span class="input-group-addon action">--}}
{{--                                                    <i class="icon dripicons-calendar"></i>--}}
{{--                                                </span>--}}
{{--                                            </div>--}}
{{--                                            <small class="form-text text-muted">--}}
{{--                                                Today and Clear helper buttons added.--}}
{{--                                            </small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group" style="text-align: center;">
                                        <p>
                                            Are you sure of the information for <code>publication</code>?
                                        </p>

                                        <button id="NewsPublishingSubmit" type="submit" class="btn btn-primary mb-2">Publishing</button>
                                    </div>

                                </section>
                                <!-- End Section -->





{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <script>

        setTimeout(function(){
            loadTypeNews();



            $("#NewsPublishingSubmit").click(function () {
               AddNewsFuc();
            });
        }, 1000);

        function loadTypeNews() {
            var token = "{{ csrf_token() }}";
            $("#NewsSectionSelect").empty();
            $.post("{{route('LoadAllTypeNews') }}",{'_token':token},function(c){
                var data = c.LoadAllTypeNews.data;
                $.each(data, function (i, va) {
                    var id = va.id, name = va.Name, DateCreate = va.created_at;
                    var i = '<option value="'+id+'">'+name+'</option>';
                    $('#NewsSectionSelect').append(i);
                }); // End each ..
            },'json');
        }

        function AddNewsFuc() {
            var token = "{{ csrf_token() }}",
                NewsSectionSelect = $("#NewsSectionSelect").val(),
                NewsDetailsTitle = $("#NewsDetailsTitle").val(),
                NewsDetailsDescription = $("#NewsDetailsDescription").val(),
                NewsDetailsText = CKEDITOR.instances['editor12'].getData(),

                NewsSourceInput = $("#NewsSourceInput").val(),
                NewsKeywordsInput = $("#NewsKeywordsInput").val(),


                NewsImagesInput = $("#NewsImagesInput").val();
                //name: NewsImagesPost



            if(NewsSectionSelect !=='' && NewsDetailsTitle !=='' && NewsDetailsDescription !=='' && NewsDetailsText !==''){
                $.post("{{route('AddNewNews') }}",
                    {
                        '_token':token,
                        'AddNewNewsNewstypeID':$("#NewsSectionSelect").val(),
                        'AddNewNewsTitle':NewsDetailsTitle,
                        'AddNewNewsDescription':NewsDetailsDescription,
                        'AddNewNewsText':NewsDetailsText
                    }
                    ,function(c){
                        if(c.AddNewNews.stauts == 'ok'){
                            // alert('Add news step 1 is done')
                            $("#NewsID").val(c.AddNewNews.id);
                            if($("#NewsID").val() !==''){
                                var NewsID = $("#NewsID").val();

                                $("#NewsSectionSelect").val('');
                                $("#NewsDetailsTitle").val('');
                                $("#NewsDetailsDescription").val('');
                                CKEDITOR.instances['editor12'].getData('');

                                // alert("NewsID is:"+NewsID);
                                Swal.fire({
                                    'position': 'top-end',
                                    'title':'Step One is Done',
                                    'text':'Add a News and get news id.',
                                    'icon':'success'
                                    });



                            //    Add Image
                                if(NewsImagesInput !==''){
                                    setTimeout(function(){
                                        var NewsImageForm = document.getElementById("NewsImageForm");
                                        var fd = new FormData(NewsImageForm);

                                        $.ajax({
                                            url: '{{ route("AddNewsImage") }}',
                                            type: 'post',
                                            data: fd,
                                            contentType: false,
                                            processData: false,
                                            success: function(data){
                                                var json = $.parseJSON(data);
                                                if(json.AddNewsImage.stauts == 'ok'){
                                                    //*
                                                    // alert('image add done :=)');
                                                    $("#NewsImagesInput").val('');
                                                    Swal.fire({
                                                        'position': 'top-end',
                                                        'title':'Add image is done',
                                                        'text':'',
                                                        'icon':'success'
                                                    });
                                                }else{
                                                    // alert(json.AddNewsImage.stauts);
                                                    alert('has error, #04 AddNewsImage');

                                                }

                                            }
                                        });

                                    }, 1000);
                                }else{
                                    alert("Image is empty");
                                }
                            //    End Add Image




                            //    Add Links
                                if(NewsSourceInput !==''){
                                    //
                                    $.post("{{route('AddSourcesLinksToNews') }}",
                                        {
                                            '_token':token,
                                            'AddSourcesLinksToNewsLinks':NewsSourceInput,
                                            'AddSourcesLinksToNewsNewsID':NewsID
                                        }
                                        ,function(c){
                                            if(c.AddSourcesLinksToNews.stauts == 'ok'){
                                                //*
                                                $("#NewsSourceInput").val('');
                                                Swal.fire({
                                                    'position': 'top-end',
                                                    'title':'Add links is Done',
                                                    'text':'',
                                                    'icon':'success'
                                                });
                                            }else{
                                                alert('has error, #03 NewsSourceInput');
                                            }
                                        },'json');
                                }else{
                                    //  #
                                    alert("Source is empty");
                                }
                            //    End Add Links



                            //    Add Keywords
                                if(NewsKeywordsInput!==''){
                                    //
                                    $.post("{{route('AddKeywordsToNews') }}",
                                        {
                                            '_token':token,
                                            'AddKeywordsToNewsKeyword':NewsSourceInput,
                                            'AddKeywordsToNewsNewsID':NewsID
                                        }
                                        ,function(c){
                                            if(c.AddKeywordsToNews.stauts == 'ok'){
                                                //*
                                                $("#NewsKeywordsInput").val('');
                                                Swal.fire({
                                                    'position': 'top-end',
                                                    'title':'Add Keywords is done',
                                                    'text':'',
                                                    'icon':'success'
                                                });
                                            }else{
                                                alert('has error, #02 NewsKeywordsInput');
                                            }
                                        },'json');
                                }else{
                                    //  #
                                    alert("Keywords is empty");
                                }
                            //    End AddKeywords



                            //    Active News
                                if(1==1){
                                    $.post("{{route('PublishNewsOn') }}",
                                        {
                                            '_token':token,
                                            'PublishNewsOnID':NewsID
                                        }
                                        ,function(c){
                                            if(c.PublishNewsOn.stauts == 'ok'){
                                                Swal.fire({
                                                    'position': 'top-end',
                                                    'title':'The News Publish is Done ',
                                                    'text':'',
                                                    'icon':'success'
                                                });
                                            }else{
                                                alert('has error, #06 PublishNewsOn');
                                            }
                                        },'json');
                                }
                            //    End Active News



                            }else{
                             alert('error #02');
                            }
                        }else{
                            alert('error #01');
                        }
                    },'json');
            }else{
                //    #
                alert('The News Details is empty');
            }




        }





    </script>
@endsection