@extends('layouts.adminapp')

@section('content')
    <div class="container">
        @foreach ($statement as $item)
            @if ($item->status == 2)
                <div class="mb-3 p-3 bg-white rounded">
                    <div class="row">
                        <div class="col">
                            <h2>{{$item->des}}({{$item->projectname}})</h2>
                        </div>
                        <div class="col-3">
                            <select name="option-status[]" class="form-control">
                                @foreach ($op_report as $key => $value)
                                    @if ($key == $item->status)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="button" class="btn btn-primary btn-block" name="confirm[]" value="Confirm" data-url="{{ route('updateStatus') }}"
                                   data-target="{{ $item->stepforms_id }}">
                        </div>
                    </div>
                    <hr>
                    @for ($i = 0; $i < count($comment[$item->id]); $i++)
                        <div class="row bg-danger rounded mb-2 p-2 text-white">
                            <div class="col-3">
                                แจ้งเมื่อ {{ $comment[$item->id][$i]->created_at }}
                            </div>
                            <div class="col">
                                {{ $comment[$item->id][$i]->message }}
                            </div>
                            <div class="col-2">
                                ผู้แจ้ง {{ $comment[$item->id][$i]->name }}({{ $comment[$item->id][$i]->email }})
                            </div>
                        </div>
                    @endfor
                </div>
            @endif

        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('[name="confirm[]"]').click(function() {
                let i = $('[name="confirm[]"]').index($(this));
                var data = {
                    '_token': $("input[type=hidden][name=_token]").val(),
                    stepforms_id: $(this).data('target'),
                    status: $('select[name="option-status[]"]').eq(i).val()
                };
                var url = $(this).data('url');

                $.ajax({
                    method: 'POST',
                    data: data,
                    url: url
                }).done(function () {
                    window.location.reload();
                });
            });
        });
    </script>
@endsection
