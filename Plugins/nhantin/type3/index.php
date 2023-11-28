<div class="container clearfix">
    <div id="nhantin">
        <form method="post" action="lien-he/" enctype="multipart/form-data">
            <div class="form-row align-items-center">
                <div class="col-lg-2 text-center">
                    <label>ĐĂNG KÝ NHẬN TIN</label>
                </div>
                <div class="col-lg-3">
                    <input class="form-control" type="text" name="name" required placeholder="<?=_hoten?> *">
                </div>
                <div class="col-lg-3">
                    <input class="form-control" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required name="email" placeholder="Email *">
                </div>
                <div class="col-lg-3">
                    <input class="form-control" type="text" required name="phone" pattern=".{10}" title="10 số" onkeypress="return isNumberKey(event)" placeholder="<?=_dienthoai?> *">
                </div>
                <div class="col-lg-1 text-center">
                    <button class="btn btn-danger">ĐĂNG KÝ</button>
                </div>
            </div>
        </form>
    </div>
</div>