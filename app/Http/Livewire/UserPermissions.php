<?php

namespace App\Http\Livewire;

use App\Models\UserPermission;
use Livewire\Component;
use Livewire\WithPagination;

class UserPermissions extends Component
{
    use WithPagination;
    
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    //put your custom public properties here
    public $role;
    public $routeName;

    public function rules()
    {
        return [
            'role' => 'required',
            'routeName' => 'required',
        ];
    }

    public function modelData()
    {
        return [
            'role' => $this->role,
            'route_name' => $this->routeName,
        ];
    }

    // load the model data of this component
    public function loadModel()
    {
        $data = UserPermission::find($this->modelId);
        //assign the variables here
        $this->role = $data->role;
        $this->routeName = $data->route_name;
    }

    public function create()
    {
        $this->validate();
        UserPermission::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function read()
    {
        return UserPermission::paginate(5);
    }

    public function update()
    {
        $this->validate();
        UserPermission::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        UserPermission::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.user-permissions', [
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