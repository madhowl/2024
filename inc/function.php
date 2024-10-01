<?php

// Включаем строгую типизацию
declare(strict_types=1);

/**
 * @param $some
 * отладочная функция
 */
function dd($some)
{
    echo '<pre>';
    print_r($some);
    echo '</pre>';
    exit();
}

/**
 * @param $url
 * редирект на указаный URL
 */
function goUrl(string $url)
{
    echo '<script type="text/javascript">location="';
    echo $url;
    echo '";</script>';
}

/**
 * функция возвращает масив статей
 * @return array
 */
function getArticles(): array
{
    return json_decode(file_get_contents('db/articles.json'), true);
}

/**
 * функция возвращает статью  в виде масива по id
 * @param int $id
 * @return array
 */
function getArticleById(int $id): array
{
    $articleList = getArticles();
    $curentArticle = [];
    if (array_key_exists($id, $articleList)) {
        $curentArticle = $articleList[$id];
    }
    //dd($curentArticle);
    return $curentArticle;
}

/**
 * функция генерирует список <li> из Json
 * и формирует ссылки вида URI index.php?id=1
 *
 * @return string
 */
function getArticleList(): string
{
    $articles = getArticles();
    $link = '';
    foreach ($articles as $article) {
        $link .= '<li class="nav-item"><a class="nav-link" href="index.php?id=' . $article['id']
            . '">' . $article['title'] . '</a></li>';
    }
    return $link;
}

/**
 * функция возвращает картачку с одной статьей
 *
 * @param int $id
 * @return string
 */
function renderSingleArticle(int $id): string
{
    $article = getArticleById($id);
    $content = '
        <div class="card">
          <img src="./' . $article['image'] . '" class="card-img-top" alt="' . $article['title'] . '">
          <div class="card-body">
            <h5 class="card-title">' . $article['title'] . '</h5>
            <p class="card-text">' . $article['content'] . '</p>
            <a href="/" class="btn btn-primary">Вернутся на главную</a>
          </div>
        </div>';
    return $content;
}

/**
 * Рендеринг навигации по списку статей
 *
 * @return string
 */
function articleListNavigationRender(): string
{
    $articles = getArticles();
    $link = '';
    foreach ($articles as $article) {
        $link .= '<li class="nav-item"><a class="nav-link" href="index.php?id=' . $article['id']
            . '">' . $article['title'] . '</a></li>';
    }
    $content = '
        <div class="card">
          <div class="card-body">
            <ul class="nav flex-column">
             '.$link.' 
            </ul>
          </div>
        </div>';
    return $content;
}

/**
 * функция генерирует список карточек с краткими статьями
 *
 * @return string
 */
function renderArticleList(): string
{
    $articles = getArticles();
    $content = '';
    foreach ($articles as $article) {
        $content .= '
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-4">
                  <img src="./' . $article['image'] . '" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">' . $article['title'] . '</h5>
                    <p class="card-text">
                        <a class="btn btn-success" href="index.php?id=' . $article['id']
                        . '">Пордробнее</a>
                        
                    </p>
                  </div>
                </div>
              </div>
            </div>';
    }
    return $content;
}


