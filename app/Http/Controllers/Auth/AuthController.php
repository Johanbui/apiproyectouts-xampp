<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use mysqli;
use App\Mail\NotifyMail;
use App\Models\NotificacionesUsuarios;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Models\Rol;
use App\Models\Acta;
use App\Models\Documentos;
use App\Models\Blog;
use App\Models\File;
use App\Models\Idea;

use App\Models\Lista;
use App\Models\IdeaEstado;
use App\Models\ListaGrupo;

use App\Models\IdeasArchivos;
use App\Models\IdeasUsuarios;
use App\Models\Notificaciones;
use Illuminate\Support\Facades\DB;




class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
    // Verificar si se proporcionó un nombre de usuario
    if ($request->filled('username')) {
        // Obtener credenciales del formulario
        $email = $request->input('username');
        $password = $request->input('password');

        // Buscar al usuario por correo electrónico
        $user = User::where('email', $email)->first();

        // Verificar si el usuario existe
        if ($user) {
            // Verificar las credenciales manualmente
            if (Hash::check($password, $user->password)) {
                // Verificar activación de la cuenta
                $enable = $user->enable ?? false;

                if (!$enable) {
                    // Manejar el caso en que la cuenta no está activada
                       // Autenticación exitosa, redirigir con el token
    $token = auth()->getToken();
    return redirect("http://192.168.10.242/dist/?token=".$token);
                }

                // Redirigir con el token
                              // Autenticación exitosa, generar el token
                              $token = auth()->login($user);
return redirect("http://192.168.10.242/dist/?token=".$token);
            } else {
                // Imprimir información para depuración
                \Log::error('Failed authentication attempt - Incorrect password', ['email' => $email]);
            }
        } else {
            // Imprimir información para depuración
            \Log::error('Failed authentication attempt - User not found', ['email' => $email]);
        }

        // Manejar el caso en que la autenticación falla
        $alerta = "Su cuenta no se encuentra registrada en nuestro sistema, debe mandar un correo a la coordinación para solicitar su registro";
        return redirect("http://192.168.10.242/dist/?alerta=".$alerta);
    }
 else {
    // Manejar el caso en que no se proporciona un nombre de usuario
    $login = $request->has('login') ? $request->get('login') : 0;


            if($login == 1 ){
                return MsGraph::connect();
            }
            $graph = MsGraph::connect();
            $userid = MsGraph::get('/me/id');
            $username = MsGraph::get('/me/userPrincipalName');
            $user = User::where('email', $username['value'])->first();

            if ($user) {
                // El usuario ya está registrado, actualiza la contraseña
                $user->password = Hash::make($userid['value']);
                $user->save();
                // Resto de la lógica, por ejemplo, redirección, activación, etc.
                // ...
            }



            $user = MsGraph::get('me');
            $username = MsGraph::get('/me/userPrincipalName');
            $userid = MsGraph::get('/me/id');
            $userfirstname = MsGraph::get('/me/givenName');
            $userlastname = MsGraph::get('/me/surName');
            $userrolid = MsGraph::get('/me/jobTitle');
            $rolid = 5;


            $credentials = ["email"=>$username['value'],"password" =>$userid['value']];



            //Registro
            if (! $token = auth()->attempt($credentials)) {

                if($userrolid['value'] = "Estudiante"){
                    $rolid = 5;
                }

                $user = new User;
            $user->name = $userfirstname['value'];
            $user->last_name = $userlastname['value'];
            $user->email = $username['value'];
            $user->email_verified_at =now();
            $user->remember_token =  Str::random(10);
            $user->avatar = "https://thumbs.dreamstime.com/b/perfil-de-usuario-vectorial-avatar-predeterminado-179376714.jpg";
            $user->enable = 0;
            $user->gender = 1;
            $user->rol_id = $rolid;
            $user->password = Hash::make($userid['value']);
            $password = $userid['value'];
            $repassword = $userid['value'];
            if($password !== $repassword){
                return response()->json([
                    "data" => $user,
                    "code" => 20000,
                    "message"=> "Password and re-password are not the same",
                    "type"=>"warning"
                ]);

            }
            $asunto = "La persona con el correo " .$username['value']. " Tiene una solicitud";
            $comentario = "El usuario ".$userfirstname['value']." con el correo ".$username['value']." se acaba de registrar en la plataforma y espera ser verificado";
            $emailsUsuarios = User::query()
                    ->select('email')
                    ->Where('rol_id', '=', '1')
                    ->get();
                foreach ($emailsUsuarios as $email) {
                    $this->enviarCorreo($email,  $asunto, $comentario);
                }

            $user->save();
            $alerta="Su registro ha sido exitoso, el proceso de activación de su cuenta puede tardar 48 horas";
            return redirect("http://192.168.10.242/dist/?alerta=".$alerta);
            }

            $enable = (bool) auth()->user()->enable;
            if(!$enable){
                $alerta="Su cuenta no ha sido activada aun, el proceso de activación de su cuenta puede tardar 48 horas";
                return redirect("http://192.168.10.242/dist/?alerta=".$alerta);
            }
            //echo "http://192.168.10.242/dist/?token=".$token;
           return redirect("http://192.168.10.242/dist/?token=".$token);
        }



    }

    public function enviarCorreo($email, $asunto, $cuerpo)
    {
        $arrayInfo['cuerpo'] = $cuerpo;

        Mail::to($email)->send(new NotifyMail($arrayInfo, $asunto));

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return null;
        }
    }




    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginazure()
    {
        return MsGraph::connect();

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {

        $user = auth()->user();
        $user->users_rols = $user->rol->permission;

        return response()->json([
            'data' => auth()->user(),
            'code' => 20000
        ]);

    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {


        auth()->logout();

            // Elimina los tokens de acceso de la caché
    cache()->forget('msgraph_access_token');
    cache()->forget('msgraph_refresh_token');
    MsGraph::disconnect();


        return response()->json([
            'data'=>[
                'message' => 'Successfully logged out'
            ],
            'code' => 20000
        ]);

    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'data'=>[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * (60*24)
            ],
            'code' => 20000
        ]);
    }


}
