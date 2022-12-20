@extends('container')
@section('content')
    <div class="card">
        <div class="">
            <div class="list-group rounded">
                @foreach ($libraries as $list)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $list->library_name }}</h5>
                            <small>{{ $list->created_at }}</small>
                        </div>
                        <p class="mb-1">{{ $list->library_email }}</p>
                        <small>{{ $list->library_phone_number }}</small>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.list-group > .list-group-item').hover(function() {
                $(this).addClass('h6 active');
            }, function() {
                $(this).removeClass('h6 active');
            });
        });
    </script>
@endsection
