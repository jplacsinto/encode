
  <!--Modal-->
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class=" font-bold">Are you sure you want to delete?</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <p id="modal-content"></p>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          
          <button class="modal-close text-white mr-3 px-4 bg-gray-600 py-2 px-3 rounded-lg hover:text-gray-100 hover:bg-gray-500">Cancel</button>

          <form id="confirmDelete" action="" method="POST">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="px-4 bg-red-700 py-2 px-3 rounded-lg text-white hover:bg-red-600 mr-2">Confirm Delete</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  

  @section('scripts')
  <script>

    var openmodal = document.querySelectorAll('.modal-open')

    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){

        event.preventDefault();

        document.getElementById('modal-content').innerHTML = this.dataset.name;

        document.getElementById('confirmDelete').setAttribute('action', this.dataset.action);

        toggleModal();

      })
    }


    
  </script>
  @endsection

  