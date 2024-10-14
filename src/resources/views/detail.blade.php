@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<div class="main__area__inner">
    <form class="update__form" action="{{ route('products.update', ['product_id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form__link">
            <a href="{{ route('products.index') }}" class="form__link--item">商品一覧</a>
            <span>>{{ $product->name }}</span>
        </div>
        <div class="separate__content">
            <div class="left__side">
                <div class="form__item">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product__card--image">
                    <div id="preview" class="product__card--image"></div>
                    <input type="file" name="image" id="inputElm" /><br>
                    {{ csrf_field() }}
                    <div class="form__error">
                        @error('image')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="right__side">
                <div class="form__item">
                    <p class="form__item--name">商品名</p>
                    <input class="form__input" type="text" name="name" placeholder="商品名を入力" value="{{ $product->name }}">
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__item">
                    <p class="form__item--name">値段</p>
                    <input class="form__input" type="text" name="price" placeholder="値段を入力" value="{{ $product->price }}">
                    <div class="form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__item">
                    <p class="form__item--name">季節</p>
                    <div class="checkbox">
                        @foreach($seasons as $season)
                        <div class="appearance">
                            <label class="form__checkbox--label" for="{{ $season->name }}">
                                <input class="form__checkbox" type="checkbox" id="{{ $season->name }}" name="seasons[]" value="{{ $season->id }}"
                                    @if($product->is_season($season->id)) checked @endif>
                                {{ $season->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form__error">
                        @error('seasons')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__item">
            <p class="form__item--name">商品説明</p>
            <textarea class="form__textarea" name="description" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="back__button" type="button" onclick="location.href='{{ route('products.index')}}'">戻る</button>
            <button class="form__submit" type="submit">変更を保存</button>
        </div>
    </form>
    <form class="delete__form" action="{{ route('products.destroy', ['product_id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('delete')
        <button class="delete__button" id="deleteBtn" type="submit"><i class="fa-regular fa-trash-can fa-2x"></i></button>
    </form>
    <script src="{{ asset('js/input-file.js') }}"></script>
    <script src="{{ asset('js/delete-confirmation.js') }}"></script>
</div>

<script>
    const inputElm = document.getElementById('inputElm');
    inputElm.addEventListener('change', (e) => {
        const file = e.target.files[0];
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.addEventListener('load', (e) => {
            const imgElm = document.createElement('img');
            imgElm.className = 'product__card--image';
            imgElm.src = e.target.result;
            const targetElm = document.getElementById('preview');
            const previewText = document.createElement('p');
            previewText.textContent = '新規画像プレビュー';
            previewText.className ='preview'
            targetElm.appendChild(previewText);
            targetElm.appendChild(imgElm);
        });
    });
</script>

@endsection