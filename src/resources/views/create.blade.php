@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}" />
@endsection

@section('content')
<div class="main__area__inner">
    <form class="create__form" action="{{ route('products.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__title">
            <h2>商品登録</h2>
        </div>
        <div class="form__item">
            <p class="form__item--name">商品名<span class="required">必須</span></p>
            <input class="form__input" type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__item">
            <p class="form__item--name">値段<span class="required">必須</span></p>
            <input class="form__input" type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__item">
            <p class="form__item--name">商品画像<span class="required">必須</span></p>
            <div class="form__item">
                <div id="preview" class="product__card--image"></div>
                <input type="file" name="image" class="product__card--image" id="inputElm" /><br>
                {{ csrf_field() }}
                @error('image')
                <div class="form__error">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="form__item">
            <p class="form__item--name">季節<span class="required">必須</span><span class="multiple">複数選択可</span></p>
            <div class="checkbox">
                @foreach($seasons as $season)
                <div class="appearance">
                    <label class="form__checkbox--label" for="{{ $season->name }}">
                        <input class="form__checkbox" type="checkbox" id="{{ $season->name }}" name="seasons[]" value="{{ $season->id }}"
                            {{ !empty(old('seasons')) && in_array((string)$season->id, old('seasons'), true) ? 'checked' : ''}}>
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
        <div class="form__item">
            <p class="form__item--name">商品説明<span class="required">必須</span></p>
            <textarea class="form__textarea" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="back__button" type="button" onclick="location.href='{{ route('products.index') }}'">戻る</button>
            <button class="form__submit" type="submit">登録</button>
        </div>
    </form>
    <script src="{{ asset('js/input-file.js') }}"></script>
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
            previewText.textContent = '画像プレビュー';
            previewText.className = 'preview'
            targetElm.appendChild(previewText);
            targetElm.appendChild(imgElm);
        });
    });
</script>

@endsection