@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')

<!-- 検索メニュー -->
<form method="GET" action="{{ route('products.search') }}">
    <div class="search_box">
        <input name="p" class="search_content_product" id="p" type="search" placeholder="Search..." aria-label="Search" value="{{ $p }}">
    </div>
    <button class="form__submit" type="submit">検索</button>
</form>
</div>

<div class="title__area">
    <div class="page__title">
        <h2>
            @if(\Request::get('keyword'))
            "{{ \Request::get('keyword') }}"の商品一覧
            @else
            商品一覧
            @endif
        </h2>
    </div>
    <div class="product__create--button">
        <a href="{{ route('products.create') }}">＋商品を追加</a>
    </div>
</div>
<div class="separate__content">
</div>
<div class="right__side">
    <div class="product__area">
        @foreach($products as $product)
        <div class="product__card">
            <a href="{{ route('products.detail', ['product_id' => $product->id]) }}">
                <div class="product__card--image">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </div>
                <div class="product__card--info">
                    <p>{{ $product->name }}</p>
                    <p>￥{{ number_format($product->price) }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection