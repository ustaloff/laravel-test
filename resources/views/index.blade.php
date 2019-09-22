@extends('welcome')

@section('content')

@if ($link ?? '')
    <a href="/{{ $link ?? '' }}" title="">{{ url('/' . $link ?? '') }}</a><br><br>
@endif

{{ $errors->link->first('link') }}

<form action="{{ route('page.index') }}" method="post">
    {{ csrf_field() }}

    Enter URL: <input type="text" name="link" value=""><br><br>
    <input type="submit" value="Submit">

</form>

@endsection