<!-- Modal -->
<div class="modal fade" id="addCustomer" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="{{ url('customer/add') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" id="newCustomer" />
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="form-control" name="addres"/>
            </div>
            <div class="form-group">
                <label>Phone number</label>
                <input class="form-control" name="phone"/>
            </div>
        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>