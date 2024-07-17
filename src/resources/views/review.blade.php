<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/review.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                @if(auth()->check())
                <a href="{{ route('loginMenu') }}">
                    <button class="menu_button" href="/">
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                    </button>
                </a>
                @else
                <a href="{{ route('homeMenu') }}">
                    <button class="menu_button" href="/">
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                    </button>
                </a>
                @endif
            </div>
            <div class="header_title">Rese</div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="container-left">
                <div class="container-left_wrap">
                    <h1 class="title">今回のご利用はいかがでしたか？</h1>
                    <div class="favorite-card">
                        <div class="card-img">
                            <img class="shop-img" src="{{ Storage::url($shop->img_path) }}" onerror="this.onerror=null; this.src='{{ $shop->img_path }}'" alt="サンプル画像">
                        </div>
                        <div class="card-content">
                            <div class="card-content_title">
                                <div class="card-content_shop-name">{{ $shop->shop_name }}</div>
                            </div>
                            <div class="card-content_tag">
                                <div class="tag-area">＃{{ $shop->Area->area_name }}</div>
                                <div class="tag-genre">＃{{ $shop->Genre->genre_name }}</div>
                            </div>
                            <div class="card-content_button">
                                <div class="detail-button">
                                    <button class="detail">
                                        <a class="detail-inner" href="">詳しくみる</a>
                                    </button>
                                </div>
                                <div class="favorite-button">
                                    <form action="" method="">
                                        <input type="hidden" name="heart-icon">
                                        <button type="submit" class="logo">
                                            <img class="favorite-icon" src="/image/heart-solid-red.svg" alt="">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-right">
                <div class="review-title">
                    <h2 class="review-title_h2">
                        体験を評価してください
                    </h2>
                </div>
                <div class="review-container">
                    <form id="form" action="{{ route('reviewStore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <div class="rate-form">
                            <input id="star5" type="radio" name="rating" value="5">
                            <label for="star5">★</label>
                            <input id="star4" type="radio" name="rating" value="4">
                            <label for="star4">★</label>
                            <input id="star3" type="radio" name="rating" value="3">
                            <label for="star3">★</label>
                            <input id="star2" type="radio" name="rating" value="2">
                            <label for="star2">★</label>
                            <input id="star1" type="radio" name="rating" value="1">
                            <label for="star1">★</label>
                        </div>
                        @error('rating')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="review-submit">
                            <h2 class="review-submit_comment">
                                口コミを投稿
                            </h2>
                        </div>
                        <div class="comment">
                            <textarea class="comment-inner" name="comment" id="comment" cols="30" rows="8" placeholder="カジュアルな夜のお出かけにおすすめのスポット" oninput="countCharacters()"></textarea>
                            <div class="comment_subtitle" id="charCount">
                                0/400（最高文字数）
                            </div>
                            <script>
                                function countCharacters() {
                                    const maxLength = 400;
                                    const textArea = document.getElementById('comment');
                                    const charCount = document.getElementById('charCount');

                                    charCount.textContent = textArea.value.length + '/' + maxLength;

                                    if (textArea.value.length > maxLength) {
                                        charCount.style.color = 'red';
                                    } else {
                                        charCount.style.color = 'inherit';
                                    }
                                }
                            </script>
                            @error('comment')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="review-submit">
                            <h2 class="review-submit_img">
                                画像の追加
                            </h2>
                        </div>
                        <div class="img-title">
                            <div class="img-title_content">クリックして写真を追加</div>
                            <div class="img-title_content-item">またはドラッグアンドドロップ</div>
                            <input class="img-input" type="file" name="img_path" accept=".png, .jpeg">
                            <div class="img-preview"></div>
                        </div>
                        @error('img_path')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const fileInput = document.querySelector('.img-input');
                                const previewContainer = document.querySelector('.img-preview');
                                const titleContent = document.querySelector('.img-title_content');
                                const titleContentItem = document.querySelector('.img-title_content-item');

                                fileInput.addEventListener('change', function(event) {
                                    const file = fileInput.files[0];

                                    previewContainer.innerHTML = '';

                                    if (file) {
                                        const reader = new FileReader();

                                        reader.onload = function(e) {
                                            const imgElement = document.createElement('img');
                                            imgElement.src = e.target.result;
                                            previewContainer.appendChild(imgElement);

                                            titleContent.style.display = 'none';
                                            titleContentItem.style.display = 'none';
                                        };

                                        reader.readAsDataURL(file);
                                    } else {
                                        previewContainer.textContent = 'No file chosen';
                                        titleContent.style.display = 'block';
                                        titleContentItem.style.display = 'block';
                                    }
                                });
                            });
                        </script>

                    </form>
                </div>
            </div>
        </div>
        <div class="button">
            <button class="form-button" type="submit" form="form">投稿</button>
        </div>
    </main>


</body>

</html>