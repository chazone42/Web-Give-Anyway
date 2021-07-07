@extends('layouts.app')

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('dropzone-5.7.0\dist\dropzone.css') }}">
    <style>
        h3{
            font-family: 'Mitr', sans-serif;
            color: #f26d7d;
        }
        h5,span,p,label{
            font-family: 'Mitr', sans-serif;
        }

        #set-wl{
            width: 30%;
        }
        #set-wr{
            width: 70%;
        }
        .fa{
            color: #f26d7d;
        }
        #btn-confirm{
            background-color: #f26d7d;
            color: white;
            font-family: 'Mitr', sans-serif;
            padding-left: 50px;
            padding-right: 50px;
        }

    </style>
@endsection

@section('content')
    <div class="container bg-light pt-2">
        <div class="row mt-5">
            <div class="col">
                <h3>รายการถอนเงิน</h3>
            </div>
        </div>

    </div>
    <div class="row pb-4">
        <div class="container shadow-sm rounded p-4 bg-white">

            <form action="{{ route('save_withdraw') }}" method="POST">
                @csrf
                <div class="float-left pt-4 pl-5 border-right" id="set-wl">
                    <h5>รายการที่ต้องทำการชี้แจง</h5>
                    <div class="pb-3">
                        @foreach ($donate as $item)
                            <div class="col">
                                @foreach ($item as $thing)
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="donate" id="donate_{{ $thing['id'] }}" value="{{ $thing['id'] }}">
                                            <label class="form-check-label" for="donate_{{ $thing['id'] }}">
                                                <span>จำนวนเงิน : {{number_format($thing['sum'] ),2 }}</span><br>
                                                <p>วันที่ถอนเงิน : {{ $thing['date'] }}</p>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <h5>รายการที่ทำการชี้แจงแล้ว</h5>
                    <div class="">
                        @foreach ($used as $item)
                            <div class="col">
                                @foreach ($item as $thing)
                                    {{--                                <div class="col">--}}
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="donate" id="donate_{{
                                        $thing['withdraw_id'] }}" value="{{ $thing['withdraw_id'] }}" disabled>
                                        <label class="form-check-label text-dark" for="donate_{{ $thing['withdraw_id'] }}">
                                            {{--                                            {{ $thing['sum'] }} --}}
                                            <span><i class="fa fa-check-circle"></i> จำนวนเงิน : {{number_format($thing['sum'] ),2 }}</span><br>
                                            <p type="date">วันที่ชี้แจง : {{ $thing['date'] }}</p>
                                        </label>
                                    </div>
                                    {{--                                </div>--}}
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="float-right pt-4 pl-5" id="set-wr">
                    <h5>โปรดใส่เนื้อหาและรูปภาพ</h5>
                    <div class="row mb-3 w-100 pl-3">
                        <div class="col">
                            <label>เลือกรูปภาพ</label><span class="text-danger"> *</span>
                            <div class="border rounded bg-light p-4" id='attrachments'>
                                <p class='text-muted'>ลากไฟล์มาวางหรือกดเพื่อเลือกไฟล์</p>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 pl-3">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1"
                                       class="form-label">รายละเอียดเพิ่มเติม</label><span class="text-danger"> *</span>
                                <textarea class="form-control" name='des' id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="col text-right">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            <input type="submit" value='ยืนยัน' class="btn" id="btn-confirm">
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('dropzone-5.7.0\dist\dropzone.js') }}"></script>
    <script>
        var attrachments = new Dropzone("#attrachments", { url: "/UploadImage", method: 'POST', maxFiles:1,
            init: function () {
                this.on("sending", function (file, xhr, data) {
                    data.append('_token', "{{ csrf_token() }}");
                    data.append('eleid', "attrachments");
                    $('#attrachments').after("<input type='hidden' name='file_attrachments[]' value='"+file.name+"'>");
                })
            }
        });
    </script>
@endsection
