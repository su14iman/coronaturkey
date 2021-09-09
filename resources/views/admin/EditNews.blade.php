@extends('layouts.admin')


@section('content')

        <header class="page-header container">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1 class="separator">News Edit</h1>
                </div>

            </div>
        </header>
        <section class="page-content container">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5 class="card-header">Edit News
                            <a href="{{route("NewsManger")}}">
                                <button type="button" class="btn btn-warning" style="float: right;"><i class="la la-undo" style="
                                                                                color: #fff;
                                                                                font-size: 1.7em;
                                                                            "></i></button>
                            </a>

                        </h5>
                        <div class="card-body">



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



                                    <div class="col-lg-12">
                                        <div class="card">
                                            <h5 class="card-header">Slides only</h5>
                                            <div class="card-body p-0 ">
                                                <div id="carouselExample1" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <img id="NewsImageViewID" class="img-responsive" style="width:100%" src="../assets/img/demos/1.jpg" alt="First slide">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                            Are you sure of the information for <code>Edit</code>?
                                        </p>

                                        <button id="NewsPublishingSubmit" type="submit" class="btn btn-primary mb-2">Edit</button>
                                    </div>

                                </section>
                                <!-- End Section -->





                        </div>
                    </div>
                </div>
            </div>


        </section>

    <script>

        setTimeout(function(){
            var newsID = findGetParameter('id');
            loadTypeNews();
            loadDataInputs(newsID);

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
                newsID = $("#NewsID").val(),
                NewsSectionSelect = $("#NewsSectionSelect").val(),
                NewsDetailsTitle = $("#NewsDetailsTitle").val(),
                NewsDetailsDescription = $("#NewsDetailsDescription").val(),
                NewsDetailsText = CKEDITOR.instances['editor12'].getData(),

                NewsSourceInput = $("#NewsSourceInput").val(),
                NewsKeywordsInput = $("#NewsKeywordsInput").val(),


                NewsImagesInput = $("#NewsImagesInput").val();
                //name: NewsImagesPost



            if(NewsSectionSelect !=='' && NewsDetailsTitle !=='' && NewsDetailsDescription !=='' && NewsDetailsText !==''){
                $.post("{{route('EditNews') }}",
                    {
                        '_token':token,
                        'EditNewsID':newsID,
                        'EditNewsNewstypeID':$("#NewsSectionSelect").val(),
                        'EditNewsTitle':NewsDetailsTitle,
                        'EditNewsDescription':NewsDetailsDescription,
                        'EditNewsText':NewsDetailsText
                    }
                    ,function(c){
                        if(c.EditNews.stauts == 'ok'){
                            // alert('Add news step 1 is done')
                            if($("#NewsID").val() !==''){
                                $("#NewsSectionSelect").val('');
                                $("#NewsDetailsTitle").val('');
                                $("#NewsDetailsDescription").val('');
                                CKEDITOR.instances['editor12'].getData('');

                                // alert("NewsID is:"+NewsID);
                                Swal.fire({
                                    'position': 'top-end',
                                    'title':'Step One is Done',
                                    'text':'Edit a News is done.',
                                    'icon':'success'
                                    });



                            //    Add Image
                                if(NewsImagesInput !==''){
                                    setTimeout(function(){
                                        var NewsImageForm = document.getElementById("NewsImageForm");
                                        var fd = new FormData(NewsImageForm);

                                        $.ajax({
                                            url: '{{ route("EditNewsImages") }}',
                                            type: 'post',
                                            data: fd,
                                            contentType: false,
                                            processData: false,
                                            success: function(data){
                                                var json = $.parseJSON(data);
                                                if(json.EditNewsImages.stauts == 'ok'){
                                                    //*
                                                    // alert('image add done :=)');
                                                    $("#NewsImagesInput").val('');
                                                    Swal.fire({
                                                        'position': 'top-end',
                                                        'title':'Edit image is done',
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
                                    $.post("{{route('EditSourcesLinksToNews') }}",
                                        {
                                            '_token':token,
                                            'EditSourcesLinksToNewsLink':NewsSourceInput,
                                            'EditSourcesLinksToNewsID':newsID
                                        }
                                        ,function(c){
                                            if(c.EditSourcesLinksToNews.stauts == 'ok'){
                                                //*
                                                $("#NewsSourceInput").val('');
                                                Swal.fire({
                                                    'position': 'top-end',
                                                    'title':'Edit links is Done',
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
                                    $.post("{{route('EditKeywordsToNews') }}",
                                        {
                                            '_token':token,
                                            'EditKeywordsToNewsKeyword':NewsKeywordsInput,
                                            'EditKeywordsToNewsID':newsID
                                        }
                                        ,function(c){
                                            if(c.EditKeywordsToNews.stauts == 'ok'){
                                                //*
                                                $("#NewsKeywordsInput").val('');
                                                Swal.fire({
                                                    'position': 'top-end',
                                                    'title':'Edit Keywords is done',
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










        function loadDataInputs(newsID){
            var token = "{{ csrf_token() }}";
            if (newsID !==''){
                $.post("{{route('LoadOneNews') }}",{'_token':token,'LoadOneNewsID':newsID},function(c){
                    var detailsData = c.LoadOneNews.details,
                        imageData=c.LoadOneNews.image,
                        SourceData=c.LoadOneNews.Source,
                        KeywordsData=c.LoadOneNews.Keywords;

                        var NewsSectionSelect = $("#NewsSectionSelect").val(),
                        NewsDetailsTitle = $("#NewsDetailsTitle").val(detailsData[0].Title),
                        NewsDetailsDescription = $("#NewsDetailsDescription").val(detailsData[0].Description),
                        NewsDetailsText = CKEDITOR.instances['editor12'].setData(detailsData[0].Text),

                        NewsSourceInput = $("#NewsSourceInput").val(SourceData[0].Link),
                        NewsKeywordsInput = $("#NewsKeywordsInput").val(KeywordsData[0].keyword);
                        $("#NewsImageViewID").attr('src','./../images/'+imageData[0].imageURL);
                        $("#NewsID").val(detailsData[0].id);

                },'json');
            } else{
                alert('newsID is empty');
            }
        }

        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function (item) {
                    tmp = item.split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }
    //EditSourcesLinksToNews,EditNewsImages,EditKeywordsToNews,EditNews

    </script>
@endsection