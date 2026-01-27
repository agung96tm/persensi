<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\LogsActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {
        $query = User::with('mahasiswa')->where('role', 'user');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($q2) use ($search) {
                      $q2->where('nim', 'like', "%{$search}%")
                         ->orWhere('nama', 'like', "%{$search}%")
                         ->orWhere('kelas', 'like', "%{$search}%");
                  });
            });
        }
        
        $users = $query->orderBy('name')->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        $this->logActivity(
            'create',
            'user',
            null,
            'Menambahkan user: ' . $request->name,
            ['email' => $request->email]
        );

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $this->logActivity(
            'update',
            'user',
            $user->id,
            'Memperbarui user: ' . $user->name,
            ['email' => $user->email]
        );

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            $this->logActivity(
                'delete',
                'user',
                $user->id,
                'Menghapus user: ' . $user->name,
                ['email' => $user->email]
            );

            return back()->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
