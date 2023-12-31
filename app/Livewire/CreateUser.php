<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Hash;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    #[Rule('required|string|min:2|max:50')]
    public $name ;

    #[Rule('required|email', as:'company email')]
    public $email; 

    #[Rule('required|min:6')]
    public $password;

    #[Rule('nullable|sometimes|image|max:1024')]
    public $image;

    public function render()
    {
        $users = User::latest()->paginate(5);
        return view('livewire.create-user',compact('users'));
    }

    public function createNewUser(){
        $validated = $this->validate();

        if($this->image){
           $validated['image'] = $this->image->store('uploads','public');
        }

        $user = User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'image'=>$validated['image'],
            'password'=> Hash::make($validated['password']),
        ]);

        $this->reset(['name','email','password','image']);

        session()->flash('success','User Created Successfully!');

        $this->dispatch('user-created',$user);
    }

}
