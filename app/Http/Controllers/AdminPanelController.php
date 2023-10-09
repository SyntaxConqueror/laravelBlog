<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminPanelController extends Controller
{
    public function index(){

        $user = auth()->user();

        $tablesFromDB = Schema::getAllTables();
        $tables = array_map(function($item) {
            return $item->Tables_in_fphp;
        }, $tablesFromDB);

        $migrations = Schema::getConnection()->table('migrations')->get();
        $users = Schema::getConnection()->table('users')->get();
        $posts = Schema::getConnection()->table('posts')->get();
        $categories = Schema::getConnection()->table('categories')->get();
        $tags = Schema::getConnection()->table('tags')->get();

        return view('adminPanel',
            compact(
                'user',
                'tables',
                'migrations',
                'users',
                'posts',
                'categories',
                'tags'
            ));
    }

    public function tableWidget(Request $request) {

        $obj = $request->all();

        $migrations = Schema::getConnection()->table('migrations')->get();
        $users = Schema::getConnection()->table('users')->get();
        $posts = Schema::getConnection()->table('posts')->get();
        $categories = Schema::getConnection()->table('categories')->get();
        $tags = Schema::getConnection()->table('tags')->get();
        $tablesFromDB = Schema::getAllTables();
        $tables = array_map(function($item) {
            return $item->Tables_in_fphp;
        }, $tablesFromDB);

        $table = Schema::getConnection()->table(array_keys($obj)[0])->get();
        $tableName = array_keys($obj)[0];

        $compactVariables = compact(
            'table',
            'tables',
            'tableName',
            'migrations',
            'users',
            'posts',
            'categories',
            'tags');

        $additionalViews = [];
        if($request->hasAny($tables)){
            $additionalViews['sections'] = view('sections', $compactVariables);
        }

        $tableWidgetView = view('tableWidget', $compactVariables);

        return $tableWidgetView->with($additionalViews);
    }

    public function getPost(Request $request) {
        return Post::find($request->postId);
    }
}
