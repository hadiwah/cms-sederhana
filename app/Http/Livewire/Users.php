<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $name;
    public $role;

    //put your custom public properties here

    public function rules()
    {
        return [
            'name' => 'required',
            'role' => 'required',
        ];
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
        ];
    }

    // load the model data of this component
    public function loadModel()
    {
        $data = User::find($this->modelId);
        //assign the variables here
        $this->name = $data->name;
        $this->role = $data->role;
    }

    public function create()
    {
        $this->validate();
        User::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function read()
    {
        return User::paginate(5);
    }

    public function update()
    {
        $this->validate();
        User::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        User::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.users', [
            'data' => $this->read(),
        ]);
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    //show update modal on update mode
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    //show delete modal on delete mode
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }
}