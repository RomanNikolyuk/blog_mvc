<?php
require_once __DIR__ . '/../models/Post.php';

class BlogController
{
    public function showAllPosts($search = '')
    {
        $search = trim((string)$search);
        $posts = Post::getAll();

        if ($search !== '') {
            $toLower = function ($s) { return mb_strtolower((string)$s, 'UTF-8'); };
            $contains = function ($haystack, $needle) { return mb_strpos($haystack, $needle, 0, 'UTF-8') !== false; };


            $q = $toLower($search);
            $posts = array_values(array_filter($posts, function ($post) use ($toLower, $contains, $q) {
                $title = $toLower($post->title);
                $content = $toLower($post->content);
                return $contains($title, $q) || $contains($content, $q);
            }));
        }

        $perPage = 3;
        $totalPages = max(1, (int)ceil(count($posts) / $perPage));
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) { $page = 1; }
        if ($page > $totalPages) { $page = $totalPages; }
        $offset = ($page - 1) * $perPage;
        $posts = array_slice($posts, $offset, $perPage);

        $pageTitle = 'Мій блог';
        $searchQuery = $search;
        $search = $search;

        include __DIR__ . '/../views/postsView.php';
    }
}
