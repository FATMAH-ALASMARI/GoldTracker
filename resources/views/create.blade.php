@extends('layouts.app')

@section('content')

<div class="card">

    <h2>إضافة سعر الذهب</h2>

    <a href="{{ route('gold.index') }}">
        العودة للأسعار
    </a>

    <br><br>

    <form action="{{ route('gold.store') }}" method="POST">

        @csrf

        <label>العيار</label><br>
        <input type="text" name="karat"><br><br>

        <label>السعر</label><br>
        <input type="number" step="0.01" name="price"><br><br>

        <button type="submit">
            حفظ
        </button>

    </form>

</div>

@endsection