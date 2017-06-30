@extends('layouts.app')

@section('head')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-4">

                <form>
                    <div class="form-group">
                        <label for="tag_list">Tags:</label>
                        <select id="a" name="tag_list[]" class="form-control" ></select>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')
 {{-- auto suggest --}}
    @include('layouts.suggest');

    <script>
        GetSuggestions("tag_list","name","suppliers");

        $('#tag_list').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection 

