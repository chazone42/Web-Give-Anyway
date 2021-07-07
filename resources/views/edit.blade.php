@extends('layouts.adminapp')

@section('styles')
    <link rel="stylesheet" href="{{ asset('dropzone-5.7.0\dist\dropzone.css') }}">
    <style>
        .step-form {
            font-family: 'Mitr', sans-serif;
        }

        .form-section {
            display: none;
        }

        .form-section.current {
            display: inherit;
        }

        .condi1 {
            background-color: white;
            padding-top: 30px;
            padding-left: 20px;
            padding-bottom: 20px;
            border-radius: 5px;
        }

        .condi1 h5 {
            color: #f26d7d;
            font-family: 'Mitr', sans-serif;
        }

        .condi2 h5 {
            color: white;
            font-family: 'Mitr', sans-serif;
        }

        .condi-ti h4 {
            color: black;
            font-family: 'Mitr', sans-serif;
        }

        .condi2 {
            padding: 30px 20px 20px 20px;
            border-radius: 5px;
            background-color: #223964;
        }

        .condi2 h5 {
            color: white;
        }

        .condi2 ol {
            color: white;
        }

        .form-navigation button {
            background-color: #f26d7d;
            color: white;
        }

        .step-info {
            color: white;
            background-color: #223963;
            border-radius: 3px;

        }
        .act {
            background-color: #f26d7d;
        }
        .condi-le{
            float: left;
            width: 48%;
        }
        .condi-ri{
            float: right;
            width: 50%;
        }
        .box-section{
            width: 50%;
        }


        @media (max-width: 1199.98px)  {
            .condi-le{
                width: 100%;
            }
            .condi-ri{
                width: 100%;
            }
            .box-section{
                width: 90%;
            }
        }
    </style>

@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <form action="/admin/edit" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$post['id'] }}">
                    <div class="col-12 mt-4 pt-4 pb-4" style="border-radius: 5px;">
                        <h4 class="text-center" style="font-family: 'Mitr', sans-serif">แก้ไขโครงการ</h4>
                        <div class="row bg-white rounded p-5">
                            <h4>รายละเอียดโครงการ</h4>
                            <div class="col-12">
                                <label>ชื่อโครงการ</label>
                                <input type="text" class="form-control" name="projectname"
                                       value="{{$post['projectname']}}" >

                                <label class="mt-3">รายละเอียดโครงการ</label>
                                <textarea type="text" class="form-control md-textarea" name="detail"
                                          value="{{$post['detail']}}" length="120">{{$post['detail']}}</textarea>

                                <label class="mt-3">วัตถุประสงค์</label>
                                <input type="text" id="validationCustom03" class="form-control"
                                       placeholder="ระบุวัตถุประสงค์" name="object"
                                       value="{{$post['object']}}" >

                                <div class="row mt-3">
                                    <div class="col">
                                        <label>วันที่เริ่มเรี่ยไร</label>
                                        <input type="date" class="form-control" name="startat" value="{{$post['startat']}}">
                                    </div>
                                    <div class="col">
                                        <label>วันที่สิ้นสุดเรี่ยไร</label>
                                        <input type="date" class="form-control" name="endat" value="{{$post['endat']}}">
                                    </div>
                                    <div class="col">
                                        <label>เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" name="tel" value="{{$post['tel']}}">
                                    </div>

                                    <div class="col">
                                        <label>อีเมล</label>
                                        <input type="text" class="form-control" name="email" value="{{$post['email']}}">
                                    </div>
                                </div>
                                <label class="mt-3">หมวดหมู่</label>
                                <select class="form-control" name="cate" value="{{$post['cate']}}">
                                    <option>เยาวชน</option>
                                    <option>ผู้ป่วย</option>
                                    <option>สัตว์</option>
                                    <option>สิ่งแวดล้อม</option>
                                    <option>อื่นๆ</option>
                                </select>
                            </div>

                            <h4 class="mt-4">รายละเอียดบัญชี</h4>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col">
                                        <label>ชื่อบัญชี</label>
                                        <input type="text" class="form-control" name="namebank" value="{{$post['namebank']}}">
                                    </div>
                                    <div class="col">
                                        <label>เลขที่บัญชี</label>
                                        <input type="text" class="form-control" name="numberbank" value="{{$post['numberbank']}}">
                                    </div>
                                    <div class="col">
                                        <label>ธนาคาร</label>
                                        <select class="form-control" name="bank" value="{{$post['bank']}}">
                                            <option>ธนาคารกสิกร</option>
                                            <option>ธนาคารกรุงไทย</option>
                                            <option>ธนาคารไทยพาณิชย์</option>
                                            <option>ธนาคารกรุงเทพ</option>
                                            <option>ธนาคารออมสิน</option>
                                            <option>ธนาคารทหารไทย</option>
                                            <option>ธนาคารกรุงศรี</option>
                                            <option>ธนาคารธนชาต</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>สาขา</label>
                                        <input type="text" class="form-control" name="branch" value="{{$post['branch']}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row flex mx-auto" style="width:40rem">
                        <div class="col text-right">

                            <input type="submit" value='ยืนยัน' class="btn btn-primary">
                        </div>
                    </div>
                </form>

                            </div>
                        </div>
                    </div>






@endsection

@section('scripts')
    @parent

    <script>
        function sweet(){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        }

    </script>
@endsection
