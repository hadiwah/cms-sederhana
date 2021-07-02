<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FrontPage extends Component
{
    public $title;
    public $content;

    //this livewire mount function
    public function mount($urlslug = null)
    {
        $this->retrieveContent($urlslug);
    }

    //retrieves content of the page
    public function retrieveContent($urlslug)
    {
        //get the page according the slug value
        if(empty($urlslug)){
            $data = Page::where('is_default_home', true)->first();
        }else{

            //get the page according to the slug value
            $data = Page::where('slug', $urlslug)->first();

            //if we can't retrieve anything, lets get default home page
            if(!$data){ 
                $data = Page::where('is_default_not_found', true)->first();
            }
        }
        $this->title = $data->title;
        $this->content = $data->content;
    }

    //get all by sidebar links
    private function sideBarLinks()
    {
        return DB::table ('navigation_menus')
        ->where('type', '=', 'SidebarNav')
        ->orderBy('sequence', 'asc')
        ->orderBy('created_at', 'asc')
        ->get();
    }

    private function topNavLinks()
    {
        return DB::table ('navigation_menus')
        ->where('type', '=', 'TopNav')
        ->orderBy('sequence', 'asc')
        ->orderBy('created_at', 'asc')
        ->get();
    }

    //livewire render function
    public function render()
    {
        return view('livewire.front-page', [
            'sideBarLinks' => $this->sideBarLinks(),
            'topNavLinks' => $this->topNavLinks(),
        ])->layout('layouts.frontpage');
    }
}
