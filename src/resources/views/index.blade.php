@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')

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
    <div class="left__side">
        <div class="search__area">
            <!-- 検索メニュー -->
            <form method="GET" action="{{ route('products.search') }}">
                <div class="search_box">
                    <input name="p" class="form__input" id="p" type="search" placeholder="商品名で検索" aria-label="Search" value="{{ $p }}">
                </div>
                <button class="form__submit" type="submit">検索</button>
            </form>
        </div>
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

        {{ $products
            ->appends([
                'keyword' => \Request::get('keyword'),
                'sort_order' => \Request::get('sort_order'),
                ])
            ->links() }}
    </div>
</div>

@endsection