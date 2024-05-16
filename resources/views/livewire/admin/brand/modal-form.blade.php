 <!-- Modal -->
 <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form wire:submit.prevent="storeBrand()">

                 <div class="modal-body">
                    <div class="mb-3">
                        <label >Selecione uma Categoria</label>
                        <select wire:model.defer="category_id" class="form-control" required>
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $cateItem)
                            <option value="{{ $cateItem->id }}">{{ $cateItem->name  }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                     <div class="mb-3">
                         <label> brand Name </label>
                         <input type="text" wire:model.defer="name" class="form-control">
                         @error('name')
                             <small class="text-danger">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="mb-3">
                         <label> brand Slug </label>
                         <input type="text" wire:model.defer="slug" class="form-control">
                         @error('slug')
                             <small class="text-danger">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="mb-3">
                         <label> Status </label><br>
                         <input type="checkbox"wire:model.defer="status" />Checked=Hidden Un-Checked= Visible
                         @error('status')
                             <small class="text-danger">{{ $message }}</small>
                         @enderror
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                         id="close-modal">Close</button>
                     <button type="submit" class="btn btn-primary" id="close-modal">Save</button>
                 </div>

             </form>
         </div>
     </div>
 </div>

 <!-- Brand Update Modal -->
 <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brands</h1>
                 <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>

             <div wire:loading>
                 <div class="spinner-border" role="status">
                     <span class="visually-hidden">Loading...</span>
                 </div>

             </div>
             <div wire:loading.remove>
                 <form wire:submit.prevent="updateBrand()">

                     <div class="modal-body">
                         <div class="mb-3">
                            <label >Selecione uma Categoria</label>
                            <select wire:model.defer="category_id"  class="form-control" required>
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $cateItem)
                                <option value="{{ $cateItem->id }}">{{ $cateItem->name  }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                             <label> brand Name </label>
                             <input type="text" wire:model.defer="name" class="form-control">
                             @error('name')
                                 <small class="text-danger">{{ $message }}</small>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <label> brand Slug </label>
                             <input type="text" wire:model.defer="slug" class="form-control">
                             @error('slug')
                                 <small class="text-danger">{{ $message }}</small>
                             @enderror
                         </div>
                         <div class="mb-3">
                             <label> Status </label><br>
                             <input type="checkbox"wire:model.defer="status" />Checked=Hidden Un-Checked= Visible
                             @error('status')
                                 <small class="text-danger">{{ $message }}</small>
                             @enderror
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" wire:click="closeModal" class="btn btn-secondary"
                             data-bs-dismiss="modal" id="close-modal">Close</button>
                         <button type="submit" class="btn btn-primary" id="close-modal">Update</button>
                     </div>

                 </form>
             </div>
         </div>
     </div>
 </div>

 <!-- Brand Delete Modal -->
 <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brand</h1>
                 <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>

             <div wire:loading>
                 <div class="spinner-border" role="status">
                     <span class="visually-hidden">Loading...</span>
                 </div>

             </div>
             <div wire:loading.remove>
                 <form wire:submit.prevent="destroyBrand">

                     <div class="modal-body">

                         <h4>Tem certeza que deseja excluir o arquivo?</h4>
                         <div class="modal-footer">
                             <button type="button" wire:click="closeModal" class="btn btn-secondary"
                                 data-bs-dismiss="modal" id="close-modal">Close</button>
                             <button type="submit" class="btn btn-primary" id="close-modal">Yes. Delete</button>
                         </div>

                 </form>
             </div>
         </div>
     </div>
 </div>
 </div>
