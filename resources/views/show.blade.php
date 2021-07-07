@extends('layouts.app')

<style>
    * {
        box-sizing: border-box;
    }
    a { text-decoration: none; }
    .center-cropped {
        width: 540px;
        height: 420px;
        overflow:hidden;
        border-radius: 5px;
    }
    .center-cropped img {
        height: 100%;
        min-width: 100%;
        left: 50%;
        position: relative;
        transform: translateX(-50%);
    }
    .title, table{
        font-family: 'Mitr', sans-serif;
    }
    .text-detail{
        font-family: 'Taviraj', sans-serif;
    }
    .text-normal{
        font-family: 'Mitr', sans-serif;
    }
    .f{
        font-size: 30px;
        color: #b7b7b7;
    }
    .text-contxt{
        font-family: 'Mitr', sans-serif;
        font-size: 14px;
        color: #b7b7b7;
    }
    div.sticky {
        position: -webkit-sticky;
        position: sticky;
    }
    .stick-txt{
        padding: 20px 5px 20px 20px;
        border-radius: 3px;
        border-color: #f26d7d;
        border-style: solid;
    }
    .txt-title h4{
        color: #f26d7d;
        font-family: 'Mitr', sans-serif;
    }
    .cont-box{
        height: 500px;
        border-radius: 3px;
        border-color: #b7b7b7;
        border-style: solid;
    }
    button.stick-but-txt{
        background-color: #f26d7d;
        text-align:center;
        color: white;
        font-size: 18px;
        font-family: 'Mitr', sans-serif;
    }
    .plantxt h5{
        color: black;
        font-family: 'Mitr', sans-serif;
    }
    .plantxt p {
        color: black;
        font-family: 'Taviraj', sans-serif;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
    }
    #prevBtn {
        background-color: #1b4b72;
    }
    .step {
        height: 8px;
        width: 8px;
        margin: 0 2px;
        background-color: #f26d7d;
        border: none;
        border-radius: 50%;
        display: inline-block;
    }
    .step.active {
        opacity: 1;
    }
    .step.finish {
        background-color: #1b4b72;
    }
    .image-box{
        float: left;
        width: 50%;
    }
    .image-box-sm{
        width: 100%;
    }
    .image-box-r{
        float: right;
        width: 50%;
        padding-left: 3%;
    }
    .detail-box{
        width: 75%;
    }
    .sticky-box{
        width: 25%;
        padding-left: 2%;
    }
    .shadow-box{
        -webkit-box-shadow: 0px 0px 11px 3px rgba(0,0,0,0.08);
        box-shadow: 0px 0px 11px 3px rgba(0,0,0,0.08);
    }
    span{
        font-family: 'Mitr', sans-serif;
    }
    #btn-evii{
        color: white;
        background-color: #223964;
        border-radius: 3px;
        font-family: 'Mitr', sans-serif;
        font-size: 14px;
        border: none;
        transition: 0.3s;
    }
    #btn-report{
        color: white;
        background-color: #f26d7d;
        border-radius: 3px;
        font-family: 'Mitr', sans-serif;
        font-size: 14px;
        border: none;
        transition: 0.3s;
    }
    .contain{
        display: block;
        position: relative;
        cursor: pointer;
        border: 1px solid lightgray;
        padding-top: 10px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .contain h5{
        color: black;
        font-family: 'Mitr', sans-serif;
    }

    .contain:hover{
        border: 1px solid #f26d7d;
    }

    /* Hide the browser's default radio button */
    .contain input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
        position: absolute;
        top: 10px;
        left: 20px;
        height: 20px;
        width: 20px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .contain:hover input ~ .checkmark {
        background-color: grey;
    }

    /* When the radio button is checked, add a blue background */
    .contain input:checked ~ .checkmark {
        background-color: #f26d7d;

    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .contain input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .contain .checkmark:after {
        top: 6px;
        left: 6px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }
    #title-report, #txt-title-don{
        font-family: 'Mitr', sans-serif;
        color: #f26d7d;
    }
    #detail-report{
        font-family: 'Mitr', sans-serif;
        color: #f26d7d;
    }
    #home-tab, #profile-tab{
        color: #f26d7d;
        font-family: 'Mitr', sans-serif;
        font-size: 18px;
    }
    u:hover{
        color: #1b4b72;
        transition: 0.3s;;
    }
    div h5{
        color: #1b4b72;
        font-family: 'Mitr', sans-serif;
    }
    @media  (max-width: 991.98px)  {
        .image-box{
            width: 98%;
        }
        .image-box-sm{
            width: 25%;
        }
        .image-box-r{
            width: 100%;
        }
        div.sticky {
            position: relative;
        }
        .detail-box{
            width: 100%;
        }
        .sticky-box{
            width: 100%;
        }

    }
