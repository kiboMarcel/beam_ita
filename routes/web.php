<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\DefaultController;
use App\Http\Controllers\backend\DashboradController;

use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\setup\StudentClassController;
use App\Http\Controllers\backend\setup\StudentYearController;
use App\Http\Controllers\backend\setup\StudentBranchController;
use App\Http\Controllers\backend\setup\StudentGroupController;
use App\Http\Controllers\backend\setup\FeeCategoryController;
use App\Http\Controllers\backend\setup\FeeAmountController;
use App\Http\Controllers\backend\setup\ExamTypeController;
use App\Http\Controllers\backend\setup\SchoolSubjectController;
use App\Http\Controllers\backend\setup\SubjectGroupController;
use App\Http\Controllers\backend\setup\AssignSubjectController;
use App\Http\Controllers\backend\setup\AssignClassController;
use App\Http\Controllers\backend\setup\DesignationController;
use App\Http\Controllers\backend\setup\SchoolSeasonController;
use App\Http\Controllers\backend\setup\SlicePaymentController;
use App\Http\Controllers\backend\setup\SchoolInfoController;

use App\Http\Controllers\backend\student\StudentRegistrationController;
use App\Http\Controllers\backend\student\RegistrationFeeController;
use App\Http\Controllers\backend\student\SchoolingController;
use App\Http\Controllers\backend\student\StudentAttendanceController;

use App\Http\Controllers\backend\employee\EmployeeRegController;
use App\Http\Controllers\backend\employee\EmployeeSalaryController;
use App\Http\Controllers\backend\employee\EmployeeLeaveController;
use App\Http\Controllers\backend\employee\EmployeeAttendanceController;
use App\Http\Controllers\backend\employee\MonthlySalaryController;

use App\Http\Controllers\backend\marks\MarksController;

use App\Http\Controllers\backend\account\AccountSalaryController;

use App\Http\Controllers\backend\report\MarkSheetController;
use App\Http\Controllers\backend\report\ClassMarkSheetController;
use App\Http\Controllers\backend\report\ExamDecisionController;


use App\Http\Controllers\backend\accounting\StudentFeeController;
use App\Http\Controllers\backend\accounting\FeeDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| http://Bɘam.test
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'Logout']) -> name('admin.logout');


