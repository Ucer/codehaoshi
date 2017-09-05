<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


// ## =============================
// Authtication
// ================================ ##
Route::group([
    'namespace' => 'Api',
    'middleware' => ['api']
], function () {
    // Article Comment
    Route::get('comment/{article_id}/comment', 'CommentController@show');
    Route::get('/article/{article_id}/voteuser', 'ArticleController@voteUser');
    // Question Comment
    Route::get('reply/{question_id}/reply', 'ReplyController@show');
    Route::get('/question/{question_id}/voteuser', 'QuestionController@voteUser');

    Route::group([
        'middleware' => ['auth:api']
    ], function () {
        Route::post('/comment', 'CommentController@store');
        Route::delete('/comment/{comment_id}', 'CommentController@destroy');
        Route::post('/article/{article_id}/vote', 'ArticleController@vote');
        Route::get('/user/followers/{id}', 'FollowerController@index');
        Route::post('/user/follow', 'FollowerController@doFollow');
        Route::post('file/upload', 'UploadController@fileUpload');


        Route::post('/reply', 'ReplyController@store');
        Route::delete('/reply/{question_id}', 'ReplyController@destroy');
        Route::post('/question/{question_id}/vote', 'QuestionController@vote');
    });

});
