namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:members,email',
            'phone' => 'required|string',
            'id_number' => 'required|string|unique:members,id_number',
            'password' => 'required|string|min:8',
        ]);

        $member = Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'id_number' => $data['id_number'],
            'password' => Hash::make($data['password']),
            'monthly_contribution' => 1000,
        ]);

        return response()->json([
            'success' => true,
            'member' => $member,
            'message' => 'Registration successful.'
        ]);
    }
}
