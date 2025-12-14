<?php

class Post
{
    public $title;
    public $content;
    public $created_at;

    public function __construct($title, $content, $created_at = null)
    {
        $this->title = $title;
        $this->content = $content;
        if ($created_at === null) {
            $created_at = \Carbon\Carbon::now()->format('d.m.Y');
        }
        $this->created_at = $created_at;
    }

    public static function getAll()
    {
        return [
            new Post(
                'Мій перший пост',
                "Це приклад першого поста в блозі.\n\n- Пункт списку 1\n- Пункт списку 2\n\nТрохи **жирного** та _курсиву_.",
                self::dateMinusDays(4)
            ),
            new Post(
                'MVC у PHP',
                "MVC — це розділення коду на три частини: **Model**, **View**, **Controller**.",
                self::dateMinusDays(3)
            ),
            new Post(
                'Composer',
                "Composer — менеджер залежностей для PHP. Встановлення: `composer install`.",
                self::dateMinusDays(2)
            ),
            new Post(
                'GitHub',
                "GitHub — сервіс для зберігання та спільної роботи над кодом. Перейдіть у репозиторій і зробіть `git push`.",
                self::dateMinusDays(1)
            ),
            new Post(
                'Наступний крок',
                "Далі можна додати пошук, Markdown або базу даних.\n\nПриклад коду:\n\n```php\necho 'Hello, MVC!';\n```",
                self::dateMinusDays(0)
            ),
        ];
    }

    /**
     * @param string $query
     * @return Post[]
     */
    public static function searchByTitle($query)
    {
        $query = trim((string)$query);
        $toLower = function ($s) { return mb_strtolower((string)$s, 'UTF-8'); };
        $contains = function ($haystack, $needle) { return mb_strpos($haystack, $needle, 0, 'UTF-8') !== false; };

        $q = $toLower($query);
        if ($q === '') {
            return self::getAll();
        }

        $result = [];
        foreach (self::getAll() as $post) {
            $title = $toLower($post->title);
            $content = $toLower($post->content);
            if ($contains($title, $q) || $contains($content, $q)) {
                $result[] = $post;
            }
        }
        return $result;
    }

    private static function dateMinusDays($days)
    {
        $now = \Carbon\Carbon::now();
        return $now->copy()->subDays((int)$days)->format('d.m.Y');
    }
}
