

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4>Student Form</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Upload Image</label>
                            <input type="file" name="image" required class=" form-control">

                            <div class="mb-3">
                                <label for="">description</label>
                                <input type="text" name="description" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">price</label>
                                <input type="text" name="price" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">idofcategory</label>
                                <input type="text" name="idofcategory" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">cstgotyid</label>
                                <input type="text" name="cstgotyid" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">status</label>
                                <input type="text" name="status" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">featuerd</label>
                                <input type="text" name="featuerd" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">old_price</label>
                                <input type="text" name="old_price"  class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">quatity</label>
                                <input type="text" name="quantity"  class="form-control">
                            </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>