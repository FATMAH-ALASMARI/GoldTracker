@extends('layouts.app')

@section('content')

<div class="card">

    <h2>تعديل سعر الذهب</h2>

    <form action="/gold/{{ $price->id }}" method="POST">

        @csrf
        @method('PUT')

        <label>العيار</label><br>
        <input type="text" name="karat" value="{{ $price->karat }}"><br><br>


        <label>السعر</label><br>
        <input type="number" step="0.01" name="price" value="{{ $price->price }}"><br><br>


        <button type="submit">
            تحديث
        </button>

    </form>

    <br>

    <a href="/">
        العودة للأسعار
    </a>

</div>

@endsection