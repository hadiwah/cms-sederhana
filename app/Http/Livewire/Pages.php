<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Pages extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;

    public function rules()
    {
        return[
            'title' => 'required|string',
            'slug' => 'required|string|unique:pages,slug,' .$this->modelId,
            'content' => 'required|string',
        ];
    }

    //the livewire mount function
    public function mount()
    {
        //reset pagination after reloading page
        $this->resetPage();
    }

    public function read()
    {
        return Page::paginate(5);
    }

    public function create()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function update()
    {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultNotFoundPage();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        Page::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function updatedIsSetToDefaultHomePage()
    {
        $this->isSetToDefaultNotFoundPage = null;
    }

    public function updatedIsSetToDefaultNotFoundPage()
    {
        $this->isSetToDefaultHomePage = null;
    }

    //unassign the default home page in database table
    private function unassignDefaultHomePage()
    {
        if($this->isSetToDefaultHomePage != null)
        {
            Page::where('is_default_home', true)->update([
                'is_default_home' => false,
            ]);
        }
    }

    private function unassignDefaultNotFoundPage()
    {
        if($this->isSetToDefaultNotFoundPage != null)
        {
            Page::where('is_default_not_found', true)->update([
                'is_default_not_found' => false,
            ]);
        }
    }

    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' =>$this->isSetToDefaultNotFoundPage,
        ];
    }

    public function render()
    {
        return view('livewire.pages', [
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

    // load the model data of this component
    public function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null : true ;
        $this->isSetToDefaultNotFoundPage = !$data->is_default_not_found ? null : true ;
    }
}