</style>

@section('content')


    <div class="bg-white">
        <div class="container pt-4 pb-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    @foreach($stepforms as $stepform)
                        @foreach($vwshows as $vwshow)
                        <div class="row">
                            <div class="image-box" >
                                <img src="{{ url('image/'.$gallery[0]->imageName) }}" class="img-fluid rounded">
                                <div class='row mt-2 image-box-sm'>
                                    @foreach ($gallery as $item)
                                        <div class='col-lg-2'>
                                            <a href="{{ url('image/'.$item->imageName) }}" data-toggle="modal" data-name="{{ $item->imageName }}" class="col-md-4">
                                                <img src="{{ url('image/'.$item->imageName) }}" class="img-fluid">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="image-box-r">
                                @if($stepform->status == 3)
                                    <div class="alert alert-danger" role="alert" style="font-family: 'Mitr', sans-serif;">
                                        <h4 class="alert-heading" style="font-family: 'Mitr', sans-serif;">โครงการนี้อยู่ระหว่างตรวจสอบ ไม่สามารถร่วมบริจาคได้</h4>
                                        <p>เนื่องจากไก้รับรายงานจากผูใช้จำนวนหนึ่ง
                                            จึงต้องทำการตรวจสอบเพิ่อความปลอดภัยในการบริจาคของทุกท่าน</p>

                                    </div>
                                @endif
                                <h3 class="title">{{ $stepform->projectname }}</h3>
                                <p class="text-detail">{{ $stepform->detail }}</p>
                                    <div class="align-text-bottom mt-4 text-normal">
                                    <p>วัตถุประสงค์ {{ $stepform->object }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-2">
                            <div class="text-contxt">
                                <span class="f"><i class="fa fa-phone-square w"></i></span> {{ $stepform->tel }}<br>
                                <span class="f"><i class="fa fa-envelope-square"></i></span> {{ $stepform->email }}
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="detail-box">
                                <div class="txt-title" style="color: #f26d7d">
                                    <h4 style="font-family: 'Mitr', sans-serif">รายละเอียด</h4>
                                </div>
                                <div class="bg-white p-4 rounded shadow-box">
                                    <h6 style="font-family: 'Mitr', sans-serif">เป้าหมาย</h6>
                                    <span style="color: #f26d7d">{{number_format($vwshow->total_receive ),2 }} บาท</span>
                                    <span class="float-right">{{number_format($stepform->sum ),2 }} บาท</span>
                                    <div class="progress mt-1 mb-1" >
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{($vwshow->total_receive/$vwshow->sum*100) }}%;background-color: #f26d7d"
                                             aria-valuemin="0"></div>
                                    </div>
                                    <span>สำเร็จแล้ว {{ number_format($vwshow->total_receive/$vwshow->sum*100)  }} %</span><br>
                                    <span>จากผู้ร่วมบริจาค {{number_format($vwshow->total_count ),2 }} คน</span>
                                </div>
                                <div class="pt-4">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                               role="tab" aria-controls="การใช้เงิน" aria-selected="true">การใช้เงิน</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                               role="tab" aria-controls="profile"
                                               aria-selected="false">แผนการใช้เงิน</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="w-100 p-4 border-right border-bottom border-left rounded">
                                                @foreach ($statement as $item)
                                                    <div class="row no-gutters">
                                                        <div class="col-md-9">
                                                            <h5 style="color: black; font-family: 'Mitr',sans-serif">วันที่ : {{ $item['date'] }}</h5>
                                                            <p class="text-break" style="color: black;
                                                                    font-family: 'Taviraj', sans-serif">{{ $item['des'] }}</p>
                                                        </div>
                                                        <div class="col-md-3 text-md-right">
                                                            <dt class="d-inline" style="font-family: 'Mitr', sans-serif;color: black;">เงินออก</dt>
                                                            <dd class="d-inline mt-1 ml-2 mr-2 mb-1" style="font-family: 'Mitr',
                                                                           sans-serif; color: black">{{ $item['sum']}} ฿</dd>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                                <span style="cursor:pointer" data-toggle="modal"
                                                                      data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-thumbs-down"></i>
                                                                    <u>ฉันคิดว่าหลักฐานที่นำมาชี้แจงไม่น่าเชื่อถือ</u></span>
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">แจ้งหลักฐานไม่น่าเชื่อถือ</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-row pl-3 pr-3">
                                                                                <label>โปรดบอกรายละเอียดเพิ่มเติม</label><br>
                                                                                <div class="col-12">
                                                                                    <input type="text" class="form-control"
                                                                                           name="comment[]"
                                                                                           id="txtvalue"
                                                                                           placeholder="ความคิดเห็นของคุณ"></div>

                                                                                <div class="col-10">
                                                                                    <div class="input-group mt-1
                                                                                    input-group-sm">
                                                                                        <div class="input-group-prepend">
                                                                                            <label
                                                                                                class="input-group-text"
                                                                                                for="inputGroupSelect01">ตัวเลือกเพิ่มเติม</label>
                                                                                        </div>
                                                                                        <select class="custom-select"
                                                                                                id="ddselect"
                                                                                                id="inputGroupSelect01"
                                                                                                onchange="ddlselect();">
                                                                                            <option>หลักฐานที่นำมาชี้แจงไม่มีอยู่จริง</option>
                                                                                            <option>หลักฐานที่นำมาชี้แจงไม่ตรงกับยอดเงินที่ใช้</option>
                                                                                            <option>หลักฐานที่นำมาชี้แจงไม่ชัดเจน</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <input type="button" role="post" value="ส่ง"
                                                                                   data-target="{{ $item->id }}"
                                                                                   data-url="{{ route('add_comment') }}"
                                                                                   class="ml-2 pt-2 pl-5 pb-2
                                                                               pr-5 " id="btn-evii">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 pl-5">
                                                            @foreach ($comment[$item->id] as $key => $item)
                                                                <br><i class="fa fa-angle-right"></i> <span
                                                                    class="text-dark">  {{ $item->name }} <span
                                                                        class="text-muted">เมื่อ {{$item->created_at }}</span></span><br>
                                                                <span class="text-dark">แสดงความคิดเห็น {{$item->message }}</span>

                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="w-100 p-4 border-right border-bottom border-left rounded">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>รายการ</th>
                                                        <th>จำนวนเงิน</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($plan as $item)
                                                        <tr>
                                                            <td>
                                                                {{$item->list}}
                                                            </td>
                                                            <td>
                                                                {{number_format($item->qty),2}} บาท
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> {{-- col-9--}}

                            <div class="sticky-box">
                                <div class="sticky">
                                    <div class="stick-txt">
                                        <p class="text-normal">ได้รับแล้ว</p>
                                        <h4 class="title" style="color: #f26d7d">{{number_format($vwshow->total_receive ),2 }} บาท</h4>
                                        <p class="text-normal">ยอดที่ต้องการ<br>
                                            {{ number_format($stepform->sum),2 }} บาท</p>
                                        <p class="text-normal">สิ้นสุดวันที่<br>
                                            {{ $vwshow->endat }} </p>
                                        <p class="text-normal">เหลือเวลาอีก<br>
                                            {{ $vwshow->timetoend }} วัน </p>
                                    </div>
                                    <button type="button"
                                            class="btn mt-2 w-100 stick-but-txt"
                                            data-toggle="modal"
                                            data-target="#exampleModalCenter1"
                                            @if ($stepform->status == 3)
                                                disabled
                                            @endif>
                                        ร่วมบริจาค
                                    </button>
                                    <button type="button" class="btn mt-2 w-100 bg-secondary stick-but-txt"
                                            data-toggle="modal" data-target="#report_module"
                                            @if ($stepform->status == 3)
                                                disabled
                                            @endif>
                                        รายงานความไม่เหมาะสม
                                    </button>
                                    <div>
                                        <p>@if ($stepform->status == 3)
                                                มีการร่วมรายงานความไม่เหมาะสมโครงการ 1 ครั้ง</p>@endif
                                    </div>



                                </div>
                                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <h5 class="modal-title text-dark title">บริจาคให้กับ
                                                    <br><label id="txt-title-don">{{$stepform->projectname}}</label></h5>
                                                <span class="txt-detail-don">ชื่อบัญชี : {{ $stepform->namebank}}</span><br>
                                                <span class="txt-detail-don">เลขที่บัญชี : {{ $stepform->numberbank}}</span><br>
                                                <span class="txt-detail-don">ธนาคาร : {{ $stepform->bank }}</span><hr>
{{--                                                @foreach($dat2 as $qrcode)--}}
{{--                                                 {!! QrCode::size(200)->generate($qrcode->tel); !!}--}}
{{--                                                @endforeach--}}

