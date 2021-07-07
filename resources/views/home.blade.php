@extends('layouts.app')

<style>

    .card-detail{
        font-family: 'Mitr', sans-serif;
    }
    .card-detail2 h5{
        font-family: 'Mitr', sans-serif;
    }
    .card-detail2 p{
        font-family: 'Taviraj', sans-serif;
    }
    .crop-text {
        -webkit-line-clamp: 3;
        overflow : hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
    .crop-title {
        -webkit-line-clamp: 2;
        overflow : hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
    .card:hover{
        border: 1px solid #f26d7d;
    }

    .ban-title h3, small{
        font-family: 'Mitr', sans-serif;
        color: white;
    }
    .ban-detail p{
        font-family: 'Taviraj', sans-serif;
        color: white;
    }
    .ban-update h5{
        color: white;
        font-family: 'Mitr', sans-serif;
    }
    .but-more{
        color: black;
        background-color: white;
        border-radius: 3px;
        font-family: 'Mitr', sans-serif;
        font-size: 14px;
        border: none;
    }
    .left{
        width: 40%;
        float: left;
        background-color: #223964;
        padding-left: 80px;
    }
    .right{
        width: 60%;
        float: right
    }
    .btn-cate{
        color: grey;
        background-color: white;
        border-radius: 3px;
        font-family: 'Mitr', sans-serif;
        font-size: 14px;
        border: none;
        transition: 0.3s;
    }
    .btn-cate:hover{
        color: white;
        background-color: #f26d7d;
        border-radius: 3px;
        font-family: 'Mitr', sans-serif;
        font-size: 14px;
        border: none;
    }
    .cate-active{
        background-color: #f26d7d;
        color: white;
    }

    @media (max-width: 991.98px)  {
        .left{
            width: 100%;
        }
    }


</style>


@section('content')
    {{--    <canvas id="myChart" width="400" height="400"></canvas>--}}
    <div class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach($ads as $stepform)
                    <div class="carousel-item @if($loop->first) active @endif">
                        <div class="left pt-5 pr-5 pb-5" style="height:23.3rem;">
                            <div class="ban-title">
                                <h3 class="crop-title">{{ $stepform->projectname }}</h3>
                            </div>
                            <div class="ban-detail d-none d-sm-block">
                                <p class=" crop-text">{{ $stepform->detail }}</p>
                            </div>
                            <div class="pt-3 ban-update">
                                <h5>ได้รับ {{number_format($stepform->total_receive ),2 }} บาทแล้ว</h5>
                                <small>ยอดรวมเมื่อวันที่ 18/08/63</small>
                            </div>
                            <div><a href="{{ action('PostController@show', $stepform->id) }}">
                                    <button class="but-more mt-3 pt-1 pl-4 pb-1 pr-4">อ่านเพิ่มเติม</button></a>
                            </div>
                        </div>
                        <div class="right d-none d-lg-block" style="background-color: #f26d7d;height:23.3rem;">
                            <img class="card-img-top" src="{{ url('image/'.$stepform->imageName) }}" style="width:
                            60rem">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    <div class="container pt-4">


        <div class="row justify-content-center">
            <div class="btn-toolbar" >
                <div class="cate">
                    <button type="button" class="btn-cate mb-2 mr-3 pt-1 pl-4 pb-1 pr-4 cate-active"
                            data-target="all">ทั้งหมด</button>
                    @foreach ($cate as $key => $item)
                        <button type="button" class="btn-cate mr-3 pt-1 pl-4 pb-1 pr-4" data-target="{{ $key }}">{{ $item }}</button>
                    @endforeach
                    <button type="button" class="btn-cate mt-2 mr-3 pt-1 pl-4 pb-1 pr-4"
                            data-target="close">ใกล้ปิด</button>
                    <button type="button" class="btn-cate mt-2 mr-3 pt-1 pl-4 pb-1 pr-4"
                            data-target="halfPercent">ยังไม่ถึง 50%</button>
                </div>
            </div>
            <div class="col-md-12">

                {{--                @if(session('success_message'))--}}
                {{--                    <div class="alert alert-success">--}}
                {{--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
                {{--                            <span aria-hidden="true">&times;</span>--}}
                {{--                        </button>--}}
                {{--                        {{session('success_message')}}--}}
                {{--                    </div>--}}
                {{--                @endif--}}


                <div class="row justify-content-center">
                    @foreach($vwshows as $stepform)

                        <a href="{{ action('PostController@show', $stepform->id) }}" data-target-to='{{ $stepform->cate }}' class="card-deck m-1 mb-4"
                           style="text-decoration: none; color: inherit">

                            <div class="card" style="width: 20rem;">
                                @if ($stepform->status == 2 || $stepform->status == 4|| $stepform->status == 5)
                                    <img class="card-img-top" src="{{ url('image/'.$stepform->imageName) }}"
                                         style="height:
                                    13rem;">
                                @elseif ($stepform->status == 3 )
                                    <img class="card-img-top" src="banner/sus.png">
                                @endif

                                <div class="progress " style="border-radius: 0; height: 8px;">
                                    @if ($stepform->status == 2 || $stepform->status == 4|| $stepform->status == 5)
                                        <div class="progress-bar" role="progressbar" style="width: {{($stepform->total_receive/$stepform->sum*100) }}%;background-color: #f26d7d"

                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    @elseif ($stepform->status == 3)
                                        <div class="progress-bar" role="progressbar" style="background: #b1b1b1"
                                             aria-valuenow="70"
                                             aria-valuemin="0" aria-valuemax="100"></div>

                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="card-detail">
                                        <div class="w-50 border-bottom" style="float: left">
                                            @if ($stepform->status == 2 || $stepform->status == 5)
                                                <p>ได้รับแล้ว<br>{{number_format($stepform->total_receive ),2 }} บาท</p>
                                            @elseif ($stepform->status == 3 || $stepform->status == 4)
                                                <p class="text-muted">ได้รับแล้ว<br>{{number_format($stepform->total_receive ),2 }} บาท</p>
                                            @endif
                                        </div>
                                        <div class="w-50 border-bottom" style="float:right;  text-align: right;">
                                            @if ($stepform->status == 2 || $stepform->status == 5)
                                                <p>ยอดที่ต้องการ<br>{{number_format($stepform->sum),2 }} บาท</p>
                                            @elseif ($stepform->status == 3 || $stepform->status == 4)
                                                <p class="text-muted">ยอดที่ต้องการ<br>{{number_format($stepform->sum),2 }} บาท</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-detail2" style="padding-top: 70px;">
                                        <h5 class="card-title crop-title">{{ $stepform->projectname }}</h5>
                                        <p class="card-text crop-text">{{ $stepform->detail }}</p>
                                    </div>
                                </div>
                                <div class="card-footer" style="color: #f26d7d; font-family: 'Mitr', sans-serif">

                                    @if ($stepform->status == 2 || $stepform->status == 5 )
                                        <span class="text"> เหลือเวลาอีก วัน
                                           {{ $stepform->timetoend }}
                                        </span>
                                    @elseif ($stepform->status == 3 || $stepform->status == 4)
                                        <span class="text"> เหลือเวลาอีก {{ $stepform->timetoend }} วัน</span>
                                    @endif


                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('div.cate button').click(function () {
                let click = $(this).data('target');
                $('div.cate button').removeClass('cate-active');
                $(this).addClass('cate-active');
                $.each($('a[data-target-to]'), function () {
                    if (click == 'all') {
                        $('a[data-target-to]').show();
                    } else if (click == $(this).data('target-to')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endsection
