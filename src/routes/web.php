<?php

Route::group(['prefix' => 'task', 'middleware' => ['web']], function() {
    Route::get('demo', 'Bantenprov\Task\Http\Controllers\TaskController@demo');

    Route::get('/','Bantenprov\Task\Http\Controllers\TaskController@index')->name('taskIndex');
    
    Route::get('{id}/view/','Bantenprov\Task\Http\Controllers\TaskController@show')->name('taskShow');
    
    Route::get('/edit/{id}','Bantenprov\Task\Http\Controllers\TaskController@edit')->name('taskEdit');

    Route::get('/delete/{id}','Bantenprov\Task\Http\Controllers\TaskController@destroy')->name('taskDelete');

    Route::get('/create', 'Bantenprov\Task\Http\Controllers\TaskController@create')->name('taskCreate');
    
    Route::post('/store', 'Bantenprov\Task\Http\Controllers\TaskController@store')->name('taskStore');

    Route::get('/add-member/{task_id}', 'Bantenprov\Task\Http\Controllers\TaskController@addMember')->name('taskAddMember');

    Route::get('/remove-member/{task_id}/{member_id}','Bantenprov\Task\Http\Controllers\TaskController@removeMember')->name('taskRemoveMember');

    Route::post('add-member-store/{task_id}', 'Bantenprov\Task\Http\Controllers\TaskController@storeAddMember')->name('taskStoreAddMember');

    //config('comment.route');
    Route::get('/{task_id}/comment','Bantenprov\Comment\Http\Controllers\CommentController@create')->name('commentCreate');

    Route::post('/{task_id}/comment/store','Bantenprov\Comment\Http\Controllers\CommentController@store')->name('commentStore');
    
});
