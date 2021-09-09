@extends('layouts.admin')


@section('content')

    <!--START PAGE HEADER -->
    <header class="page-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h1>Statistics</h1>
            </div>

        </div>
    </header>
    <!--END PAGE HEADER -->
    <!--START PAGE CONTENT -->
    <section class="page-content container-fluid">



        <div class="row">
            <div class="card-columns" style=" margin: auto; ">
                <div class="card bg-dark text-center p-3 ">
                    <blockquote class="blockquote mb-0">
                        <h2 id="OlumlerinText" class="text-white">1</h2>
                        <footer class="blockquote-footerr">
                            <p class="text-white">ölümlerin sayısı

                            </p>
                        </footer>
                    </blockquote>
                </div>
                <div class="card bg-danger text-center p-3 ">

                    <blockquote class="blockquote mb-0">
                        <h2 id="VakaText" class="text-white">1</h2>
                        <footer class="blockquote-footerr">
                            <p class="text-white">vaka sayısı

                            </p>
                        </footer>
                    </blockquote>
                </div>
                <div class="card bg-success text-center p-3 ">

                    <blockquote class="blockquote mb-0">
                        <h2 id="IyilesenText" class="text-white">1</h2>
                        <footer class="blockquote-footerr">
                            <p class="text-white">iyileşen vaka sayısı

                            </p>
                        </footer>
                    </blockquote>
                </div>
            </div>



        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Update the information
                        <button onclick="loadData();return false" type="submit" class="btn btn-info mb-2" style=" float: right; ">
                            <i style=" color: #fff; font-size: 1.5em; " class="zmdi zmdi-refresh zmdi-hc-fw"></i>
                        </button>
                    </h5>
                    <div class="card-body">
                        <form class="form-inline" onsubmit="AddStatistics();return false">




                            <div class="input-group mb-2 mr-sm-2">

                                <input type="number" class="form-control" id="olumlerinInput" placeholder="ölümlerin sayısı">
                            </div>




                            <div class="input-group mb-2 mr-sm-2">

                                <input type="number" class="form-control" id="vakaInput" placeholder="vaka sayısı">
                            </div>
                            <div class="input-group mb-2 mr-sm-2">

                                <input type="number" class="form-control" id="iyilesenInput" placeholder="iyileşen vaka sayısı">
                            </div>
                            <button type="submit" class="btn btn-warning mb-2">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END PAGE CONTENT -->


    <script>

    setTimeout(function(){
        loadData();
    }, 1000);


    function loadData() {
        var token = "{{ csrf_token() }}";
        $.post("{{route('LoadAllStatisticsGeneral') }}",{'_token':token},function(c){
            var ResData = c.LoadAllStatisticsGeneral.data;
                $('#OlumlerinText').text(ResData.Deaths);
                $('#VakaText').text(ResData.Active);
                $('#IyilesenText').text(ResData.Recovered);
        },'json');
    }



    function AddStatistics() {
        var olumlerin = $("#olumlerinInput").val(),
            vaka = $("#vakaInput").val(),
            iyilesen = $("#iyilesenInput").val(),
            token = "{{ csrf_token() }}",
            res = '';
        if(olumlerin !== '' && vaka !=='' && iyilesen !==''){
            $.post("{{route('AddNewStatisticsGeneral') }}",
                {
                    '_token':token,
                    'AddNewStatisticsGeneralDeaths':olumlerin,
                    'AddNewStatisticsGeneralActive':vaka,
                    'AddNewStatisticsGeneralRecovered':iyilesen
                }
                ,function(c){
                if(c.AddNewStatisticsGeneral.stauts == 'ok'){
                    var olumlerin = $("#olumlerinInput").val(''),
                        vaka = $("#vakaInput").val(''),
                        iyilesen = $("#iyilesenInput").val('');
                    Swal.fire(
                        'Added successfully',
                        '',
                        'success'
                    )
                    loadData();
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
@endsection