Route::group(['middleware' => 'auth'], function(){


    //User management

    Route::prefix('users')->middleware(['UserRole'])->group( function() {
        
        Route::get('/view', [UserController::class, 'UserView']) -> name('user.view');

        Route::get('/add', [UserController::class, 'UserAdd']) -> name('user.add');

        Route::post('/store', [UserController::class, 'UserStore']) -> name('user.store');

        Route::get('/edit/{id}', [UserController::class, 'UserEdit']) -> name('user.edit');

        Route::post('/update/{id}', [UserController::class, 'UserUpdate']) -> name('user.update');

        Route::get('/delete/{id}', [UserController::class, 'UserDelete']) -> name('user.delete');

    } );


// User Account Setting

    Route::prefix('profile')->group( function() {
        
        Route::get('/view', [ProfileController::class, 'ProfileView']) -> name('profil.view');

        Route::post('/update', [ProfileController::class, 'ProfileUpdate']) -> name('profil.update');

        Route::get('/password/view', [ProfileController::class, 'ProfilePasswordView']) -> name('profil.password');

        Route::post('/password/update', [ProfileController::class, 'PasswordUpdate']) -> name('password.update');
        
    } );


// general set up 

    Route::prefix('setups')->middleware(['UserRole'])->group( function() {
        
        //student class 
        Route::get('/student/class/view', [StudentClassController::class, 'ViewStudentClass']) 
        -> name('student.class.view');
        
        Route::get('/student/class/add', [StudentClassController::class, 'StudentClassAdd']) 
        -> name('student.class.add');
        
        Route::post('/student/class/store', [StudentClassController::class, 'StudentClassStore']) 
        -> name('student.class.store');
        
        Route::get('/student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit']) 
        -> name('student.class.edit');
        
        Route::post('/student/class/update/{id} ', [StudentClassController::class, 'StudentClassUpdate']) 
        -> name('student.class.update');
        
        Route::get('/student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete']) 
        -> name('student.class.delete');
        

        //student year
        Route::get('/student/year/view', [StudentYearController::class, 'ViewStudentYear']) 
        -> name('student.year.view');
        
        Route::get('/student/year/add', [StudentYearController::class, 'StudentYearAdd']) 
        -> name('student.year.add');
        
        Route::post('/student/year/store', [StudentYearController::class, 'StudentYearStore']) 
        -> name('student.year.store');
        
        Route::get('/student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit']) 
        -> name('student.year.edit');
        
        Route::post('/student/year/update/{id} ', [StudentYearController::class, 'StudentYearUpdate']) 
        -> name('student.year.update');
        
        Route::get('/student/year/active/{id}', [StudentYearController::class, 'StudentYearActive']) 
        -> name('student.year.active');

        Route::get('/student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete']) 
        -> name('student.year.delete');
        

        //student branch
        Route::get('/student/branch/view', [StudentBranchController::class, 'ViewStudentBranch']) 
        -> name('student.branch.view');
        
        Route::get('/student/branch/add', [StudentBranchController::class, 'StudentBranchAdd']) 
        -> name('student.branch.add');
        
        Route::post('/student/branch/store', [StudentBranchController::class, 'StudentBranchStore']) 
        -> name('student.branch.store');
        
        Route::get('/student/branch/edit/{id}', [StudentBranchController::class, 'StudentBranchEdit']) 
        -> name('student.branch.edit');
        
        Route::post('/student/branch/update/{id} ', [StudentBranchController::class, 'StudentBranchUpdate']) 
        -> name('student.branch.update');
        
        Route::get('/student/branch/delete/{id}', [StudentBranchController::class, 'StudentBranchDelete']) 
        -> name('student.branch.delete');
        

        //student group
        Route::get('/student/group/view', [StudentGroupController::class, 'ViewStudentGroup']) 
        -> name('student.group.view');
        
        Route::get('/student/group/add', [StudentGroupController::class, 'StudentGroupAdd']) 
        -> name('student.group.add');
        
        Route::post('/student/group/store', [StudentGroupController::class, 'StudentGroupStore']) 
        -> name('student.group.store');
        
        Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit']) 
        -> name('student.group.edit');
        
        Route::post('/student/group/update/{id} ', [StudentGroupController::class, 'StudentGroupUpdate']) 
        -> name('student.group.update');
        
        Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete']) 
        -> name('student.group.delete');
        

        //fee category
        Route::get('/fee/category/view', [FeeCategoryController::class, 'ViewFeeCat']) 
        -> name('fee.category.view');
        
        Route::get('/fee/category/add', [FeeCategoryController::class, 'FeeCatAdd']) 
        -> name('fee.category.add');
        
        Route::post('/fee/category/store', [FeeCategoryController::class, 'FeeCatStore']) 
        -> name('fee.category.store');
        
        Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit']) 
        -> name('fee.category.edit');
        
        Route::post('/fee/category/update/{id} ', [FeeCategoryController::class, 'FeeCatUpdate']) 
        -> name('fee.category.update');
        
        Route::get('/fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCatDelete']) 
        -> name('fee.category.delete');
        

        //type fee amount 
        Route::get('/fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount']) 
        -> name('fee.amount.view');
        
        Route::get('/fee/amount/add', [FeeAmountController::class, 'FeeAmountAdd']) 
        -> name('fee.amount.add');
        
        Route::post('/fee/amount/store', [FeeAmountController::class, 'FeeAmountStore']) 
        -> name('fee.amount.store');
        
        Route::get('/fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'FeeAmountEdit']) 
        -> name('fee.amount.edit');
        
        Route::post('/fee/amount/update/{fee_category_id}/{jsonId} ', [FeeAmountController::class, 'FeeAmountUpdate']) 
        -> name('fee.amount.update');
        
        Route::get('/fee/amount/detail/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetail']) 
        -> name('fee.amount.detail');
        
        Route::get('/fee/amount/delete/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDelete']) 
        -> name('fee.amount.delete');
        
        //exam type
        Route::get('/exam/type/view', [ExamTypeController::class, 'ViewExamType']) 
        -> name('exam.type.view');
            
        Route::get('/exam/type/add', [ExamTypeController::class, 'ExamTypeAdd']) 
        -> name('exam.type.add');
        
        Route::post('/exam/category/store', [ExamTypeController::class, 'ExamTypeStore']) 
        -> name('exam.type.store');
        
        Route::get('/exam/category/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])
        -> name('exam.type.edit');
        
        Route::post('/exam/category/update/{id} ', [ExamTypeController::class, 'ExamTypeUpdate']) 
        -> name('exam.type.update');
        
        Route::get('/exam/category/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete']) 
        -> name('exam.type.delete');
        
        //subject group
        Route::get('/subject/group/view', [SubjectGroupController::class, 'ViewSubjectGroup']) 
        -> name('subject.group.view');

        Route::get('/subject/group/add', [SubjectGroupController::class, 'SubjectGroupAdd']) 
        -> name('subject.group.add');

        Route::post('/subject/group/store', [SubjectGroupController::class, 'SubjectGroupStore']) 
        -> name('subject.group.store');

        Route::get('/subject/group/edit/{id}', [SubjectGroupController::class, 'SubjectGroupEdit']) 
        -> name('subject.group.edit');

        Route::post('/subject/group/update/{id}', [SubjectGroupController::class, 'SubjectGroupUpdate']) 
        -> name('subject.group.update');

        Route::get('/subject/group/delete/{id}', [SubjectGroupController::class, 'SubjectGroupDelete']) 
        -> name('subject.group.delete');


        //subject type
        Route::get('/subject/type/view', [SchoolSubjectController::class, 'ViewSubjectType']) 
        -> name('subject.type.view');
            
        Route::get('/subject/type/add', [SchoolSubjectController::class, 'SubjectTypeAdd']) 
        -> name('subject.type.add');
        
        Route::post('/subject/category/store', [SchoolSubjectController::class, 'SubjectTypeStore']) 
        -> name('subject.type.store');
        
        Route::get('/subject/category/edit/{id}', [SchoolSubjectController::class, 'SubjectTypeEdit']) 
        -> name('subject.type.edit');
        
        Route::post('/subject/category/update/{id} ', [SchoolSubjectController::class, 'SubjectTypeUpdate']) 
        -> name('subject.type.update');
        
        Route::get('/subject/category/delete/{id}', [SchoolSubjectController::class, 'SubjectTypeDelete']) 
        -> name('subject.type.delete');
        
        //assign subject
        Route::get('/assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject']) 
        -> name('assign.subject.view');
            
        Route::get('/assign/subject/add', [AssignSubjectController::class, 'AssignSubjectAdd']) 
        -> name('assign.subject.add');
        
        Route::post('/assign/subject/store', [AssignSubjectController::class, 'AssignSubjectStore']) 
        -> name('assign.subject.store');
        
        Route::get('/assign/subject/edit/{class_id}/{branch_id?}', [AssignSubjectController::class, 'AssignSubjectEdit']) 
        -> name('assign.subject.edit');
        
        Route::post('/assign/subject/update/{class_id}/{jsonId}/{branch_id?}', [AssignSubjectController::class, 'AssignSubjectUpdate']) 
        -> name('assign.subject.update');
        
        Route::get('/assign/subject/detail/{class_id}/{branch_id?}', [AssignSubjectController::class, 'AssignSubjectDetail']) 
        -> name('assign.subject.detail');
        
        Route::get('/assign/subject/delete/{class_id}/{branch_id?}', [AssignSubjectController::class, 'AssignSubjectDelete']) 
        -> name('assign.subject.delete');
        
        Route::get('/assign/subject/remove/single/{id} ', [AssignSubjectController::class, 'AssignSubjectDeleteSingle']) 
        -> name('assign.subject.remove.single');
        
        //assign classes
        Route::get('/assign/class/view', [AssignClassController::class, 'ViewAssignClass']) 
        -> name('assign.class.view');
            
        Route::get('/assign/class/add', [AssignClassController::class, 'AssignClassAdd']) 
        -> name('assign.class.add');
        
        Route::post('/assign/class/store', [AssignClassController::class, 'AssignClassStore']) 
        -> name('assign.class.store');
        
        Route::get('/assign/class/edit/{class_id}/{branch_id?}', [AssignClassController::class, 'AssignClassEdit']) 
        -> name('assign.class.edit');
        
        Route::post('/assign/class/update/{class_id}/{jsonId}/{branch_id?}', [AssignClassController::class, 'AssignClassUpdate']) 
        -> name('assign.class.update');
        
        Route::get('/assign/class/detail/{class_id}/{branch_id?}', [AssignClassController::class, 'AssignClassDetail']) 
        -> name('assign.class.detail');
        
        /* Route::get('/assign/class/delete/{class_id}/{branch_id?}', [AssignClassController::class, 'AssignClassDeleteAll']) 
        -> name('assign.class.delete'); */
        
        Route::get('/assign/class/delete/{id}', [AssignClassController::class, 'AssignClassDeleteSingle']) 
        -> name('assign.class.delete.single');
        
        //subject type
        Route::get('/designation/view', [DesignationController::class, 'ViewDesignation']) -> 
        name('designation.view');
            
        Route::get('/designation/add', [DesignationController::class, 'DesignationAdd']) -> 
        name('designation.add');
        
        Route::post('/designation/store', [DesignationController::class, 'DesignationStore']) -> 
        name('designation.store');
        
        Route::get('/designation/edit/{id}', [DesignationController::class, 'DesignationEdit']) -> 
        name('designation.edit');
        
        Route::post('/designation/update/{id} ', [DesignationController::class, 'DesignationUpdate']) -> 
        name('designation.update');
        
        Route::get('/designation/delete/{id}', [DesignationController::class, 'DesignationDelete']) -> 
        name('designation.delete');

        ////season type
        Route::get('/season/view', [SchoolSeasonController::class, 'ViewSeason']) -> 
        name('season.view');
            
        Route::get('/season/add', [SchoolSeasonController::class, 'SeasonAdd']) -> 
        name('season.add');
        
        Route::post('/season/store', [SchoolSeasonController::class, 'SeasonStore']) -> 
        name('season.store');
        
        Route::get('/season/edit/{id}', [SchoolSeasonController::class, 'SeasonEdit']) -> 
        name('season.edit');
        
        Route::post('/season/update/{id} ', [SchoolSeasonController::class, 'SeasonUpdate']) -> 
        name('season.update');
        
        Route::get('/season/delete/{id}', [SchoolSeasonController::class, 'SeasonDelete']) -> 
        name('season.delete');
    

        /////slice route
        Route::get('/slice/view', [SlicePaymentController::class, 'ViewSlice']) -> 
        name('slice.view');
        
        Route::get('/slice/add', [SlicePaymentController::class, 'SliceAdd']) -> 
        name('slice.add');
        
        Route::post('/slice/store', [SlicePaymentController::class, 'SliceStore']) -> 
        name('slice.store');
        
        Route::get('/slice/detail/{class_id} ', [SlicePaymentController::class, 'SliceDetail']) -> 
        name('slice.detail');


        /////School info route
        Route::get('/school/info/view', [SchoolInfoController::class, 'ViewInfo']) -> 
        name('school.info.view');
        
        Route::get('/school/info/add', [SchoolInfoController::class, 'InfoAdd']) -> 
        name('school.info.add');
        
        Route::post('/school/info/store', [SchoolInfoController::class, 'InfoStore']) -> 
        name('school.info.store');
        
        Route::get('/school/info/edit/{id} ', [SchoolInfoController::class, 'InfoEdit']) -> 
        name('school.info.edit');

        Route::post('/school/info/update/{id} ', [SchoolInfoController::class, 'InfoUpdate']) -> 
        name('school.info.update');

    });


    Route::prefix('students')->group( function(){

        //student registration
        Route::get('/reg/view', [StudentRegistrationController::class, 'ViewRegistration']) -> 
        name('student.registration.view');
            
        Route::get('/reg/add', [StudentRegistrationController::class, 'RegistrationAdd']) -> 
        name('student.registration.add');
        
        Route::get('/year/class/search', [StudentRegistrationController::class, 'StudentSearch']) -> 
        name('student.year.class.wise');
        
        Route::post('/reg/store', [StudentRegistrationController::class, 'RegistrationStore']) -> 
        name('student.registration.store');
        
        Route::get('/reg/edit/{student_id}', [StudentRegistrationController::class, 'RegistrationEdit']) -> 
        name('student.registration.edit');
        
        Route::post('/reg/update/{student_id} ', [StudentRegistrationController::class, 'RegistrationUpdate']) -> 
        name('student.registration.update');
   
        Route::get('/reg/promotion/{student_id}', [StudentRegistrationController::class, 'StudentPromotionView']) -> 
        name('student.registration.promotion');
        
        Route::post('/reg/promote/{student_id} ', [StudentRegistrationController::class, 'StudentPromotion']) -> 
        name('student.promote');

        Route::get('/reg/list/print/{year_id}/{class_id}/{group_id?}/{branch_id?}', [StudentRegistrationController::class, 'StudentListPrint']) -> 
        name('student.list.print');
        
        Route::get('/reg/search/promotion/view', [StudentRegistrationController::class, 'StudentPromoSearchView']) -> 
        name('student.promotion.search.view');

        Route::get('/reg/search/promotion', [StudentRegistrationController::class, 'StudentPromoSearch']) -> 
        name('student.promotion.search');

        Route::get('/reg/detail/{student_id}', [StudentRegistrationController::class, 'StudentDetail']) -> 
        name('student.detail.pdf');

        Route::get('/reg/delete/{student_id}', [StudentRegistrationController::class, 'RegistrationDelete']) -> 
        name('student.registration.delete');

        
   

        ///DEFAULT CLASS CONNTROLLERS START
        Route::get('student/class/branch', [DefaultController::class, 'GetClassBranch']) -> 
        name('student.getclass.branch');

        Route::get('student/class/group', [DefaultController::class, 'GetClassGroup']) -> 
        name('student.getclass.group');

        //roll generate
        //-------------
        //route

        //frai inscription 
        Route::get('/reg/fee/view', [RegistrationFeeController::class, 'ViewRegistrationFee']) -> 
        name('registration.fee.view');
        
        Route::get('/reg/fee/data', [RegistrationFeeController::class, 'RegistrationFeeData']) -> 
        name('registration.fee.get');
        
        Route::get('/reg/fee/pay', [RegistrationFeeController::class, 'RegistrationFeePay']) -> 
        name('student.registration.fee.paySlip');


        //schooling 
        Route::get('/schooling/fee/view', [SchoolingController::class, 'ViewSchooling']) -> 
        name('schooling.fee.view');
        
        Route::get('/schooling/fee/data', [SchoolingController::class, 'SchoolingData']) -> 
        name('schooling.fee.get');
        
        Route::get('/schooling/pay/{student_id}', [SchoolingController::class, 'SchoolingPaymentView']) -> 
        name('student.schooling.pay');

        Route::post('/schooling/store/{student_id}', [SchoolingController::class, 'SchoolingPayementStore']) -> 
        name('schooling.store');

        Route::get('/schooling/delete/single/{id}', [SchoolingController::class, 'SchoolingPaymentDelete']) -> 
        name('schooling.delete.single');

  
    });

    Route::prefix('employees')->middleware(['UserRole'])->group( function(){
        
        //employee registration
        Route::get('/reg/view', [EmployeeRegController::class, 'ViewEmployee']) -> 
        name('employee.registration.view');

        Route::get('employee/add/', [EmployeeRegController::class, 'EmployeeAdd']) -> 
        name('employee.add');

        Route::post('employee/store/', [EmployeeRegController::class, 'EmployeeStore']) -> 
        name('employee.store');

        Route::get('employee/edit/{id}', [EmployeeRegController::class, 'EmployeeEdit']) -> 
        name('employee.edit');

        Route::post('employee/edit/{id}', [EmployeeRegController::class, 'EmployeeUpdate']) -> 
        name('employee.update');

        Route::get('employee/detail/{id}', [EmployeeRegController::class, 'EmployeeDetail']) -> 
        name('employee.detail.pdf');

        //employee salary
        Route::get('/salary/view', [EmployeeSalaryController::class, 'ViewEmployeeSalary']) -> 
        name('employee.salary.view');

        Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryInrement']) -> 
        name('employee.salary.increment');

        Route::post('/salary/increment/store/{id}', [EmployeeSalaryController::class, 'SalaryInrementStore']) -> 
        name('update.salary.increment.store');

        Route::get('/salary/detail/{id}', [EmployeeSalaryController::class, 'SalaryDetail']) -> 
        name('employee.salary.detail');


        //employee leave view
        Route::get('/employee/leave', [EmployeeLeaveController::class, 'ViewLeave']) -> 
        name('employee.leave.view');

        Route::get('/add/leave', [EmployeeLeaveController::class, 'LeaveAdd']) -> 
        name('leave.add');

        Route::post('/store', [EmployeeLeaveController::class, 'LeaveStore']) -> 
        name('employee.leave.store');
        
        Route::get('/edit/{id}', [EmployeeLeaveController::class, 'LeaveEdit']) -> 
        name('employee.leave.edit');

        Route::post('/update/{id}', [EmployeeLeaveController::class, 'LeaveUpdate']) -> 
        name('employee.leave.update');

        Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'LeaveDelete']) -> 
        name('employee.leave.delete');


        //employee attedance route
        Route::get('/employee/attendance/view', [EmployeeAttendanceController::class, 'AtdceView']) -> 
        name('employee.attendance.view');

        Route::get('/employee/attendance/add', [EmployeeAttendanceController::class, 'AtdceAdd']) -> 
        name('attendance.add');

        Route::post('/employee/attendance/store', [EmployeeAttendanceController::class, 'AtdceStore']) -> 
        name('attendance.store');

        Route::get('/employee/attendance/edit/{date}', [EmployeeAttendanceController::class, 'AtdceEdit']) -> 
        name('attendance.edit');

        Route::get('/employee/attendance/detail/{date}', [EmployeeAttendanceController::class, 'AtdceDetail']) -> 
        name('attendance.detail');
        
        //employee monthly salary route
        Route::get('/employee/month/salary/view', [MonthlySalaryController::class, 'MonthlySalaryView']) -> 
        name('employee.monthly.salary.view');
        
        Route::get('/employee/month/salary/get', [MonthlySalaryController::class, 'MonthlySalaryGet']) -> 
        name('employee.monthly.salary.get');
        
        Route::get('/employee/month/salary/pay/{employee_id}', [MonthlySalaryController::class, 'MonthlySalaryPay']) -> 
        name('employee.monthly.salary.pay');

        
    });

    Route::prefix('marks')->group( function() {
        
        Route::get('/entry/add', [MarksController::class, 'MarksAdd']) -> 
        name('marks.entry.add');

        Route::post('mark/store', [MarksController::class, 'MarksStore']) -> 
        name('marks.store');

        Route::get('mark/edit', [MarksController::class, 'MarksEdit']) -> 
        name('marks.entry.edit');

        Route::get('mark/edit/student', [MarksController::class, 'MarksStudentEditSearch']) -> 
        name('students.edit.getstudents');

        Route::get('mark/edit/student/detail/{student_id}/{assign_subject_id}/{season_id}', [MarksController::class, 'MarksStudentDetail']) -> 
        name('students.edit.detail');

        Route::post('mark/student/update/{student_id}/{assign_subject_id}/{year_id}/{season_id}', [MarksController::class, 'MarksStudentUpdate']) -> 
        name('marks.update');

        ///DEFAULT CLASS CONNTROLLERS START
        Route::get('mark/getsubject', [DefaultController::class, 'MarksGetSubjects']) -> 
        name('marks.getsubject');

        Route::get('mark/getstudent', [DefaultController::class, 'GetSutudents']) -> 
        name('students.get.students');

        Route::get('student/season', [DefaultController::class, 'GetSeason']) -> 
        name('student.getSeason');

      
        
    } );

    Route::prefix('accountSalary')->middleware(['UserRole'])->group( function() {
        
        //Employeer salary
        Route::get('/account/salary/view', [AccountSalaryController::class, 'ViewSalary']) -> 
        name('account.salary.view');

        Route::get('/account/salary/add', [AccountSalaryController::class, 'SalaryAdd']) -> 
        name('account.salary.add');

        Route::post('/account/salary/store', [AccountSalaryController::class, 'SalaryStore']) -> 
        name('account.salary.store');

        Route::get('/account/salary/get/employee', [AccountSalaryController::class, 'SalaryEmployeeGet']) -> 
        name('account.salary.getemployee');

   
        
    } );

    Route::prefix('reportManagement')->group( function() {
        
        //marksheet generate
        
        Route::get('/marksheet/view', [MarkSheetController::class, 'MarkSheetView']) -> 
        name('marksheet.generate.view');

        Route::get('/marksheet/student/{year_id}/{class_id}/{group_id}/{branch_id}/{student_id}/{season_id}', [MarkSheetController::class, 'MarkSheetGet']) -> 
        name('marksheet.student.get');


        Route::get('/ranking/list/view', [MarkSheetController::class, 'MarkSheetListView']) -> 
        name('marksheet.list.view');

        Route::get('/ranking/list/get/{year_id}/{class_id}/{group_id}/{branch_id}/{season_id}', [MarkSheetController::class, 'MarkSheetListGet']) -> 
        name('ranking.list.get');

         //class  marksheet
         Route::get('/classmarskheet/view', [ClassMarkSheetController::class, 'ClassMarkSheetView']) -> 
         name('classmarskheet.view');
 
 
         Route::get('/class/marskheet/list/{year_id}/{class_id}/{group_id}/{season_id}/{branch_id?}', [ClassMarkSheetController::class, 'ClassMarkSheetList']) -> 
         name('classmarskheet.list');

        ///DEFAULT CLASS CONNTROLLERS START
        Route::get('marksheet/getstudent', [DefaultController::class, 'GetSutudentForMarksheet']) -> 
        name('marksheet.get.students');

        //studenct Attendance route
        Route::get('student/attendance/view', [StudentAttendanceController::class, 'StudentAttendanceView']) -> 
        name('student.attendance.view');

        Route::get('student/attendance/add', [StudentAttendanceController::class, 'StudentAttendanceAdd']) -> 
        name('student.attendance.add');

        Route::get('student/attendance/get', [StudentAttendanceController::class, 'StudentAttendanceGet']) -> 
        name('student.attendance.get');

        Route::post('student/attendance/store', [StudentAttendanceController::class, 'StudentAttendanceStore']) -> 
        name('student.attendance.store');

        Route::get('/ranking/getclass', [DefaultController::class, 'GetClass']) -> 
        name('ranking.get.class');
        
        //Decision 
        Route::get('/decision/add', [ExamDecisionController::class, 'DecisionAdd']) -> 
        name('decision.entry.add');

        Route::post('decision/store', [ExamDecisionController::class, 'DecisionStore']) -> 
        name('decision.store');

        Route::get('decision/edit', [ExamDecisionController::class, 'DecisionEdit']) -> 
        name('decision.entry.edit');

        Route::get('decision/get/students', [ExamDecisionController::class, 'DecisionGetSutudents']) -> 
        name('decision.get.students');
        
    } );


    Route::prefix('accounting')->group( function() {
        
        //Accounting route
        Route::get('/student/fee', [StudentFeeController::class, 'ViewStudentFee']) -> 
        name('student.fee.view');

        Route::get('/student/fee/get/', [StudentFeeController::class, 'StudentFeeData']) -> 
        name('student.fee.get');

        Route::get('/student/fee/pay/{student_id}/{feeCategory_id}', [StudentFeeController::class, 'StudentOtherFeePayment']) -> 
        name('student.fee.pay');

        //global fee route
        Route::get('/global/fee', [FeeDetailController::class, 'ViewFeeDetail']) -> 
        name('global.fee.view');

        Route::get('/global/operation/reset/{id}', [FeeDetailController::class,'ResetOperationCount']) -> 
        name('global.operation.reset');

        Route::get('/global/amount/reset/{id}', [FeeDetailController::class,'ResetAmountCount']) -> 
        name('global.amount.reset');
       
        
    } );

    
});
