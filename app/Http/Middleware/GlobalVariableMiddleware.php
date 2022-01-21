<?php

namespace App\Http\Middleware;

use App\Blog;
use App\Menu;
use Closure;

class GlobalVariableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        view()->composer('*', function ($view) {
            $all_usefull_links = Menu::find(get_static_option('useful_link_widget_menu_id'));
            $all_important_links = Menu::find(get_static_option('important_link_widget_menu_id'));
            $all_recent_post = Blog::orderBy('article_id', 'desc')->take(2)->get();
            $primary_menu = Menu::where(['status' => 'default'])->first();

            $view->with('all_usefull_links', $all_usefull_links);
            $view->with('all_important_links', $all_important_links);
            $view->with('all_recent_post', $all_recent_post);
            $view->with('primary_menu', $primary_menu);
        });

        return $next($request);
    }
}
