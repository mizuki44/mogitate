@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="main__area__inner">
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
        <div class="product__create">
            <a href="{{ route('products.create') }}" class="product__create--button">＋商品を追加</a>
        </div>
    </div>
    <div class="separate__content">
        <div class="left__side">
            <div class="search__area">
                <form method="GET" action="{{ route('products.search') }}">
                    <input name="p" class="form__input" id="p" type="search" placeholder="商品名で検索" aria-label="Search" value="{{ $p }}">
                    <button class="form__submit" type="submit">検索</button>
                    <h3 class="form__subtitle">価格順で表示</h3>
                    <div class="select__wrapper">
                        <select class="form__select" name="sort_order" id="sort_order" onchange="submit(this.form)">
                            <option value="{{ App\Models\Product::LIST['default'] }}" disabled @if(!\Request::get('sort_order')) selected @endif>価格で並べ替え</option>
                            <option value="{{ App\Models\Product::LIST['higherPrice'] }}" @if(\Request::get('sort_order')===App\Models\Product::LIST['higherPrice']) selected @endif>高い順に表示</option>
                            <option value="{{ App\Models\Product::LIST['lowerPrice'] }}" @if(\Request::get('sort_order')===App\Models\Product::LIST['lowerPrice']) selected @endif>低い順に表示</option>
                        </select>
                    </div>
                </form>
                @if(\Request::get('sort_order'))
                <form class="tag__form" action="{{ route('products.search') }}" method="get">
                    @if(\Request::get('sort_order') === App\Models\Product::LIST['higherPrice'])
                    <p class="tag__form--sort">高い順に表示</p>
                    @elseif(\Request::get('sort_order') === App\Models\Product::LIST['lowerPrice'])
                    <p class="tag__form--sort">低い順に表示</p>
                    @endif
                    <input type="hidden" name="keyword" value="{{ \Request::get('keyword') }}">
                    @if(\Request::get('keyword'))
                    <button type="submit" class="tag__form_button">✕</button>
                    @else
                    <button type="button" class="tag__form_button" onclick="location.href='{{ route('products.index') }}'">✕</button>
                    @endif
                </form>
                @endif
            </div>
        </div>
        <div class="right__side">
            <div class="product__area">
                @foreach($products as $product)
                <div class="product__card">
                    <a href="{{ route('products.detail', ['product_id' => $product->id]) }}">
                        <div class="product__card--image">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product__card--image">
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
</div>
@endsection