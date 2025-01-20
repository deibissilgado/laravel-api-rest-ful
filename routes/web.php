<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//ruta para obtener los token http://laravel-api-rest-ful.test/setup
/*un token es una cadena de caracteres que se utiliza para autenticar las solicitudes 
  realizadas a la API. Es un identificador único que se utiliza para verificar 
  la identidad de un usuario o una aplicación que realiza la solicitud. */
Route::get('/setup', function () {
    $credentials =[
        'email'=>"admin@admin.com",
        'password'=>'password'
    ];
    // Si no existe un usaurio con las credeniales especificadas
    if (!auth()->attempt($credentials)) {
        $user = new User();
        $user->name = 'Admin' ;
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();
    }
    if (auth()->attempt($credentials)) {
        $user = auth()->user();
        /** @var User $user */
        // se crean tres token con permisos distintos
        $adminToken = $user->createToken('admin-token',['create','update','delete']);
        $updateToken = $user->createToken('update-token',['create','update']);
        $basicToken =  $user->createToken('admin-basic');

        return [
          'admin'=>$adminToken->plainTextToken,
          'update'=>$updateToken->plainTextToken,
          'basic'=>$basicToken->plainTextToken,
        ];

    }
});
