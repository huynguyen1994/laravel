<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User;
use Illuminate\Http\UploadedFile;


class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
            'phone' => 'min:10|max:10',
            'birthday' => 'date',
        ];

        $customMessages = [
            'username.required' => 'Bạn chưa nhập Name',
            'username.max' => 'Name chỉ được tối đa 255 ký tự',
            'email.required' => 'Bạn chưa nhập Email',
            'email.max' => 'Email chỉ được tối đa 255 ký tự',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập Password',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu phải có tối đa 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.min' => 'Số điện thoại phải có 10 ký tự',
            'phone.max' => 'Số điện thoại phải có 10 ký tự',
            'birthday.date' => 'Nhập đúng đinh dạng Ngày tháng năm sinh',
        ];
        $validatedData = $this->validate($request, $rules, $customMessages);

        if ($validatedData) {
            $user = new User;
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->social_id = "";
            $success_save = $user->save();
            if ($success_save) {
                return redirect('backend/users')->with('success', 'Thêm thành công');
            } else {
                return redirect('backend/users')->with('error', 'Thêm thất bại');
            }
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('backend/users')->with('success', 'Xóa người dùng thành công');
        } else {
            return redirect('backend/users')->with('error', 'Không tìm thấy người dùng');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view("backend.users.edit")->with(compact('user'));
        } else {
            return redirect('backend/users')->with('error', 'Không tìm thấy người dùng');
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'required|max:255',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
            'phone' => 'min:10|max:10',
            'birthday' => 'date',
        ];

        $customMessages = [
            'username.required' => 'Bạn chưa nhập Name',
            'username.max' => 'Name chỉ được tối đa 255 ký tự',
            'password.required' => 'Bạn chưa nhập Password',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu phải có tối đa 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.min' => 'Số điện thoại phải có 10 ký tự',
            'phone.max' => 'Số điện thoại phải có 10 ký tự',
            'birthday.date' => 'Nhập đúng đinh dạng Ngày tháng năm sinh',
        ];
        $validatedData = $this->validate($request, $rules, $customMessages);
        if ($validatedData) {
            $user = User::find($id);
            $user->name = $request->username;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $success_save = $user->save();
            if ($success_save) {
                return redirect('backend/users')->with('success', 'Sửa thành công');
            } else {
                return redirect('backend/users')->with('error', 'Sửa thất bại');
            }
        }
    }

    public function editProfile()
    {
        return view("backend.users.editProfile");
    }
    public function updateProfile(Request $request)
    {
        return redirect('/');
//        $file = $request->file('photo');
//
//        $data = imagewebp($file, 'converted.webp');
//        echo "<pre>";
//        var_dump($data);
//
//        echo "<pre>";
//        var_dump($request->all());
//            dd($request->file('photo'));
    }
}
