<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|   NOTE : IF Submit,After LARAVEL OPTIMIZE
*/
Route::name('auth.logout')->get('/auth/logout', [App\Http\Controllers\LogoutController::class, "index"]);
Route::get('/', [App\Http\Livewire\Home::class, '__invoke']);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Livewire\Home::class, '__invoke']);
    //Route::name('auth.logout')->get('/auth/logout', [App\Http\Livewire\Logout::class, '__invoke']);
});
// Route::get('/', function () {
//     return redirect(route('login'));
// });

// For Permission 
// ->middleware(['permission:country-list|continent-list'])

Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'staff'])->group(function () {
    Route::name('dashboard')->get('/dashboard', App\Http\Livewire\Admin\Dashboards::class);

    Route::prefix('masters')->group(function () {
        // Academic Masters
        Route::name('campus')->get('/campus', [App\Http\Livewire\Admin\Masters\Campuses::class, '__invoke']);
        Route::resource('programcategories', App\Http\Controllers\Admin\ProgramCategoryController::class);
        
        Route::name('program-category')->get('/program-category', [App\Http\Livewire\Admin\Masters\ProgramCategories::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('program-sub-category')->get('/program-sub-category', [App\Http\Livewire\Admin\Masters\ProgramSubCategories::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('program-duration')->get('/program-duration', [App\Http\Livewire\Admin\Masters\ProgramDurations::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('program-level')->get('/program-level', [App\Http\Livewire\Admin\Masters\ProgramLevels::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('academic-year')->get('/academic-year', [App\Http\Livewire\Admin\Masters\AcademicYears::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('academic-pattern')->get('/academic-pattern', [App\Http\Livewire\Admin\Masters\AcademicPatterns::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('accreditation')->get('/accreditation', [App\Http\Livewire\Admin\Masters\Accreditations::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('program-group')->get('/program-group', [App\Http\Livewire\Admin\Masters\ProgramGroups::class, '__invoke'])->middleware(['permission:academic-master-list']);
        Route::name('degree-awarding-body')->get('/degree-awarding-body', [App\Http\Livewire\Admin\Masters\DegreeAwardingBodies::class, '__invoke'])->middleware(['permission:academic-master-list']);
        
        Route::name('program')->get('/program', [App\Http\Livewire\Admin\Masters\Programs::class, '__invoke'])->middleware(['permission:program-list']);
        Route::name('program.view')->get('/program/{program_id}', [App\Http\Livewire\Admin\Masters\Programs::class, '__invoke'])->middleware(['permission:program-list']);
        Route::name('course')->get('/course', [App\Http\Livewire\Admin\Masters\Courses::class, '__invoke'])->middleware(['permission:course-list']);
        Route::name('course.view')->get('/course/{course_id}', [App\Http\Livewire\Admin\Masters\Courses::class, '__invoke'])->middleware(['permission:course-list']);

        Route::name('combined-intake')->get('/combined-intake', [App\Http\Livewire\Admin\Masters\CombinedIntakes::class, '__invoke'])->middleware(['permission:academic-master-list']);

        // Common Masters
        Route::name('master-group')->get('/master-group', [App\Http\Livewire\Admin\Masters\MasterGroups::class, '__invoke'])->middleware(['permission:common-master-list']);
        Route::name('master-category')->get('/master-category', [App\Http\Livewire\Admin\Masters\MasterCategories::class, '__invoke'])->middleware(['permission:common-master-list']);
        Route::name('master-option')->get('/master-option', [App\Http\Livewire\Admin\Masters\MasterOptions::class, '__invoke'])->middleware(['permission:common-master-list']);
        Route::name('master-option.category')->get('/master-option/{master_category_id}', [App\Http\Livewire\Admin\Masters\MasterOptions::class, '__invoke'])->middleware(['permission:common-master-list']);
        Route::name('system-model')->get('/system-model', [App\Http\Livewire\Admin\Masters\SystemModels::class, '__invoke'])->middleware(['permission:common-master-list']);

        // Location Masters
        Route::name('country')->get('/country', [App\Http\Livewire\Admin\Masters\Countries::class, '__invoke'])->middleware(['permission:location-master-list']);

        // Enrollment Masters
        Route::name('grade-type')->get('/grade-type', [App\Http\Livewire\Admin\Masters\GradeTypes::class, '__invoke'])->middleware(['permission:enrollment-master-list']);
        Route::name('grade-category')->get('/grade-category', [App\Http\Livewire\Admin\Masters\GradeCategories::class, '__invoke'])->middleware(['permission:grade-category-list']);
        Route::name('grade-category.pattern')->get('/grade-pattern/{grade_category_id}', [App\Http\Livewire\Admin\Masters\GradePatterns::class, '__invoke'])->middleware(['permission:grade-category-list']);
        
        Route::name('academic-component-type')->get('/academic-component-type', [App\Http\Livewire\Admin\Masters\AcademicComponentTypes::class, '__invoke'])->middleware(['permission:enrollment-master-list']);
        Route::name('academic-component-group')->get('/academic-component-group', [App\Http\Livewire\Admin\Masters\AcademicComponentGroups::class, '__invoke'])->middleware(['permission:enrollment-master-list']);
        Route::name('academic-component-category')->get('/academic-component-category', [App\Http\Livewire\Admin\Masters\AcademicComponentCategories::class, '__invoke'])->middleware(['permission:enrollment-master-list']);
        Route::name('exam-pattern')->get('/exam-pattern', [App\Http\Livewire\Admin\Masters\ExamPatterns::class, '__invoke'])->middleware(['permission:exam-pattern-list']);
        Route::name('exam-pattern.setting')->get('/exam-pattern/{exam_pattern_id}', [App\Http\Livewire\Admin\Masters\ExamPatterns::class, '__invoke'])->middleware(['permission:exam-pattern-list']);
    
        //Mail
        Route::name('mail-template')->get('/mail-template', [App\Http\Livewire\Admin\Masters\MailTemplates::class, '__invoke'])->middleware(['permission:mail-Templates-list']);
    });

    // Enrollments
    Route::prefix('enrollments')->group(function () {
        Route::name('enrollment')->get('/enrollment', [App\Http\Livewire\Admin\Enrollments\Enrollments::class, '__invoke'])->middleware(['permission:enrollment-list']);
        Route::name('enrollment.course')->get('/enrollment-course/{enrollment_id}', [App\Http\Livewire\Admin\Enrollments\EnrollmentCourses::class, '__invoke'])->middleware(['permission:enrollment-course-list']);
        Route::name('enrollment.student')->get('/enrollment-student/{enrollment_id}', [App\Http\Livewire\Admin\Enrollments\EnrollmentStudents::class, '__invoke'])->middleware(['permission:enrollment-student-list']);
        Route::name('enrollment.course.exam-pattern')->get('/enrollment-exam-pattern/{enrollment_course_id}', [App\Http\Livewire\Admin\Enrollments\EnrollmentExamPatterns::class, '__invoke'])->middleware(['permission:enrollment-exam-pattern-list']);
        Route::name('enrollment.course.mark')->get('/enrollment-mark/{enrollment_course_id}', [App\Http\Livewire\Admin\Enrollments\EnrollmentMarks::class, '__invoke'])->middleware(['permission:enrollment-mark-list']);
    });
    
    // Students
    Route::prefix('students')->group(function () {
        Route::name('student')->get('/student', [App\Http\Livewire\Admin\Students\Students::class, '__invoke'])->middleware(['permission:student-list']);
    });
    
    // Staffs
    Route::prefix('staffs')->group(function () {
        Route::name('staff')->get('/staff', [App\Http\Livewire\Admin\Staffs\Staffs::class, '__invoke'])->middleware(['permission:staff-list']);
    });

    // Forms
    Route::prefix('forms')->group(function () {
        Route::name('form')->get('/form', [App\Http\Livewire\Admin\Forms\Forms::class, '__invoke'])->middleware(['permission:form-list']);
        Route::name('form-field')->get('/form-field/{form_id}', [App\Http\Livewire\Admin\Forms\FormFields::class, '__invoke'])->middleware(['permission:form-list']);
        Route::name('form-preview')->get('/form-preview/{form_id}', [App\Http\Livewire\Admin\Forms\FormPreviews::class, '__invoke'])->middleware(['permission:form-list']);
        Route::name('form-data')->get('/form-data/{form_id}', [App\Http\Livewire\Admin\Forms\FormDatas::class, '__invoke'])->middleware(['permission:form-list']);
        Route::name('form-data-edit')->get('/form-data-edit/{form_data_id}', [App\Http\Livewire\Admin\Forms\FormPreviews::class, '__invoke'])->middleware(['permission:form-list']);
        Route::name('form-data-view')->get('/form-data-view/{form_data_id}', [App\Http\Livewire\Admin\Forms\FormDatas::class, '__invoke'])->middleware(['permission:form-list']);
    });


    // Reports
    Route::prefix('reports')->group(function () {
        Route::name('student-mark')->get('/student-mark/{enrollment_id}', [App\Http\Livewire\Admin\Reports\StudentMarkReports::class, '__invoke'])->middleware(['permission:enrollment-list']);
    });

    // Roles and Permissions
    Route::prefix('access')->group(function () {
        Route::name('role')->get('/role', [App\Http\Livewire\Admin\Access\Roles::class, '__invoke']);
        // Route::name('permission')->get('/permission', [App\Http\Livewire\Admin\Access\Permissions::class, '__invoke']);
        Route::resource('permission', App\Http\Controllers\Admin\Access\PermissionController::class);
        Route::resource('role.permissions', App\Http\Controllers\Admin\Access\RolePermissionController::class);
        
        Route::name('user')->get('/user', [App\Http\Livewire\Admin\Access\Users::class, '__invoke']);
        Route::resource('user.permissions', App\Http\Controllers\Admin\Access\UserPermissionController::class);
    }); 

    // Logs
    Route::name('log')->get('/log', App\Http\Livewire\Admin\Logs\Logs::class);
    Route::name('model-log')->get('/log/{subject_type}', App\Http\Livewire\Admin\Logs\Logs::class);
    Route::name('record-log')->get('/log/{subject_type}/{subject_id}', App\Http\Livewire\Admin\Logs\Logs::class);

});

// Student Login
Route::middleware(['auth:sanctum', 'verified', 'student'])->group(function () {
    Route::prefix('student')->name('student.')->group(function () {
        Route::name('dashboard')->get('/dashboard', [App\Http\Livewire\Student\Dashboards::class, '__invoke']);
    });
});