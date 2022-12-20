@extends('container')
@section('content')
    <div class="card">
        <form id="library-form" class="m-3" data-action="{{ url('/api/library') }}">
            <input id="library-id" type="hidden">
            <div class="form-group">
                <label for="libraryName">Your Library Name</label>
                <input type="text" class="form-control" name="libraryName" id="libraryName"
                    placeholder="Your Library Name">
            </div>
            <div class="form-group">
                <label for="libraryAddress">Your Library Address</label>
                <input type="text" class="form-control" name="libraryAddress" id="libraryAddress"
                    placeholder="Your Library Address">
            </div>
            <div class="form-group">
                <label for="libraryPhone">Your Library Phone</label>
                <input type="text" class="form-control" name="libraryPhone" id="libraryPhone"
                    placeholder="Your Library Phone">
            </div>
            <div class="form-group">
                <label for="libraryEmail">Your Library Email</label>
                <input type="email" class="form-control" name="libraryEmail" id="libraryEmail"
                    placeholder="Your Library Email">
            </div>
            <button type="button" id="library-submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#library-submit").click(function() {
                let libraryName = $("#libraryName").val();
                let libraryAddress = $("#libraryAddress").val();
                let libraryPhone = $("#libraryPhone").val();
                let libraryEmail = $("#libraryEmail").val();
                let arguments = {
                    libraryName,
                    libraryAddress,
                    libraryPhone,
                    libraryEmail
                }
                $.ajax({
                    type: "POST",
                    url: $("#library-form").data('action'),
                    data: {
                        ...arguments
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
