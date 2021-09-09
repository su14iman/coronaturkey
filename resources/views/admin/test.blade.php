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
                        <h5 class="card-header">Add new News</h5>
                        <div class="card-body">
                            <form id="vertical-wizard" action="#">


                                <!-- Section -->
                                <h3>News details</h3>

                                <section>
                                    <h5 class="card-title">News details</h5>
                                    <div class="form-group">
                                        <label for="">Select News Section *</label>
                                        <select class="form-control required">
                                            <option>Default select</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="demoTextInput1">Title *</label>
                                        <input type="text" class="form-control required" id="demoTextInput1" placeholder="Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description *</label>
                                        <textarea class="form-control required" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Text *</label>
                                        <textarea name="editor12" id="editor12" class="cke_wrapper required" rows="10" cols="80">

			                                            </textarea>

                                    </div>

                                </section>
                                <!-- End Section -->

                                <!-- Section -->
                                <h3>News Images</h3>

                                <section>
                                    <h5 class="card-title">News Images</h5>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload Image</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>


                                    <div class="ImageView">
                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                            <div class="card">
                                                <h5 class="card-header">News Images</h5>
                                                <div class="card-body p-0">
                                                    <div id="carouselExampleIndicators4" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">

                                                            <!-- Count -->
                                                            <li data-target="#carouselExampleIndicators4" data-slide-to="0" class="active"></li>
                                                            <li data-target="#carouselExampleIndicators4" data-slide-to="1" class="active"></li>

                                                        </ol>
                                                        <div class="carousel-inner">

                                                            <!-- Data -->


                                                            <div class="carousel-item active">
                                                                <img class="d-block" style="width:100%" src="../assets/img/demos/11.jpg" alt="Second slide">
                                                            </div>

                                                            <div class="carousel-item ">
                                                                <img class="d-block" style="width:100%" src="https://i1.sndcdn.com/artworks-000263755076-is7307-t500x500.jpg" alt="Second slide">
                                                            </div>



                                                        </div>

                                                        <a class="carousel-control-prev" href="#carouselExampleIndicators4" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleIndicators4" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>





                                </section>
                                <!-- End Section -->

                                <!-- Section -->
                                <h3>News Source</h3>

                                <section>
                                    <h5 class="card-title">News Source</h5>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Links *</label>
                                        <textarea name="editor13" id="editor13" class="cke_wrapper required" rows="10" cols="80">

			                                            </textarea>

                                    </div>

                                </section>
                                <!-- End Section -->

                                <!-- Section -->
                                <h3>News Keywords</h3>

                                <section>
                                    <h5 class="card-title">News Keywords</h5>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Keywords *</label>
                                        <p><code>Exampel:</code> Turkey,Word,sport</p>
                                        <textarea class="form-control required" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                </section>
                                <!-- End Section -->



                                <!-- Section -->
                                <h3>News Publishing</h3>

                                <section>
                                    <h5 class="card-title">News Publishing</h5>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-12 col-sm-12 ">Date of publication of the news</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="input-group date helper-datepicker">
                                                <input type='text' class="form-control" placeholder="mm/dd/yyyy" />
                                                <span class="input-group-addon action">
																<i class="icon dripicons-calendar"></i>
															</span>
                                            </div>
                                            <small class="form-text text-muted">
                                                Today and Clear helper buttons added.
                                            </small>
                                        </div>
                                    </div>

                                    <div class="form-group" style="text-align: center;">
                                        <p>
                                            Are you sure of the information for <code>publication</code>?
                                        </p>

                                        <button type="submit" class="btn btn-primary mb-2">Publishing</button>
                                    </div>

                                </section>
                                <!-- End Section -->





                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection