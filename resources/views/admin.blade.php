@extends('layouts.adminapp')

@section('styles')
    <style>
        .fix-table1 {
            width: 7rem;
        }
        #fix-table2 {
            width: 20rem;
        }
        #fix-table3 {
            width: 15rem;
        }

    </style>

@endsection

@section('content')
    <div class="container">
        <div class="col-12">
            <h4>โครงการทั้งหมด</h4>
            <div class="row justify-content-start">
                {{--                @foreach($vw_shows as $vw_show)--}}
                {{--                    <p>{{ $vw_show->startat }}<br>{{ $vw_show->endat }}</p>--}}
                {{--                @endforeach--}}
                @foreach($vw_shows as $stepform)
                    {{--                    <img class="card-img-top" src="{{ url('image/'.$stepform->pjimg) }}" style="height:--}}
                    {{--                                    13rem;">--}}
                    <div @if ($stepform->status == 2) class="rounded border bg-white border-primary pt-2 pr-2 pl-2 mb-3 pb-0 w-100"
                         @elseif ($stepform->status == 3) class="rounded border border-warning bg-white pt-2 pr-2
                         pl-2 mb-3 pb-0 w-100"
                         @elseif ($stepform->status == 5) class="rounded border border-success bg-white pt-2 pr-2 pl-2 mb-3 pb-0 w-100"
                        @endif>
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">วันที่</th>
                                <th scope="col">ชื่อโครงการ</th>
                                <th scope="col">จำนวนเงิน</th>
                                <th scope="col">คืบหน้า</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ $stepform->id }}</th>
                                <td class="fix-table1"><p>
                                        {{ $stepform->startat}} <br>{{ $stepform->endat }}</p></td>
                                <td id="fix-table2"><p>{{ $stepform->projectname }}</p></td>
                                <td class="fix-table1"><p>{{number_format($stepform->total_receive),2 }}฿ จาก<br>
                                        {{number_format($stepform->sum),2 }} ฿</p></td>
                                <td class="fix-table1">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{($stepform->total_receive/$stepform->sum*100) }}%;
                                            background-color: #f26d7d" aria-valuemin="0"
                                             aria-valuemax="100">{{
                                             ($stepform->total_receive/$stepform->sum*100) }}%</div>
                                    </div>
                                </td>
                                <td class="fix-table1">@if ($stepform->status == 2)
                                        <h6><span class="badge badge-info">Normal</span></h6>
                                    @elseif($stepform->status == 3)
                                        <h6><span class="badge badge-warning">Suspend</span></h6>
                                    @elseif($stepform->status == 4)
                                        <h6><span class="badge badge-danger">Close</span></h6>
                                    @elseif($stepform->status == 5)
                                        <h6><span class="badge badge-success">Ads</span></h6>
                                    @endif</td>
                                <td id="fix-table3">
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group btn-group-sm mb-1" role="group" aria-label="First group">
                                            <button type="button" class="btn btn-outline-dark"><i class="fa
                                            fa-user-circle"></i></button>
                                            <button type="button" class="btn btn-outline-success"><i class="fa
                                            fa-list-alt"></i></button>
                                            <button type="button" class="btn btn-outline-primary"><i class="fa fa-eye"></i></button>
                                            <button type="button" class="btn btn-outline-secondary">Ad</button>
                                        </div>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Second group">
                                            <a href="{{ "admin/edit/".$stepform->id}}" type="button" class="btn btn-primary">แก้ไข</a>
                                            <button type="button" class="btn btn-warning">ระงับ</button>
                                            <button type="button" class="btn btn-danger">ปิด</button>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            </tbody>
                        </table>

                    </div>

                    {{--                    <div class="card mr-3 mb-3" style="width: 20rem;">--}}
                    {{--                        @if ($stepform->status == 2 || $stepform->status == 4|| $stepform->status == 5)--}}
                    {{--                            <img class="card-img-top" src="{{ url('image/'.$stepform->pjimg) }}" style="height:--}}
                    {{--                                    13rem;">--}}
                    {{--                        @elseif ($stepform->status == 3 )--}}
                    {{--                            <img class="card-img-top" src="banner/sus.png">--}}
                    {{--                        @endif--}}

                    {{--                        <div class="card-body">--}}
                    {{--                            <div class="card-detail">--}}
                    {{--                                <div class="w-50 border-bottom" style="float: left">--}}
                    {{--                                    @if ($stepform->status == 2 || $stepform->status == 5)--}}
                    {{--                                        <p>ได้รับแล้ว<br>300,000 บาท</p>--}}
                    {{--                                    @elseif ($stepform->status == 3 || $stepform->status == 4)--}}
                    {{--                                        <p class="text-muted">ได้รับแล้ว<br>300,000 บาท</p>--}}
                    {{--                                    @endif--}}
                    {{--                                </div>--}}
                    {{--                                <div class="w-50 border-bottom" style="float:right;  text-align: right;">--}}
                    {{--                                    @if ($stepform->status == 2 || $stepform->status == 5)--}}
                    {{--                                        <p>ยอดที่ต้องการ<br>{{number_format($stepform->sum),2 }} บาท</p>--}}
                    {{--                                    @elseif ($stepform->status == 3 || $stepform->status == 4)--}}
                    {{--                                        <p class="text-muted">ยอดที่ต้องการ<br>{{number_format($stepform->sum),2 }} บาท</p>--}}
                    {{--                                    @endif--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                            <div class="card-detail2" style="padding-top: 70px;">--}}
                    {{--                                <h5 class="card-title">{{ $stepform->projectname }}</h5>--}}
                    {{--                                @if ($stepform->status == 2)--}}
                    {{--                                    <h4>สถานะ <span class="badge badge-info">Normal</span></h4>--}}
                    {{--                                @elseif($stepform->status == 3)--}}
                    {{--                                    <h4>สถานะ <span class="badge badge-warning">Suspend</span></h4>--}}
                    {{--                                @elseif($stepform->status == 4)--}}
                    {{--                                    <h4>สถานะ <span class="badge badge-danger">Close</span></h4>--}}
                    {{--                                @elseif($stepform->status == 5)--}}
                    {{--                                    <h4>สถานะ <span class="badge badge-success">Ads</span></h4>--}}
                    {{--                                    @endif--}}

                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-footer text-md-center">--}}
                    {{--                            <a class="btn btn-outline-info" href="{{ "admin/edit/".$stepform->id}}" role="button">--}}
                    {{--                                <i class="fa fa-edit"></i> แก้ไข</a>--}}
                    {{--                            <a class="btn btn-outline-success" href="#" role="button">--}}
                    {{--                                <i class="fa fa-flag"></i> ระงับ</a>--}}
                    {{--                            <a class="btn btn-outline-danger" href="#" role="button">--}}
                    {{--                                <i class="fa fa-times-circle"></i> ปิด</a>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                @endforeach
            </div>
        </div>
    </div>




@endsection
