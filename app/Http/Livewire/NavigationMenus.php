<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NavigationMenu;
use Livewire\WithPagination;

class NavigationMenus extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $label;
    public $slug;
    public $sequence = 1;
    public $type = 'SidebarNav';

    public function read()
    {
        return NavigationMenu::paginate(5);
    }

    public function rules()
    {
        return [
            'label' => 'required',
            'slug' => 'required',
            'type' => 'required',
            'sequence' => 'required',
        ];
    }

    //the livewire mount function
    public function mount()
    {
        //reset pagination after reloading page
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.navigation-menus', [
            'data' => $this->read(),
        ]);
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function create()
    {
        $this->validate();
        NavigationMenu::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function update()
    {
        $this->validate();
        NavigationMenu::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        NavigationMenu::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function modelData()
    {
        return [
            'label' => $this->label,
            'slug' => $this->slug,
            'sequence' => $this->sequence,
            'type' => $this->type,
        ];
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

    // load the model data of this component
    public function loadModel()
    {
        $data = NavigationMenu::find($this->modelId);
        $this->label = $data->label;
        $this->slug = $data->slug;
        $this->sequence = $data->sequence;
        $this->type = $data->type;
    }
}
