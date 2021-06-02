<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
    return view('home');
});

Auth::routes();

Route::middleware('admin_or_guest')->get('student/register', 'StudentController@create')->name('student.create');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/students/{student}', 'StudentController@profile')->name('student.profile');

    Route::get('/students/{student}/show', 'StudentController@show')->name('student.show');
    
    Route::post('/payments/enrolments/{enrolment}', 'PaymentController@store')->name('payment.store');
    Route::post('/sheets/attach/users/{user}', 'SheetController@attach')->name('sheet.attach');    
});

Route::group([ 'prefix' => 'student', 'middleware' => ['auth', 'role:student']], function () {
    Route::post('student-only', function () {
        return 'Only Student can access this!';
    });
    
    Route::get('/profile', 'StudentController@stundetProfile')->name('student.profile');

    Route::get('/exam', 'StudentController@exam')->name('student.exam');
    Route::get('/exam/{exam}/start', 'StudentController@examStart')->name('student.exam.start');
    Route::post('/exam/question', 'StudentController@nextQues')->name('student.exam.question');

    Route::get('/exam/result', 'StudentController@result')->name('student.result');
    Route::get('/exam/{exam}/result', 'StudentController@resultDetails')->name('student.result.details');

});

Route::group([ 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::post('admin-only', function () {
        return 'Only admin can access this!';
    });

    Route::get('/home', 'HomeController@index')->name('home');

    // students
    Route::get('/students', 'StudentController@index')->name('student.list');
    Route::post('/students/search', 'StudentController@search')->name('student.search');
    Route::get('/students/filter', 'StudentController@filter')->name('student.filter');
    Route::get('/students/due', 'StudentController@due')->name('student.due');
 
    


    // category
    Route::get('/categories', 'CourseCategoryController@index')->name('category.list');
    Route::get('/categories/create', 'CourseCategoryController@create')->name('category.create');
    Route::post('/categories', 'CourseCategoryController@store')->name('category.store');
    Route::get('/categories/{category}/edit', 'CourseCategoryController@edit')->name('category.edit');
    Route::post('/categories/{category}/update', 'CourseCategoryController@update')->name('category.update');
    Route::post('/categories/{category}/delete', 'CourseCategoryController@destroy')->name('category.destroy');


    // course
    Route::get('/courses', 'CourseController@index')->name('course.list');
    Route::get('/courses/create', 'CourseController@create')->name('course.create');
    Route::post('/courses', 'CourseController@store')->name('course.store');
    Route::get('/courses/{course}/edit', 'CourseController@edit')->name('course.edit');
    Route::post('/courses/{course}/update', 'CourseController@update')->name('course.update');
    Route::post('/courses/{course}/delete', 'CourseController@destroy')->name('course.destroy');
    Route::get('/courses/get/batch', 'CourseController@getBatch')->name('course.getBatch');


    // batch
    Route::get('/batches', 'BatchController@index')->name('batch.list');
    Route::get('/batches/create', 'BatchController@create')->name('batch.create');
    Route::post('/batches', 'BatchController@store')->name('batch.store');
    Route::get('/batches/{batch}/edit', 'BatchController@edit')->name('batch.edit');
    Route::post('/batches/{batch}/update', 'BatchController@update')->name('batch.update');
    Route::post('/batches/{batch}/delete', 'BatchController@destroy')->name('batch.destroy');

    // sheet
    Route::get('/sheets','SheetController@index')->name('sheet.list');
    Route::get('/sheets/create','SheetController@create')->name('sheet.create');
    Route::post('/sheets','SheetController@store')->name('sheet.store');
    Route::get('/sheets/{sheet}/edit', 'SheetController@edit')->name('sheet.edit');
    Route::post('/sheets/{sheet}/update', 'SheetController@update')->name('sheet.update');
    Route::post('/sheets/{sheet}/delete', 'SheetController@destroy')->name('sheet.destroy');
    Route::post('/sheets/detach/users/{user}', 'SheetController@detach')->name('sheet.detach');
    
    // payment
    Route::get('/payments', 'PaymentController@index')->name('payment.list');
    Route::get('/payments/search', 'PaymentController@search')->name('payment.search');
    Route::get('/payments/create', 'PaymentController@create')->name('payment.create');
    Route::post('/payments/{payment}/confirm', 'PaymentController@confirm')->name('payment.confirm');
    Route::get('/payments/{payment}/invoice', 'PaymentController@invoice')->name('payment.invoice');
    Route::get('/payments/full-invoice/{user_id}', 'PaymentController@fullInvoice')->name('payment.full-invoice');

    // message
    Route::get('/messages', 'MessageController@index')->name('sms.list');
    Route::get('/messages/create', 'MessageController@create')->name('sms.create');
    Route::get('/messages/get/course', 'MessageController@getCourse')->name('sms.getCourse');
    Route::get('/messages/get/batch/{course_id}', 'MessageController@getBatch')->name('sms.getBatch');
    Route::post('/messages/preview', 'MessageController@preview')->name('sms.preview');
    Route::post('/messages/send', 'MessageController@send')->name('sms.send');

    
    // expense
    Route::get('/expenses', 'ExpenseController@index')->name('expense.list');
    Route::get('/expenses/create', 'ExpenseController@create')->name('expense.create');
    Route::post('/expenses','ExpenseController@store')->name('expense.store');
    Route::get('/expenses/{expense}/edit', 'ExpenseController@edit')->name('expense.edit');
    Route::post('/expenses/{expense}/update', 'ExpenseController@update')->name('expense.update');
    Route::post('/expenses/{expense}/delete', 'ExpenseController@destroy')->name('expense.destroy');

    // Report 
    Route::get('/reports', 'ReportConteroller@index')->name('report.incomeStatement');
    Route::get('/reports/income-statement', 'ReportConteroller@incomeStatement')->name('report.incomeStatement.show');


    // question
    Route::get('/questions', 'QuestionController@index')->name('question.list');
    Route::get('/questions/create', 'QuestionController@create')->name('question.create');
    Route::post('/questions/create', 'QuestionController@store')->name('question.store');

    // examination
    Route::get('/exams', 'ExamController@index')->name('exam.index');
    Route::post('/exams', 'ExamController@store')->name('exam.store');
    Route::get('/exams/{exam}/edit', 'ExamController@edit')->name('exam.edit');
    Route::post('/exams/{exam}/update', 'ExamController@update')->name('exam.update');
    Route::get('/exams/{exam}/delete', 'ExamController@destroy')->name('exam.destroy');
    Route::get('/exams/create', 'ExamController@create')->name('exam.create');
    Route::get('/exams/results', 'ExamController@results')->name('exam.results');
    Route::post('/exams/{exam}/results/publish', 'ExamController@resultPublish')->name('exam.results.publish');
    Route::get('/exams/{exam}/questions', 'ExamController@setupQuestion')->name('exam.questions');
    Route::get('/exams/{exam}/questions/show', 'ExamController@showQuestions')->name('exam.questions.show');
    Route::get('/exams/{exam}/result', 'ExamController@singleExamResult')->name('exam.result.show');


    Route::post('/exams/schedule', 'ExamController@scheduleExam')->name('exam.schedule');
});





Route::post('students', 'StudentController@store')->name('student.store');
