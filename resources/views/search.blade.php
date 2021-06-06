@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group row">
                <input type="hidden" name="keyword" id="keyword" value="{{$keyword}}">
                <label for="" class="col-sm-3 col-form-label"><b>Sort by</b></label>
                <div class="col-sm-9">
                    <select class="form-control sort" name="sort" id="sort">
                        <option value="terbaru">Terbaru</option>
                        <option value="terlama">Terlama</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p><b>Showing {{$posts->count()}} post</b></p>
            <div id="blog-body" class="row">
                @include('search-sorting')
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $('body').on('change', '.sort', function () {
        var keyword = $('#keyword').val();
        var filter = $('#sort').val();

        $.ajax({
            url: '/search/sorting',
            data: { 'keyword' : keyword, 'filter' : filter },
            type: "GET",
            success: function (data) {
                $('#blog-body').html(data);
            }
        });
    });
</script>
@endsection
