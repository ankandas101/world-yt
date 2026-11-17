<?php

use App\Models\Category;
use App\Service\CategoryManager;
use App\Service\DBdataCached;
use App\Service\ImageManager;
use Illuminate\Support\Facades\Cache;

function categories(){
    return (new CategoryManager())->categories;
}
function refreshCategories(){
    return (new CategoryManager())->refresh();
}
function photo($path,$type){
    $image_manager = new ImageManager($path,$type);
    return $image_manager->return_path;
}
function logo($size){
    return match ($size) {
        1 => asset('/asset/images/default/logo/32x32.png'),
        2 => asset('/asset/images/default/logo/180x180.png'),
        3 => asset('/asset/images/default/logo/192x192.png'),
        4 => asset('/asset/images/default/logo/270x270.png'),
        default => asset('/asset/images/default/logo/180x180.png'),
    };
}

function dbDataCached(){
    return DBdataCached::make();
}

function generateTableOfContents($content)
{
    $dom = new \DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);

    $headings = [];
    foreach (['h1', 'h2', 'h3', 'h4', 'h5', 'h6'] as $tag) {
        foreach ($dom->getElementsByTagName($tag) as $node) {
            $text = $node->textContent;
            $id = $node->getAttribute('id');
            if (!$id) {
                // Generate a slug for the heading
                $id = \Str::slug($text);
                $node->setAttribute('id', $id);
            }
            $headings[] = [
                'level' => (int)substr($tag, 1),
                'text' => $text,
                'id' => $id,
            ];
        }
    }

    // Save the modified content with IDs
    $contentWithIds = $dom->saveHTML();

    return [$headings, $contentWithIds];
}

function buildTocHtml($headings)
{
    $html = '<ul class="toc">';
    foreach ($headings as $heading) {
        $html .= '<li class="toc-level-' . $heading['level'] . '">';
        $html .= '<a href="#' . $heading['id'] . '">' . $heading['text'] . '</a>';
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}

function homePageSections($section, $blogs=null,$pagination=true,$dd=null)
{
    if(!$blogs){
        return null;
    }
    $page = 1;
    $perPage = 5;


    // Render the blog list partial
    $html = view("components.home-page.$section", [
        'blogs' => $blogs,
        'pagination'=>$pagination,
        'dd'=>$dd
    ])->render();
    // dd($html);

    if(!$pagination){
        return (object)[
            'html' => $html,
            'current_page' => 1,
            'last_page' => 2,
            'first_item' => $blogs->first(),
        ];
    }
    return (object)[
        'html' => $html,
        'current_page' => $blogs->currentPage(),
        'last_page' => $blogs->lastPage(),
        'first_item' => $blogs->first(),
    ];

}

