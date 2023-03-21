<style>
	.select-image:hover{
		background-color:#efefef;
		border-radius:5px;
	}
</style>
<div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Choose an Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="form-group">
				<div class="input-group">
					<input type="hidden" class="form-control search_image">
					<input type="text" class="form-control search_input" placeholder="Search for...">
					<div class="input-group-append">
						<button class="btn btn-primary btnSearch" type="button">Search</button>
					</div>
				</div>
			</div>
	  	<div class="row data-image">
		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
