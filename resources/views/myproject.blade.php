@extends('layouts.app')

<style>
    * {
        box-sizing: border-box;
    }
    .card:hover{
        border: 1px solid #f26d7d;
    }
    div h3{
        font-family: 'Mitr', sans-serif;
        color: #f26d7d;
    }
    div h5, a{
        font-family: 'Mitr', sans-serif;
    }





</style>

@section('content')
    <div class="container bg-light pt-2">
        <div class="row mt-5">
            <div class="col">
                <h3>โครงการของฉัน</h3>
            </div>
        </div>
    </div>
        <div class="row pb-4">
            <div class="container shadow-sm rounded p-4 bg-white">
            @foreach ($myproject as $row)
                <div class="row p-2">
                @foreach ($row as $item)
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ url('image/'.$item->pjimg) }} " class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->projectname }}</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="{{ url('/withdraw/'.$item->id) }}" class="btn btn-block
                                        btn-outline-success">ชี้แจงการถอนเงิน</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ url('/projetcs/'.$item->id) }}" class="btn btn-block
                                        btn-outline-info">ดูโครงการ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
    </div>
        </div>
@endsection
