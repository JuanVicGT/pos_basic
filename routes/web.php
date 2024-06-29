<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

require_once __DIR__ . '/auth.php';

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\AttendenceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PurchasePosController;
use App\Http\Controllers\Backend\PurchaseOrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\UserController;

/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');

    /// Usuarios (solo admin) rutas
    Route::controller(UserController::class)->group(function () {
        Route::get('/all/user', 'index')->name('all.user');
        Route::get('/add/user', 'create')->name('add.user');
        Route::post('/store/user', 'store')->name('store.user');
        Route::get('/edit/user/{id}', 'edit')->name('edit.user');
        Route::post('/update/user', 'update')->name('update.user');
        Route::post('/delete/user/{id}', 'destroy')->name('destroy.user');
    });

    /// Empleados rutas
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/all/employee', 'AllEmployee')->name('all.employee');
        Route::get('/add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/store/employee', 'StoreEmployee')->name('employee.store');
        Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/update/employee', 'UpdateEmployee')->name('employee.update');
        Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');
    });

    /// Clientes rutas 
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/all/customer', 'AllCustomer')->name('all.customer');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('/store/customer', 'StoreCustomer')->name('customer.store');
        Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
        Route::post('/update/customer', 'UpdateCustomer')->name('customer.update');
        Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');
    });

    /// Proveedores rutas
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'StoreSupplier')->name('supplier.store');
        Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier');
        Route::post('/update/supplier', 'UpdateSupplier')->name('supplier.update');
        Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier');
        Route::get('/details/supplier/{id}', 'DetailsSupplier')->name('details.supplier');
    });

    /// Salarios adelantos rutas
    Route::controller(SalaryController::class)->group(function () {
        Route::get('/add/advance/salary', 'AddAdvanceSalary')->name('add.advance.salary');
        Route::get('/all/advance/salary', 'AllAdvanceSalary')->name('all.advance.salary');
        Route::get('/edit/advance/salary/{id}', 'EditAdvanceSalary')->name('edit.advance.salary');

        Route::post('/advance/salary/store', 'AdvanceSalaryStore')->name('advance.salary.store');
        Route::post('/advance/salary/update', 'AdvanceSalaryUpdate')->name('advance.salary.update');
        Route::get('/advance/salary/delete/{id}', 'AdvanceSalaryDelete')->name('delete.advance.salary');
    });

    /// Pago de salarios rutas
    Route::controller(SalaryController::class)->group(function () {
        Route::get('/pay/salary', 'PaySalary')->name('pay.salary');
        Route::get('/pay/now/salary/{id}', 'PayNowSalary')->name('pay.now.salary');
        Route::post('/employe/salary/store', 'EmployeSalaryStore')->name('employe.salary.store');
        Route::get('/month/salary', 'MonthSalary')->name('month.salary');
    });

    /// Asistencia rutas
    Route::controller(AttendenceController::class)->group(function () {
        Route::get('/employee/attend/list', 'EmployeeAttendenceList')->name('employee.attend.list');
        Route::get('/add/employee/attend', 'AddEmployeeAttendence')->name('add.employee.attend');
        Route::post('/employee/attend/store', 'EmployeeAttendenceStore')->name('employee.attend.store');
        Route::get('/edit/employee/attend/{date}', 'EditEmployeeAttendence')->name('employee.attend.edit');
        Route::get('/view/employee/attend/{date}', 'ViewEmployeeAttendence')->name('employee.attend.view');
    });

    /// categorias productos rutas 
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::post('/store/category', 'StoreCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    /// Productos rutas
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('product.store');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UdateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
        Route::post('/barcode/product', 'BarcodeProduct')->name('barcode.product');
    });

    /// Gastos rutas
    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/add/expense', 'AddExpense')->name('add.expense');
        Route::post('/store/expense', 'StoreExpense')->name('expense.store');
        Route::get('/today/expense', 'TodayExpense')->name('today.expense');
        Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');
        Route::post('/update/expense', 'UpdateExpense')->name('expense.update');
        Route::get('/month/expense', 'MonthExpense')->name('month.expense');
        Route::get('/year/expense/{year?}', 'YearExpense')->name('year.expense');
        Route::post('/year/filter/expense', 'FilterYearExpense')->name('filter.year.expense');
    });

    ///POS rutas 
    Route::controller(PosController::class)->group(function () {
        Route::get('/pos', 'Pos')->name('pos');
        Route::post('/add-cart', 'AddCart')->name('add.cart');
        Route::post('/add-barcode-cart', 'AddBarcodeCart')->name('add.barcode.cart');
        Route::get('/allitem', 'AllItem');
        Route::post('/cart-update/{rowId}', 'CartUpdate');
        Route::get('/cart-remove/{rowId}', 'CartRemove');
        Route::post('/create-invoice', 'CreateInvoice');
    });

    /// Purchase POS / POS de compras
    Route::controller(PurchasePosController::class)->group(function () {
        Route::get('/purchase/pos', 'Pos')->name('purchase.pos');
        Route::post('/purchase/add-cart', 'AddCart')->name('purchase.add.cart');
        Route::get('/purchase/cart-remove/{rowId}', 'CartRemove')->name('purchase.cart.remove');
        Route::post('/purchase/cart-update/{rowId}', 'CartUpdate')->name('purchase.cart.update');
    });

    /// Purchase orders / Compras de productos
    Route::controller(PurchaseOrderController::class)->group(function () {
        Route::get('/purchase', 'ListPurchase')->name('all.purchase.order');
        Route::get('/purchase/{order_id}', 'ViewPurchase')->name('purchase.view');
        Route::post('/purchase/create-invoice', 'FinalInvoice')->name('purchase.create.invoice');
        Route::post('/purchase/status/update', 'OrderStatusUpdate')->name('purchase.order.status');
    });

    /// Orders / Ventas
    Route::controller(OrderController::class)->group(function () {
        Route::post('/final-invoice', 'FinalInvoice');
        Route::get('/order', 'ListOrder')->name('all.order');
        Route::get('/ticket/order/{id}', 'PrintTicket')->name('ticket.order');
        Route::get('/order/details/{order_id}', 'OrderDetails')->name('order.details');
        Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');
        Route::get('/stock', 'StockManage')->name('stock.manage');
    });

    /// Reports / Reportes
    Route::controller(ReportController::class)->group(function () {
        Route::get('/report/difference', 'SalePurchaseDifference')->name('report.difference');
    });
}); // End User Middleware 