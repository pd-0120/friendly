<?php

namespace App\Livewire;

use App\Enums\RoleType;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UserComponent extends Component
{

    public $name = "";
    public $email = "";
    public $role = "";
    public $roles = [];

    public User $user;
    public UserDetails $userDetails;

    public $detail_state = [
        'status' => true
    ];
    public $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'detail_state.phone' => 'required|max:20',
        'detail_state.dob' => 'nullable|date',
        'detail_state.emergency_phone' => 'nullable|max:20',
        'detail_state.street' => 'nullable|max:50',
        'detail_state.suburb' => 'nullable|max:50',
        'detail_state.pincode' => 'nullable|digits:4',
        'detail_state.payrate' => 'nullable|digits_between:1,50',
        'detail_state.joining_date' => 'nullable|date_format:Y-m-d',
        'detail_state.leaving_date' => 'nullable|date_format:Y-m-d',
        'detail_state.status' => 'boolean',
    ];

    public $validationAttributes = [
        'detail_state.phone' => 'phone',
        'detail_state.dob' => 'date of birth',
        'detail_state.emergency_phone' => 'emergency phone',
        'detail_state.street' => 'street',
        'detail_state.suburb' => 'suburb',
        'detail_state.pincode' => 'pincode',
        'detail_state.payrate' => 'payrate',
        'detail_state.joining_date' => 'joining date',
        'detail_state.leaving_date' => 'leaving date',
        'detail_state.status' => 'status',
    ];

    public function mount()
    {
        $this->roles = RoleType::getAllProperties();

        if(isset($this->user)) {
            $user = $this->user;

            $this->role = $user->getRoleNames()->first();
            $this->rules['email'] = "required|unique:users,email,$user->id";
            $this->name = $user->name;
            $this->email = $user->email;
        }

        if (isset($this->userDetails)) {
            $this->detail_state = $this->userDetails->toArray();
        }
    }

    public function render()
    {
        return view('livewire.user-component');
    }

    public function save() {

        $this->validate();
        try {
            if (!isset($this->user)) {
                $user = new User();
                $password = str()->random(8);

                $user->password = Hash::make($password);
                Session::flash('message.content', 'User added successfully.');
            } else {
                $user = $this->user;
                Session::flash('message.content', 'User updated successfully.');
            }
            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();

            if (!isset($this->userDetails)) {
                $userDetails = new UserDetails($this->detail_state);

                $user->UserDetail()->save($userDetails);
            } else {
                $userDetails = $this->userDetails->update($this->detail_state);
            }

            // Send the welcome email with the password.
            if($user->wasRecentlyCreated) {
                $this->sendWelcomeEmail($user, $password);
            }

            Session::flash('message.level', 'success');


        } catch (\Throwable $th) {
            Session::flash('message.content', $th->getMessage());
            Session::flash('message.level', 'error');
        }

        return redirect()->route('user.index');
    }

    private function sendWelcomeEmail(User $user, $password) {
        try {
            //code...
            Mail::to($user->email)->send(new WelcomeMail($user, $password));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
