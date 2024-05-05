<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,  $slug, $status, $brand_id;

    public function rules()
        {
            return[
             'name'=> 'required|string',
             'slug'=>  'required|string',
             'status'=> 'nullable'
            ];
        }

    public function resetInput()
    {
        {
           $this->name=NULL;
           $this->slug=NULL;
           $this->status=NULL;
           $this->brand_id=NULL;
        }
    }

    public function storeBrand()
    {
       $validateData = $this->validate();
       Brand::create([
        'name'=> $this->name,
        'slug'=> Str::slug ($this->slug),
        'status' =>$this->status == true ? '1': '0',
       ]);
       session()->flash('message', 'Marca adicionada com sucesso');
       $this->dispatch('close-modal');
       $this->resetInput();
    }
       public function closeModel(){
         $this->resetInput();
       }

       public function OpenModel(){
        $this->resetInput();
      }

    public function editBrand(int $brand_id)
    {   $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this -> name = $brand->name;
        $this -> slug = $brand->slug;
        $this -> status = $brand->status;
    }

    public function updateBrand(){
        $validatedData= $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name'=>$this->name,
            'slug'=> Str::slug ($this->slug),
            'status' =>$this->status == true ? '1': '0',
        ]);
        session()->flash('message', 'Marca adicionada com sucesso');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id){
       $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'deletada com sucesso');
        $this->dispatch('close-modal');
        $this->resetInput();
    }
    public function render()

    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.brand.index',['brands' => $brands])
        ->extends('layouts..admin')
        ->section('content');
    }
}
