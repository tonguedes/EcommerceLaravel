<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;
    public function deleteCategory($category_id){
        $this->category_id = $category_id;

    }

    public function destroyCategory(){
          $category = Category::find($this->category_id);
          $path ='uploads/category/'.$category->image;
          if(File::exists($path)){
              File::delete($path);
          }
          $category->delete();
          session()->flash('message','Categoria deletada');
          $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.category.index',['categories'=> $categories] );
    }
}