{{--                                                {!! $dat2!!}--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="report_module" tabindex="-1"
                                     role="dialog" aria-labelledby="report_module" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4 class="modal-title text-center pt-1 pb-1"
                                                    id="title-report">รายงานความไม่เหมาะสม</h4>
{{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                    <span aria-hidden="true">&times;</span>--}}
{{--                                                </button>--}}
                                                <form action="{{ route('report') }}" method="POST" class="p-3">
                                                    @csrf
                                                    <label class="contain pl-5 rounded "><h5>รายงานโครงการไม่เหมาะสม</h5>
                                                        <p class="text-muted check-mark
                                                        pr-2">โครงการนี้มีเนื้อหาไม่เหมาะสม,
                                                            โครงการนี้ไม่ใช่ของจริง,
                                                            โครงการนี้มีเนื้อหาไม่สมเหตุสมผล,
                                                            หลักฐานที่แนบมาไม่ใช่ของจริง</p>
                                                        <input type="radio" checked="checked" name="mreport"
                                                               value='1' id="mreport1">
                                                        <span class="checkmark" for="mreport1"></span>
                                                    </label>

                                                    <label class="contain pl-5 rounded"><h5>รายงานผู้ใช้ไม่เหมาะสม</h5>
                                                        <p class="text-muted check-mark">ผู้ใช้งานนี้ไม่มีอยู่จริง,
                                                            ผู้ใช้รายน้ีแอบอ้างเป็นผู้อื่น</p>
                                                        <input type="radio" name="mreport" value='2' id="mreport2">
                                                        <span class="checkmark" for="mreport2"></span>
                                                    </label>
                                                    <div class="form-group mt-2">
                                                        <h5 for="remark_report" id="detail-report">รายละเอียดเพิ่มเติม</h5>
                                                        <textarea class="form-control" name="remark_report" rows="3"></textarea>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col">
                                                            <input type="hidden" name="project_id" value={{ $stepform->id }}>
                                                            <input type="submit" class="pt-2 pl-5 pb-2
                                                            pr-5 float-right" id="btn-report"
                                                                   value="เสร็จสิ้น">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
        <div id='popup-img' class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="modalClose()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){
            $('a[data-toggle="modal"]').click(function (event){
                event.preventDefault();
                var title = $(this).data('name');
                var source = $(this).attr('href');
                $('#popup-img').find(".modal-title").text(title);
                $('#popup-img').find(".modal-body").html('<center><img src="'+source+'" class="image-fluid w-75' +
                    '"/></center>');
                $('#popup-img').modal('show');
            });
            $('input[type=button][role=post]').click(function () {
                let i = $('input[type=button][role=post]').index($(this));
                console.log({
                        '_token': $('input[type=hidden][name="_token"]').val(),
                        'comment': $('input[name=comment]').eq(i).val(),
                        'stmtid': $(this).data('target')
                    });
                $.ajax({
                    method: 'POST',
                    url: $(this).data('url'),
                    data: {
                        '_token': $('input[type=hidden][name="_token"]').val(),
                        'comment': $('input[name="comment[]"]').eq(i).val(),
                        'stmtid': $(this).data('target')
                    }
                }).done(function (res) {
                    if (res.comment == true) {
                        window.location.reload();
                    } else {
                        alert(res.msg);
                    }
                });
            });
        });
        function modalClose(){
            $('#popup-img').modal('hide');
        }

        function ddlselect() {
            var d=document.getElementById("ddselect");
            var displaytext=d.options[d.selectedIndex].text;
            document.getElementById("txtvalue").value=displaytext;
        }

    </script>
@endsection
