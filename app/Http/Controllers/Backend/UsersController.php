<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User;
use Auth;
use WebPConvert\WebPConvert;
use Illuminate\Http\UploadedFile;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view("backend.users.edit")->with(compact('user'));
        } else {
            return redirect('backend/users')->with('error', 'Không tìm thấy người dùng');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
            $success = $user->save();
            if ($success) {
                return redirect('backend/users')->with('success', 'Sửa thành công');
            } else {
                return redirect('backend/users')->with('error', 'Sửa thất bại');
            }
        }
    }

    /**
     * Show the form for editing Profile the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $user = Auth::user();
        $images = json_decode($user->image);
        return view("backend.users.editProfile")->with(compact('user', 'images'));
    }

    /**
     * Update Profile the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $rules = [
            'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
        ];

        $customMessages = [
            'image.required' => 'Chưa chọn File',
            'image.image' => 'Không phải file hình ảnh',
            'image.mimes' => 'Upload file jpeg,jpg,png,gif',
            'image.max' => 'File 2MB'
        ];
        $validatedData = $this->validate($request, $rules, $customMessages);
        if ($validatedData) {
            if ($request->hasFile('image')) {
                $nameFile = $request->file('image')->getClientOriginalName();
                $options = [];
                $countString = '-' . strlen($request->file('image')->getClientOriginalExtension());
                $getLastImage = substr($nameFile, (int)$countString);
                $getNameImage = explode($getLastImage, $nameFile);
                if ($getNameImage[0]) {
                    $request->file('image')->move(public_path('images/users'), $nameFile);
                    $dataImage = [
                        'image' => $nameFile,
                        'webp' => $getNameImage[0] . 'webp'
                    ];
                    $id = $request->userId;
                    $user = User::find($id);
                    $user->image = $dataImage;
                    $source = public_path('/images/users/') . $nameFile;
                    $destination = public_path('/images/users/') . $getNameImage[0] . 'webp';
                    WebPConvert::convert($source, $destination, $options);
                    $success = $user->save();
                    if ($success) {
                        return redirect('backend/users')->with('success', 'Thêm hình thành công');
                    } else {
                        return redirect('/backend/users/editProfile')->with('error', 'Thêm hình thất bại');
                    }
                }
            }
        }
    }
}
