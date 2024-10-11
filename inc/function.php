<?php
// Включаем строгую типизацию
declare(strict_types=1);

/**
 * @param $some
 * отладочная функция
 */
function dd($some){
    echo '<pre>';
    print_r($some);
    echo '</pre>';
    exit();
}

/**
 * @param $url
 * редирект на указаный URL
 */
function goUrl(string $url){
    echo '<script type="text/javascript">location="';
    echo $url;
    echo '";</script>';
}

/**
 * функция возвращает масив статей
 * @return array
 */
function getArticles() : array
{
    return json_decode(file_get_contents('db/articles.json'), true);
}

/**
 * функция возвращает статью  в виде масива по id
 * @param int $id
 * @return array
 */
function getArticleById(int $id):array
{
    $articleList =getArticles();
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
        $link .= '<li class="nav-item"><a class="nav-link" href="index.php?id='. $article['id']
            . '">'. $article['title']. '</a></li>';
    }
    return $link;
}

function editJson(string $title, string $content, int $id): array
{
    $json = json_decode(file_get_contents('db/articles.json'), true);

    $id = $json[$id]["id"];
    $img = $json[$id]["image"];


    $json[$id]["id"] = $id;
    $json[$id]["title"] = $title;
    $json[$id]["content"] = $content;

    $json[$id]["image"] = $img;


    $newJsonString = json_encode($json);
    file_put_contents('db/articles.json', $newJsonString);
}

function checkRecuest(): string
{
    if (isset($_REQUEST["act"])) {
        $req = $_REQUEST["act"];
        $res = '';
        switch ($req) {
            case 'calc':
                $res = renderCalcForm();
                break;
            case 'artlist':
                $res = renderListForm();
                break;
            case 'addlist':
                $res = renderCreateForm();
                break;
            case 'add-article':
                $res = addToJson();
                break;
            case 'oneart':
                $res = renderOneArtForm();
        }
        return $res;
    } else
        return '';
}

function renderOneArtForm(): string
{
    //$ID = $_GET["id"];
    return lalala(getArticleById((int)$_GET["id"]));
}


function renderCreateForm(): string
{
    $json = json_decode(file_get_contents('db/articles.json'), true);
    $jsonmaxid = (int)array_key_last($json);
    $jsonmaxid++;
    $jsonmaxid = (string)$jsonmaxid;
    return '<form action="" method="get" class="m-5">
                    <!--<input type="hidden" name="act" value="addlist ">-->
                    <input type="hidden" name="id" id="sec" value="' . $jsonmaxid . '"/>
                    <input type="hidden" name="act" id="sec" value="add-article"/>
                <div class="form-example mb-2">
                    <label for="title">Enter new title: </label>
                    <input type="text" name="title" id="fst" required/>
                </div>
                <div class="form-example mb-2">
                    <label for="content">Enter new content: </label>
                    <input type="text" name="content" id="sec" required/>
                </div>
                <div class="form-example mb-2">
                    <label for="image">Enter new image path: </label>
                    <input type="text" name="image" id="sec"/>
                </div>
                <div class="form-example">
                    <input type="submit" value="Update"/>
                </div>
                <div>
                <?php
                 addToJson($_GET["title"], $_GET["content"], $_GET["id"], $_GET["image"]);
                ?>
                </div>

            </form>';
}


function addToJson(string $title, string $content, int $id, string $image)
{

    $newEntry = [
        'id' => (string)$id,
        'title' => $title,
        'image' => $image,
        'content' => $content,
    ];
    $data = json_decode(file_get_contents('db/articles.json'), true);

    $data[] = $newEntry;

    $newJsonString = json_encode($data);
    file_put_contents('db/articles.json', $newJsonString);
}

function renderCalcForm(): string
{
    return '<form action="" method="get" class="form-example m-5">
                    <div class="form-example mb-2">
                        <label for="first">Enter first number: </label>
                        <input type="number" name="first" id="fst" required/>
                    </div>
                    <select name="operation" class="mb-2">
                        <option value="plus">+</option>
                        <option value="minus">-</option>
                        <option value="multiply">*</option>
                        <option value="divide">/</option>
                    </select>
                    <div class="form-example mb-2">
                        <label for="second">Enter second number: </label>
                        <input type="number" name="second" id="sec" required/>
                    </div>
                    <div class="form-example">
                        <input type="submit" value="Sumbit"/>
                    </div>

                    <div class="form-example">
                        <label>
                            <?php
                            print_r(calc($_GET["first"], $_GET["second"], $_GET["operation"]))
                            ?>
                        </label>
                    </div>

                </form>';
}

